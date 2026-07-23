# Enterprise Costing Engine — Architecture Proposal

**Status:** Draft for approval — Phase 0. No code written yet.
**Author:** Claude (Opus 4.8), for PT. Haifa Nida Wisata.
**Depends on:** existing `paket` domain, the `app/Services/Inventory/**` provider seam (built 2026-07-22), the `admin` / `superadmin` / `adminkantor` middleware gates.

> **Workbook note.** `Anggaran-Biaya-Produksi-Umroh.xlsx` was referenced as an attachment but did not arrive in this environment (there is no attachment channel here, and it is not on disk). This proposal is built from the prose brief, which restates the workbook's five-sheet structure (Parameter, Biaya Produksi, Produk Tambahan, Ringkasan, Sensitivitas) and every confirmed rate. Every figure I rely on is tagged **[from brief]**; once you drop the file into `storage/app/costing/` I will reconcile the exact cells and turn the Ringkasan/Sensitivitas worked examples into the golden-master test fixture (see §18).

---

## 0. Executive position (read this first)

Three things drive the whole design, and everything else is detail:

1. **Cost per pilgrim is not a number — it is a function `f(pax, occupancy_mix, night_split, arrival/return timestamps, channel_mix, departures_in_month, coverage_set)`.** The old flat spreadsheet's original sin was storing per-group costs pre-divided by an assumed 35. The engine must store each component with its *behaviour* and only ever derive per-pilgrim figures as a projection. This is section §2 and it is the core.

2. **The unit that gets costed is a Departure, not a Package.** Your brief describes one package spawning ~12 monthly departures, each with its own insurer, vendors, margin strategy, pax, and frozen snapshot. The current `paket` table conflates "product template" and "concrete departure." This is the single biggest modelling decision and I need your ruling (§Q1).

3. **Bundles are resolved by coverage, not by suppressing line items.** Visa now bundles ground transport + city tour + Taif; an LA bundles hotels + handling + TG + city tour. The robust model is: every purchasable service *declares the coverage it provides*, and the engine resolves each required coverage exactly once — flagging double-coverage and gaps. This replaces the fragile "bundle hides these rows" idea with a provider/resolver (§5, §Domain).

I agree with your sequencing: **costing before booking features is the correct dependency order.** Booking, quota, agent payouts, and the future B2B portal all consume price and margin numbers that only this engine can produce correctly. Building booking first would hard-code today's manual numbers into transactional data.

---

## 1. Domain architecture & bounded context

### 1.1 A new bounded context: `Costing`

The Costing context is **separate** from the existing Booking/Package context and communicates with it through a narrow, one-directional seam:

```
┌─────────────────────────┐        publishes price →        ┌──────────────────────────┐
│  Booking / Package ctx  │  ◄───────────────────────────   │      Costing context      │
│  (existing, untouched)  │                                 │        (new)              │
│  paket, pemesanan,      │   ── reads paket_id, pax,   ──►  │  vendors, rate cards,     │
│  jemaah, paket_hotel    │      nights, dates              │  fx policy, coverage,     │
│                         │                                 │  components, snapshots     │
└─────────────────────────┘                                 └──────────────────────────┘
```

- Costing **reads** structural facts from the Package context (which package, planned pax, night split, arrival/return times, selected hotels).
- Costing **writes back** exactly one thing: a *published price* (and, additively, per-occupancy published prices). It writes to a new column/table and, on demand, syncs the base figure into the existing `paket.harga` so the current booking flow keeps working unchanged.
- Production cost (HPP), margin, vendor rates, and snapshots **never** flow back into the Package context's public-facing surfaces. This is the security invariant (§17).

### 1.2 Relationship to the Inventory context

The Inventory context (`app/Services/Inventory/**`) already owns *provider-sourced facts*. Costing **consumes** it, never duplicates it:

- Hotel live rates → `SupportsLiveInventory` (RateHawk/TBO later) feed a hotel rate card.
- Airfare → a **new sibling capability** `SupportsFlightPricing` (pusattiket.com/GDS later) in the same namespace.
- FX market watch → a **new sibling capability** `SupportsFxRates` (Bank Indonesia later) — enrichment only; never drives costing.

No second provider abstraction is introduced (§10).

---

## 2. Cost behaviour taxonomy — the heart of the engine

Every cost component is classified by **one behaviour**. The behaviour, not the component, owns the maths. This is the generic mechanism your brief demands ("model generically, not as a TL special case").

| Behaviour | Formula shape | Confirmed examples **[from brief]** |
|---|---|---|
| `PER_PILGRIM` | `rate × pax` | visa (USD 140), insurance (Rp65k), tasreh (SAR 30), CGK handling (Rp150k/leg × 2), Makkah–Madinah handling (USD 75–100+), flight ticket (Rp13–20jt) |
| `PER_ROOM_NIGHT` | `rate × nights × ceil(pax_in_tier / occupancy)` | Makkah hotel, Madinah hotel (priced separately, quad base) |
| `PER_GROUP` | `amount ÷ pax` | Saudi bus, city-tour vehicles, transit villa |
| `PER_GROUP_PER_DAY` | `(rate × billable_days) ÷ pax` | mutawwif (SAR 250/day, **billable Saudi ground days ≠ package days**) |
| `STEPPED` | `ceil(pax / step) × unit ÷ pax` | tour leader (1 per 45 pax → cliff at 46), any per-bus vendor |
| `MIN_GUARANTEE` | `max(0, floor − pax) × rate ÷ pax` | farkiyah (`max(0, 35−pax) × USD 20`) |
| `CONDITIONAL` | `predicate(context) ? amount : 0` | transit villa (arrival < checkin), staff salary (departures_in_month == 1) |
| `CHANNEL_DEPENDENT` | priced always; cost vs margin by channel | agent fee (Rp1.5jt: cost if agent-sourced, margin if direct) |
| `FOC_DILUTED` | `(free_seats × value) ÷ divisor` | free agent/ustadz seats, airline FOC-per-N; **diluted at publish price over default 35** |
| `MARKUP` | added to price, not to HPP | staff salary allocation, agent fee, contingency % |

**Implementation:** a `CostBehavior` enum + one resolver strategy class per behaviour implementing a single interface:

```
interface CostBehavior {
    public function resolve(ComponentLine $line, CostingContext $ctx): ResolvedLine;
}
```

`CostingContext` is an immutable value object carrying `pax`, `occupancyMix`, `nightSplit`, `arrivalAt`, `returnAt`, `saudiGroundDays`, `channelMix`, `departuresInMonth`, `fxPolicy`, `coverageSet`. Every threshold, cliff, and floor is thus expressed once, generically, and reused. Adding a new vendor with a "minimum 20 pax" term is data, not code.

**Why this matters for your worked examples** (these become unit tests, §18):
- mutawwif SAR 250/day × 9 days ÷ 20 pax ≈ Rp562,500/pax (not the old flat Rp350k) ✅
- farkiyah at 12 pax = 23 × USD 20; at 41–44 pax = nil ✅
- TL cliff: 45 pax → 1 seat funded; 46 pax → 2 seats, −~Rp10jt swing, warning fired ✅

---

## 3. Database design (ERD-level)

All tables are **new and additive**. Singular names per project convention. No existing table is altered except optional additive nullable columns on `paket` (§9.1).

### 3.1 FX policy (versioned)
```
fx_policy_version
  id, base_currency='USD', usd_idr (decimal 12,2),
  sar_idr (decimal 12,2),          -- validated against USD peg, see §6
  peg_sar_per_usd (decimal 6,4) default 3.75,
  effective_from (date), effective_to (date, null=open),
  created_by, reason (text), created_at
  -- INVARIANT: exactly one open version per base_currency
```

### 3.2 Vendor master — three layers (§4)
```
vendor
  id, nama, kategori (enum: visa|handling_id|handling_sa|la|hotel|airline|
       broker|mutawwif|insurance|health|catering|equipment|transport_id|other),
  is_related_party (bool),         -- internal catering etc, reporting only (§internal vendors)
  contact, payment_terms, default_currency, aktif, timestamps

vendor_service                     -- what a vendor actually sells, at what TIER
  id, vendor_id, nama, service_tier (string: 'nasi_box'|'lounge'|'buffet'|...),
  coverage_tags (json),            -- what this service PROVIDES (see §5)
  behavior (enum, §2),             -- default behaviour for its rate card
  unit (enum: pax|group|room_night|group_day|leg|bus), aktif

rate_card                          -- NEVER overwritten; superseded
  id, vendor_service_id, currency, amount (decimal 14,2), unit,
  season (enum: low|normal|high|peak|null), min_qty (int null),
  tax_rule_id (null, §7), valid_from (date), valid_to (date null),
  source (enum: manual|tbo|ratehawk|pusattiket|...), external_ref (null),
  superseded_by (self fk null), created_by, created_at
```

### 3.3 Coverage taxonomy (§5) + effective-dated regulation
```
coverage_tag                       -- canonical vocabulary (seed data)
  id, key (unique: 'ground_transport_makkah_madinah'|'city_tour'|'taif_tour'|
       'handling_makkah'|'handling_madinah'|'handling_jeddah'|'mutawwif'|
       'hotel_makkah'|'hotel_madinah'|...), label

visa_coverage_ruleset              -- effective-dated regulatory reality (§bundle coverage)
  id, provides_tags (json),        -- what the Umrah visa bundle includes as of a date
  effective_from (date), note, created_by, created_at
  -- resolved by DEPARTURE DATE so reopening an old costing sees old rules
```

### 3.4 Cost components (the catalogue)
```
cost_component                     -- the taxonomy from the Biaya Produksi sheet
  id, key (unique), nama, kategori (production|markup|ancillary),
  behavior (enum, §2), default_unit, default_currency,
  provides_tags (json null),       -- e.g. visa provides ground+city+taif
  requires_tags (json null),       -- e.g. costing requires city_tour once
  is_mandatory (bool), sort_order
```

### 3.5 Costing snapshot (immutable, §9)
```
costing                            -- the aggregate root; one per departure attempt
  id, paket_id (fk),               -- (or departure_id, see §Q1)
  status (draft|published|frozen),
  planned_pax, night_makkah, night_madinah,
  arrival_at (datetime null), return_at (datetime null),
  saudi_ground_days (int null),    -- derived, cached
  fx_policy_version_id, visa_coverage_ruleset_id,
  channel_mix_agent_pct (default 90),   -- §standard markups
  departures_in_month (int),       -- staff-salary rule input
  margin_floor (default 2_000_000), margin_target (default 3_000_000),
  created_by, published_at, frozen_at, timestamps

costing_line                       -- resolved components, append-only within a snapshot
  id, costing_id, cost_component_id, vendor_service_id (null),
  rate_card_id (null),             -- pins the version used
  behavior, input_json, currency, amount_foreign, amount_idr,
  coverage_provided (json), suppressed_by_line_id (null),  -- coverage resolution result
  note

costing_free_seat                  -- free-of-charge seats (§FOC)
  id, costing_id, kind (agent|ustadz|airline_foc|tl), qty,
  dilution_divisor (default 35), valued_at (publish|cost, default publish)

costing_concession                 -- agent concession simulation inputs (§simulator)
  id, costing_id, agent_id (null), free_seats, keep_fee (bool),
  raise_publish (bool), absorb_margin (bool), note

costing_ancillary                  -- product-tambahan lines, per packaging mode (§ancillary)
  id, costing_id, ancillary_product_id, packaging (all_in|optional),
  takeup_pct (null, optional mode only), region_variant (null),
  cost_buildup_json, sell_price, timestamps
```

### 3.6 Ancillary catalogue + audit + budget-actual
```
ancillary_product                  -- equipment/manasik, vaccination, passport, merchandise
  id, key, nama, family (equipment_manasik|health|passport|merchandise|transport),
  vendor_choice_level (per_departure|per_pilgrim),   -- insurance-like vs vaccination-like
  default_packaging, timestamps

audit_log (or reuse existing if present)
  id, auditable_type, auditable_id, action, old_json, new_json,
  reason, user_id, ip, created_at

costing_actual                     -- budget vs actual (later phase, §10 outputs)
  id, costing_id, cost_component_id, actual_amount_idr, actual_pax,
  attended (bool null), note, recorded_by, recorded_at
```

**Fixed/variable/stepped is visible in the schema** via `cost_component.behavior` and `costing_line.behavior` — the classification is a first-class column, never inferred.

---

## 4. Vendor master data — three layers, not one column

Your instinct is right: `supplier` as a string is too thin. The three layers are `vendor` → `vendor_service` (tier) → `rate_card` (versioned), as above. Concrete mapping of your real vendors:

- **Visa:** Razek, Mozaik, Maysan, Victory as `vendor(kategori=visa)`; each `vendor_service` carries `provides_tags=[ground_transport_makkah_madinah, city_tour, taif_tour]` reflecting the current bundle. "Direct to embassy once IATA" is just another vendor added later (§future in-house visa — no design assumes visa is permanently external).
- **CGK handling:** one `vendor` per PT, multiple `vendor_service` tiers (`nasi_box`, `lounge`, `buffet`) — tier selectable per costing.
- **Saudi handling / LA:** `vendor(kategori=handling_sa|la)`; a combined LA service carries `provides_tags=[hotel_makkah, hotel_madinah, handling_*, mutawwif, city_tour]`. "Some handlers include mutawwif free" = the LA service simply also provides `mutawwif`, which suppresses the standalone mutawwif line automatically (§5).
- **Airline vs broker:** ticket **source is a vendor with its own payment terms**, not a price attribute — exactly as you said. `rate_card` rows differ by source; broker rows can be *cheaper* and carry an H-1-month term while airline-direct carries H-2-weeks (§payment timing feeds the alerting layer, later).

---

## 5. Bundled scope & double-count prevention — the coverage resolver

**Reframing your model.** You described "a bundle suppresses the individual components it includes." That works until two bundles overlap (visa's city tour vs an LA's city tour) — then "suppress" is ambiguous about *which* wins and can silently drop a real cost. The robust construct is a **resolver**:

1. Each `cost_component` declares `requires_tags` (what the costing needs covered — e.g. `city_tour` needed once).
2. Each selected service / the visa ruleset declares `provides_tags`.
3. The resolver walks required tags and asserts **exactly one provider** per tag:
   - **0 providers → GAP** → warn "city tour required but nothing covers it."
   - **1 provider → OK**, the standalone line for that tag is marked `suppressed_by_line_id`.
   - **≥2 providers → OVERLAP** → warn "city tour covered by both Visa and LA — you may be paying twice," and require the user to pick which provider is authoritative.

This directly solves the two cases you called urgent: visa-includes-city-tour-vs-LA, and bundle-vs-à-la-carte comparison (§ancillary/comparison) becomes "resolve twice with different provider sets and diff the totals." No double counting, no silent gaps, and the *reason* a line is zero is always recorded.

**Effective-dated regulation.** `visa_coverage_ruleset` is seed/version-controlled data with `effective_from`. A costing resolves the ruleset **as of its departure date**, so reopening a 2024 costing sees the pre-Taif-free rules, while a 2026 costing sees Taif bundled. This is the middle path you specified — no admin UI in phase 1; add one later only if regulation churns more than ~once/year.

---

## 6. Currency — recommendation: **validate against the peg, don't pure-derive**

You asked me to choose. My recommendation: **store `usd_idr` as the management input and `sar_idr` as an explicit value that is validated against the peg, not silently derived.**

Rationale — this is where I push back on the "just derive SAR" reflex:
- Peg math: USD Rp18,000 ÷ 3.75 = Rp4,800 implied SAR. Your policy SAR is Rp5,000 — a **round management number**, not a formula output. Pure-derivation would force either Rp4,800 or an awkward buffer like "+4.17%." Management sets round numbers; the model should respect that.
- So: the FX form takes `usd_idr` and `sar_idr`. On save it computes `implied = usd_idr / peg` and:
  - **blocks** saving `sar_idr < implied` (never under-buffer — that removes your safety margin),
  - **warns** if `sar_idr` drifts above `implied × (1 + max_buffer)` (e.g. >10%) as a fat-finger guard,
  - **shows** the implied value and the effective buffer live.

This satisfies "SAR and USD must not be independent unrelated numbers" (they're peg-linked and guarded) while honouring round management figures. Every change creates a new `fx_policy_version` with `effective_from`, author, and reason; existing snapshots stay pinned to their version forever. The **Bank Indonesia reference rate** enters later only as a market-watch signal (a `SupportsFxRates` adapter) to *suggest when to revise policy* — it never touches a costing.

---

## 7. Tax — model it, don't assume a rate

I will **not** hard-code a rate. Indonesian travel agencies typically face (a) **PPN** on travel services under a special/final scheme and (b) **PPh 23** withholding on certain vendor services — but the applicable percentages and which components they hit depend on your accountant's treatment and your PKP status. Model:

```
tax_rule
  id, key, nama, kind (ppn_final|pph23|none|custom),
  rate_pct (decimal 5,2), applies_to (enum: sell|vendor_cost),
  rounding, aktif
```

`rate_card.tax_rule_id` and `cost_component` carry an optional tax rule, so tax is per-vendor and per-component flexible. **Open question Q4:** I need the actual rates and which lines they apply to from your accountant before Phase 1 seeds anything.

---

## 8. Laravel module & directory layout

Consistent with the existing codebase (Eloquent models in `app/Models`, service logic under `app/Services/**` — mirroring `app/Services/Inventory/`). **DDD-lite, not full hexagonal** — see the pushback in §Value objects/§Aggregates.

```
app/
  Models/Costing/            FxPolicyVersion, Vendor, VendorService, RateCard,
                             CoverageTag, VisaCoverageRuleset, CostComponent,
                             Costing, CostingLine, CostingFreeSeat, CostingConcession,
                             CostingAncillary, AncillaryProduct, CostingActual
  Services/Costing/
    CostingEngine.php               orchestrates a full calculation
    Behaviors/                      one class per CostBehavior (§2)
    Coverage/CoverageResolver.php   (§5)
    Pricing/PriceBuilder.php        markups, publish price, per-occupancy prices
    Margin/MarginEvaluator.php      floor/target checks, budgeted vs expected
    Simulation/
      ScenarioSimulator.php         "what if" (§8 outputs)
      ConcessionSimulator.php       agent concessions (§simulator)
      PackagingComparator.php       all-in vs stripped (§comparison)
    Snapshot/CostingSnapshotService.php   freeze/immutability
    Contracts/                      SupportsFlightPricing, SupportsFxRates (siblings)
    DTO/                            readonly value objects (§5 below)
    Support/Money.php, FxPolicy.php, CoverageSet.php ...
  Services/Inventory/**       (existing — extended, not replaced, §10)
config/costing.php            defaults: margin_floor, margin_target, free_seat_divisor,
                              channel_mix default 90, tl_ratio 45, farkiyah floor 35 ...
```

---

## 5-VO / 6-Aggregate / 7-Entity / 8-Event (the DDD asks)

> **Pushback on heavyweight DDD.** You asked for aggregates, entities, VOs, and domain events. I'll give them — but I recommend a *pragmatic* realisation, not textbook aggregate roots with repositories and an event bus. This is a single-app, largely single-developer Laravel project; full hexagonal DDD would add ceremony (repositories mirroring Eloquent, hand-rolled event dispatch) that fights the framework and slows you down. The mapping below keeps DDD's *conceptual* discipline (immutability, invariants, explicit events) while using Eloquent models as entities and Laravel's native event system. If you specifically want the stricter version, say so and I'll adjust — but I'd be doing you a disservice to default to it.

**Value objects (immutable, PHP `readonly` — same style as the existing Inventory DTOs):**
`Money(amount, currency)`, `FxPolicy(usdIdr, sarIdr, versionId, effectiveFrom)`, `PaxCount`, `OccupancyMix(quad, triple, double, single, custom[])`, `NightSplit(makkah, madinah)`, `SaudiGroundDays`, `ChannelMix(agentPct)`, `CoverageSet(providedBy: tag→lineId)`, `Margin(perPilgrim, distanceToFloor)`, `SteppedResult`, `ResolvedLine`.

**Aggregates (root → owned parts, consistency boundary):**
- `Costing` (root) → `CostingLine[]`, `CostingFreeSeat[]`, `CostingConcession[]`, `CostingAncillary[]`. Invariants enforced at the root: one FX version, one insurer for the whole departure, coverage resolved with no unacknowledged overlap, snapshot immutable once `frozen`.
- `Vendor` (root) → `VendorService[]` → `RateCard[]` (rate cards are append-only; superseding, never mutating).
- `FxPolicyVersion` (root) — one open version at a time.

**Entities:** `Costing`, `CostingLine`, `Vendor`, `VendorService`, `RateCard`, `AncillaryProduct`, `CostComponent`, `VisaCoverageRuleset`, `FxPolicyVersion`.

**Domain events (Laravel events):**
`FxPolicyRevised`, `RateCardSuperseded`, `CostingCalculated`, `CostingPublished`, `CostingFrozen`, `MarginFloorBreached` (carries who/what/override), `CoverageOverlapDetected`, `StepThresholdCrossed` (TL cliff / small-group). These drive audit logging (§14), alerts, and the eventual working-capital/critical-path reporting (§10) without coupling the calculator to those consumers.

---

## 9. Calculation flow, end to end

```
INPUT  ── Costing draft: paket_id, planned_pax, night_split, arrival/return,
          channel_mix, departures_in_month, selected vendor_services+tiers,
          free seats, concessions, ancillary packaging
  │
  1. Resolve FX policy  ── as-of departure date → FxPolicy VO (pinned)
  2. Resolve coverage   ── visa ruleset as-of date + selected bundles
  │                        → CoverageSet, OVERLAP/GAP warnings (§5)
  3. Resolve rate cards ── each vendor_service → rate_card valid as-of date (pinned)
  4. Derive drivers     ── saudi_ground_days from arrival/return (NOT package days),
  │                        rooms = ceil(pax_in_tier / occupancy) per city
  5. Run behaviours     ── each CostComponent → its CostBehavior.resolve(ctx)
  │                        → CostingLine[] (foreign + IDR), suppressed lines zeroed
  6. Aggregate          ── production HPP: per-group ÷ pax + per-pilgrim + per-room-night
  │                        → cost MATRIX over (pax, occupancy_mix)
  7. FOC / free seats   ── dilute at PUBLISH price over divisor (default 35), show
  │                        planned(35) vs actual(pax) dilution variance
  8. Markups            ── staff salary (conditional on departures_in_month==1),
  │                        agent fee (channel-dependent), contingency %
  9. Price build        ── publish price per occupancy tier; net-price-to-agent seam
 10. Margin evaluate    ── budgeted margin (all agent-sourced) AND expected margin
  │                        (actual channel mix); guaranteed margin = package +
  │                        all-in ancillary only; floor/target check; distance-to-floor
 11. Warnings           ── TL cliff, small-group combined burden, coverage overlap,
  │                        below-floor (requires recorded override)
OUTPUT ── cost matrix, price matrix, margins, sensitivity, warnings
  │
FREEZE ── on publish/booking: CostingFrozen; all version ids pinned; immutable
```

Steps 5–10 are pure functions over immutable inputs, which makes the whole thing trivially testable (§18) and trivially re-runnable for "what-if" (§Simulation) — a scenario is just the same pipeline with one input swapped.

---

## 10. Future API integrations — against the existing seam

No new abstraction. Extend the Inventory namespace with sibling capability contracts, exactly as `SupportsContentSync` / `SupportsLiveInventory` were split:

| Source | Capability contract | Feeds | Status |
|---|---|---|---|
| RateHawk / TBO hotel live rates | `SupportsLiveInventory` (exists) | hotel `rate_card` (source=ratehawk/tbo) | adapter stubbed, awaits creds |
| pusattiket.com / GDS airfare | **`SupportsFlightPricing`** (new sibling) | airline/broker `rate_card` | **stub w/ ProviderNotImplementedException** until endpoints confirmed |
| Bank Indonesia FX | **`SupportsFxRates`** (new sibling) | FX **market watch only**, never costing | later |

Same discipline as `TboService`: unknown endpoints/payloads throw `ProviderNotImplementedException` — nothing fabricated. A manual `rate_card` row is always the baseline; an adapter merely writes `rate_card` rows tagged with its `source`. **Costing works with zero APIs connected** because it only ever reads `rate_card`, regardless of who wrote the row.

---

## 11. Admin workflow — building a costing, screen by screen

Built on the existing modal + Tailwind (maroon/cream) system. Sits behind `adminkantor`+ with an HPP ability (§17).

1. **Master data (one-time / occasional):** FX Policy screen (§6, versioned, audit); Vendor → Service-tier → Rate-card manager (§4); Coverage tags & visa ruleset (seed-managed, read-mostly).
2. **New Costing → Step 1 Departure basics:** pick package, planned pax, night split (Makkah/Madinah), arrival/return datetimes, departures-this-month, channel-mix default 90%.
3. **Step 2 Vendors & bundles:** choose visa vendor, handling tier (nasi_box/lounge/buffet), Saudi handler *or* LA bundle, insurer (departure-level, single), mutawwif or "covered by TL/LA." Live coverage panel shows OK/OVERLAP/GAP per tag (§5).
4. **Step 3 Ancillaries:** per product choose **all-in** or **optional** (+take-up %), region variant, venue tier for manasik.
5. **Step 4 Result:** cost matrix (pax × occupancy), publish-price matrix, **distance-to-floor headline**, budgeted vs expected margin, all warnings. TL-cliff and small-group burden banners.
6. **Step 5 Simulators (first-class, not reports):** scenario "what-ifs," **agent concession simulator** (free seats / keep fee / raise publish / absorb margin → instant new price + margin + floor verdict), **packaging comparison** (all-in vs stripped side-by-side).
7. **Publish:** writes published price → freezes snapshot → syncs base figure to `paket.harga` (§9.1 below).

### 9.1 The `paket.harga` seam — and a pushback

`paket.harga` is a single `float(16,2)`. But a real departure **sells several occupancy tiers at different prices simultaneously** (quad/triple/double/single). Feeding one scalar back loses that. Recommendation, additive:

- Keep `paket.harga` = the **headline (quad, at planned pax)** price for backward compatibility — the existing booking flow keeps working untouched.
- Add a new `costing_published_price(costing_id, occupancy, price)` table for the full matrix; the booking flow can adopt it later without a breaking change.
- Optionally add nullable `paket.night_makkah` / `paket.night_madinah` (additive) if you want the split intrinsic to the package row; otherwise it lives only on the `costing`. **See Q1/Q2.**

---

## 12. Reporting architecture

Events (§8) feed read-models; heavy reports are later phases but the fields exist now:
- **Packaging comparison** & **concession simulator** — live, not reports (§11).
- **Budget vs actual** — `costing_actual` vs frozen `costing_line`; variance per component/group/time. Tracks all-in attendance so favourable catering/bus variance is captured, not lost.
- **Working-capital exposure** (high-value, later) — every amount already carries a due-date offset (H-x); aggregate exposure = `Σ committed_outflows − Σ received_revenue` across **all open departures** at a date. Your "~11 departures simultaneously in deficit" is a sum query over data the engine already holds.
- **Critical-path alerting** (later) — payment offsets stored as H-x; alert against the **negotiated** date while showing the **contractual** date (§payment timing — both stored per vendor).

---

## 13. Versioning strategy

Three **independent** version axes, each pinned into every snapshot:
1. **FX policy** — `fx_policy_version`, one open, effective-dated.
2. **Rate cards** — append-only; supersede via `superseded_by`, never mutate.
3. **Coverage ruleset** — `visa_coverage_ruleset`, effective-dated, resolved by departure date.

A `costing` stores `fx_policy_version_id` + `visa_coverage_ruleset_id`, and each `costing_line` stores its `rate_card_id`. **Recalculating** a frozen costing re-reads *those pinned versions*, so reopening never silently applies today's rules — the exact failure mode you flagged. Snapshots protect stored results; pinned version ids protect recalculation.

---

## 14. Audit trail

- `audit_log` captures every FX change, rate-card supersession, coverage-ruleset change, and below-floor override: `old_json → new_json`, `user_id`, `ip`, `reason`, timestamp.
- Domain events (`FxPolicyRevised`, `RateCardSuperseded`, `MarginFloorBreached`) are the write triggers, so auditing is not something a developer can forget to call at each edit site.
- Every `costing` records `created_by`, `published_at`/`frozen_at`, and the version ids it pinned — full provenance for bank/management reporting.

---

## 15. Performance considerations

- The calculation is **small data** — a departure has ~20–30 components; a full matrix is a few hundred arithmetic ops. No caching needed for a single calc; snapshots are cached results.
- **Airfare dominates** (>50% of cost, Rp13–20jt). Sensitivity and any live-sourcing effort should weight there first; hotel is second. Everything else is rounding by comparison.
- Live provider sourcing (hotel/airfare) runs through the **existing queued Inventory jobs** — never inline in a costing request. Costing reads only local `rate_card`.

## 16. Scalability considerations

- A year of departures × components is thousands of rows, not millions — trivial for MySQL.
- Working-capital aggregate is an indexed sum over open departures; fine at company scale.
- The behaviour-strategy design means new vendors/terms are **data**, so the schema doesn't grow with the vendor list.

---

## 17. Security — mapped to real gates

HPP is the most sensitive data in the company. Findings from the codebase:

- Existing roles: `agen`, `superadmin`, `adminkantor`, base `admin`. **There is no commissioner/director/GM/agent-scoped-cost role today.**
- Existing gates: `IsSuperAdmin`, `IsAdminKantor`, `IsAgen` + fail-open `CheckMenuPermission`.

**Recommendation — an ability layer, not more middleware:**

| Surface | Gate / ability | Sees |
|---|---|---|
| Costing master data + build screens | `adminkantor` **+ ability `costing.manage`** | full HPP + margin |
| Margin/executive dashboards | new ability `costing.view_margin` (grant to komisaris/direktur/GM) | margin, not vendor-level HPP edit |
| Agent portal (existing `agen`) | **explicitly denied `costing.*`** | price & their own pilgrims only — **never HPP** |
| Public pages / customer API | no costing relations exposed at all | `paket.harga` only |
| Future B2B portal | `PricingView` DTO: net-price-to-agent only | never components |

- **Agent-scoped visibility** (agents see only their own pilgrims, never cost) is enforced at the query/policy layer, matching your oversight-structure description.
- Commissioner/Director/GM need **new roles or a capability grant** — flagged as Q5.
- **Structural leak prevention:** costing lives in its own `Models\Costing\` namespace and is never eager-loaded onto `Paket`'s public API resources. A Policy denies `costing.*` to `agen` and unauthenticated. The B2B seam only ever exposes a computed `net_price`, never a relation to `costing_line`.

---

## 18. Testing strategy

- **Golden master from the workbook.** Once you provide `Anggaran-Biaya-Produksi-Umroh.xlsx`, its Ringkasan/Sensitivitas worked examples become the acceptance oracle: the engine must reproduce them to the rupiah before we trust it. This is the single most valuable test asset.
- **Behaviour unit tests** (temp PHPUnit + `DatabaseTransactions`, deleted after passing, per project convention): mutawwif ÷20 = Rp562,500; farkiyah 12pax = 23×USD20, 41–44pax = nil; TL cliff at 46; transit-villa trigger on arrival<checkin; staff-salary only when departures_in_month==1; coverage overlap fires on visa+LA city tour.
- **Snapshot immutability tests:** freeze, then supersede a rate card / revise FX → frozen margin unchanged; recalculation uses pinned versions.
- **Security tests:** `agen` and guest receive 403 on every costing surface; public/API resources never serialise a costing relation.
- `php artisan test` green at each phase gate; `npm run build` after any new Blade classes.

---

## Phased implementation plan (approval gate at each end)

| Phase | Deliverable | Verification / gate |
|---|---|---|
| **0 (now)** | This proposal + your answers to the questions below | Your approval |
| **1** | FX policy master: versioned table, admin screen (§6 validate-vs-peg), audit, events | Temp tests: version pinning, peg guard; you approve the FX UX |
| **2** | Vendor / service-tier / rate-card master (§4) + coverage taxonomy + visa ruleset seed (§5). Seed from workbook rates | Tests: rate supersession, as-of resolution, coverage overlap/gap detection |
| **3** | Cost-component catalogue + behaviour strategies + `CostingEngine` (no UI) — **reproduce the workbook golden master** | Golden-master + behaviour unit tests pass to the rupiah |
| **4** | `Costing` snapshot, freeze-on-publish, per-occupancy price matrix, sync base → `paket.harga` (additive) | Immutability tests; existing booking flow regression-clean |
| **5** | Admin build-a-costing workflow (§11), packaging comparison, concession simulator, sensitivity — modal/Tailwind | Manual walkthrough + your sign-off on the screens |
| **6** | Ability layer + agent/exec visibility + HPP audit hardening (§17) | Security tests: agent/guest denied everywhere |
| **7 (later)** | Budget-vs-actual, working-capital exposure, FX realised-rate variance, critical-path alerting, B2B net-price seam | Per-feature, as prioritised |

Each phase is independently shippable and leaves the existing app fully working.

---

## Assumptions I had to make

1. The prose brief faithfully represents the workbook (unverified — file not received). All rates tagged **[from brief]**.
2. Each current `paket` row behaves as a *concrete departure* (it has dates + quota), so Phase 1–4 can anchor `costing.paket_id` 1:1 until/unless we split package-template from departure (Q1).
3. `kuota_jemaah` = planned pax driver; the engine treats it as an input, overridable per costing.
4. Contingency, administration, and office-operation lines exist in the Biaya Produksi sheet as percentages/flat amounts — exact values pending the file.
5. Group-level oversight roles (komisaris/direktur/GM) are not yet modelled and will need new roles or capability grants.

## Questions I need answered before Phase 1

- **Q1 (biggest): Package-template vs Departure.** Do we introduce a `keberangkatan`/Departure entity (one package → many monthly departures, each costed & frozen separately), or does each `paket` row remain one departure? This shapes the whole schema. My recommendation: introduce Departure additively, but let Phase 1–4 anchor to `paket` 1:1 and add the template split in a later phase.
- **Q2: Night split location.** Store `night_makkah`/`night_madinah` as additive nullable columns on `paket`, or only on `costing`? (Recommendation: on `costing` now; on `paket` only if the public package page must show the split.)
- **Q3: FX policy.** Confirm my validate-against-peg recommendation (§6) over pure-derivation, and the max-drift warning threshold (default 10%).
- **Q4: Tax.** What PPN / PPh 23 rates does your accountant apply, and to which lines (sell price vs vendor cost)? Nothing is seeded until you confirm.
- **Q5: Executive roles.** Add `komisaris` / `direktur` / `general_manager` roles, or grant a `costing.view_margin` ability to existing users? Who may record a below-Rp2m-floor override?
- **Q6: Mutawwif billable days.** Do we currently store real arrival/return **timestamps** per departure (needed to derive Saudi ground days ≠ package days)? If not, Phase 4 adds them.
- **Q7: Defaults to confirm** — free-seat divisor 35; channel mix 90% agent; margin floor Rp2jt / target Rp3jt; TL ratio 1:45; farkiyah floor 35 × USD 20; contingency %.
- **Q8: Handling Makkah–Madinah costing default** — pick a default within USD 75–100+ for the base rate card, or leave per-vendor only?
- **Q9: Ancillary take-up defaults** — manasik/equipment optional-mode take-up % assumptions (e.g. manasik ~60%?).
- **Q10: Workbook** — drop `Anggaran-Biaya-Produksi-Umroh.xlsx` into `storage/app/costing/` so Phase 3's golden master is real, not approximate.

---

*Nothing in this document is built yet. On your approval of the architecture and answers to the questions above, Phase 1 (FX policy master) begins.*

---

# Revision 2 — answers locked, addendums integrated, golden master captured (2026-07-23)

## Confirmed decisions (supersede the questions above)

- **Q1 — Departure is the costed unit.** `Package` = marketing template (duration, star tier, night split, itinerary). `Departure` = cost/price/margin/settlement. Refinement: **`Departure` → many `ticket_lot`s**, each with its own unit price, deposit %, deposit structure, and settlement deadline; blended cost/seat follows from the lots. Phase 1–4 may still anchor `costing.paket_id` 1:1 until the Departure/Package split lands.
- **Q3 — FX: validate against the peg** (not derive). USD is the input; SAR explicit; **block below peg-implied**, warn above ~+10%. Implemented in Phase 1.
- **Q4 — Tax: deferred.** Model configurable per vendor/component, **rates left empty**; owner populates after consulting the accountant. Nothing seeded.
- **Q5 — Roles:** add **`komisaris`** (full visibility incl. HPP + margin, oversight only), **`direktur`** (full visibility + approval/override), **`manajer_umum`** (full operational visibility). **`agen` must never see production cost or margin** even though agents sit in the departure coordination group. **Below-floor override = `direktur`, one-click, always-recorded, reason required** — designed as fast, not a workflow (it is routine in the endgame regime). Roles land in Phase 6.
- **Q6 — Store real arrival/return timestamps** on the departure (from the issued visa). Mutawwif billable Saudi days and the transit-villa trigger both derive from them, not from headline package days.
- **Q2, Q7–Q10:** proceed with recommended defaults (centralised in `config/costing.php`).

## Addendum 1 — risk & pricing (adds schema, highest priority)

- **90% materialisation cliff — the single largest financial risk.** Flight deposit forfeits if realised pax < 90% of seats booked (35 → boundary 32; at 31 the whole deposit burns, ~Rp144jt at 25% deposit). **Highest-priority alert in the system, shown more prominently than margin.** Confirm-later: whole-deposit vs pro-rata, and booked-vs-paid basis — model must express either. → fields on `departure`/`ticket_lot`: `seats_booked`, `materialisation_pct` (default 0.90), `materialisation_basis`.
- **Layered ticket deposits + contingent liability.** Deposit terms are a vendor contract attribute: %-or-flat, **multi-stage/layered** (e.g. Rp2jt token *then* ~30% balance), and **contingent liability on cancel** (cancelling can create a *debt*, not just a loss). Cancellation simulation must show true walk-away cost ≠ amount paid. → `ticket_deposit_stage` rows under `ticket_lot`.
- **Vendor eligibility is a blocking rule, not a note.** Never buy tickets from individuals; brokers must be incorporated companies; prefer airline-direct. Blocking validation on the ticket component with a **recorded director-level override**. (Roots: 2022 fraud, ~Rp2bn lost, loan still serviced.) → `vendor.is_incorporated`, `vendor.eligibility_status`; enforced in the ticket-purchase path (Phase 4+).
- **Two-regime margin.** Rp2jt floor is the **planning** rule. In the **endgame** (near departure, seats unsold, deposit sunk), the rule becomes **marginal contribution** — a seat may rationally sell at/below cost to protect the materialisation threshold. Engine **informs, never blocks**; display aggregate departure profit, next-seat marginal contribution, and distance-to-90% side by side. First lever when tickets are dear is **swap to a cheaper equal-star hotel**, not margin compression.
- **Waiting list** — first-class object on the departure; a cancellation auto-surfaces the next candidate; late demand visible when negotiating seat additions. Incremental seats priced higher (bought at a different rate).
- **Non-API hotel providers are first-class** (Maysan, Diar Al-Manasik, Victory, individual partners). Same property sold by several providers at different prices → provider×property many-to-many with provider-specific pricing. **Fits the existing `hotel_external_id` + vendor/rate-card model — no re-architecture.** Mitigate data-entry with rate-card import and quote-time-only entry (rates only for properties actually quoted).

## Addendum 2 — seasonality & overhead (corrects the brief)

- **~10-month operating year.** No Umrah departures in the Hajj months (~2 months, zero pilgrim revenue); no PIHK licence, so Hajj isn't a legal line yet. Fixed obligations continue.
- **Staff-salary rule in the brief is wrong.** The monthly-conditional Rp1jt assumes 12 productive months and under-recovers overhead ~17%. **Replace with an annual fixed-overhead pool ÷ expected annual pilgrims, applied uniformly**, with **running recovery-to-date** surfaced during the year. Corrected figure ≈ Rp1.2jt/pax. → new `overhead_pool` (annual) + `overhead_recovery` tracking (Phase 3/7). Annual **halal bihalal** and similar belong in the pool.
- **Cash-flow module is annual with a known, structural revenue gap** (the Hajj-window trough is predictable → project it far enough ahead to act). Placement fees from routing pilgrims to licensed PIHK operators are a small capturable offset.
- **PIHK licensing** joins IATA as a future milestone — don't hard-code Umrah-only or a 12-month calendar.

## Golden-master baseline (from `storage/app/costing/Anggaran-Biaya-Produksi-Umroh.xlsx`)

Inputs: 35 pax, 0 free seats, 9 package days, **8 Saudi ground days**, 4 Madinah + 4 Makkah nights, quad (÷4), USD Rp18,000, SAR Rp5,000. Phase 3 must reproduce these to the rupiah:

| Output | Value |
|---|---|
| Total production cost / group | **Rp 1,174,975,000** |
| Production cost / pilgrim | **Rp 33,570,714.2857** |
| + staff salary Rp1,000,000 + agent fee Rp1,500,000 → total burden / pilgrim | **Rp 36,070,714.2857** |
| Publish price / pilgrim | Rp 39,500,000 |
| Package margin / pilgrim | **Rp 3,429,285.7143** |
| Expected margin (agent mix 90%) = margin + 1,500,000×0.10 | **Rp 3,579,285.7143** |
| TL surplus @35 pax / @46 pax | **+Rp 7,000,000 / −Rp 10,000,000** |
| Min publish price to clear Rp2jt floor | Rp 38,070,714.2857 |

Component rates confirmed by the sheet (workbook overrides brief where they differ): flight Rp16,500,000/pax; Makkah hotel Rp4,750,000/room-night, Madinah Rp4,000,000; visa USD 140 (bundles ground+city-tour+Taif); tasreh SAR 30; mutawwif SAR 250 × **8 ground days** ÷ pax; TL allocation Rp1,000,000/pax with TL-seat test cost Rp28,000,000; extra LA Rp500,000; transit villa Rp150,000/pax (switch); CGK handling Rp150,000 × 2 legs; **handling Makkah–Madinah USD 75** (low end chosen); insurance Rp65,000; administrasi Rp250,000; operasional kantor Rp500,000; **contingency Rp1,000,000/pax**. Ancillary (all-in): equipment/manasik **Rp2,000,000 cost / Rp2,500,000 sell**, Indonesia bus Rp200,000/Rp300,000; (optional) vaccine Rp500,000/Rp650,000 @60%, passport Rp150,000/Rp350,000 @30%, merchandise Rp200,000/Rp350,000 @40%. Sheet's SAR consistency check = 18000/3.75 = 4,800 (policy 5,000 = ~4% buffer) — exactly the Phase 1 peg guard.

**Staff-salary tension:** the workbook still uses the old flat Rp1jt. The golden-master test reproduces the workbook by treating staff-salary-per-pilgrim as an *input*; the overhead module (Addendum 2) computes that figure from the annual pool and is tested separately, so both stay honest.

## Phase 1 — build record (this revision)

Delivered: `fx_policy_version` (versioned, effective-dated, peg column) + generic `audit_log`; `App\Models\Costing\{FxPolicyVersion,AuditLog}`; `App\Services\Costing\Fx\FxPolicyService` (current/forDate/policyFor/**validatePeg**/revise) + `Support\{FxPolicy VO, AuditLogger}` + `Exceptions\FxPolicyException` + `Events\Costing\FxPolicyRevised`; `config/costing.php` defaults; admin screen `/admin/fx-policy` (modal-based revise with live implied-SAR, peg block returns inline 422, history + audit trail); seeded USD 16,500 (closed) → USD 18,000 (open). Peg guard: **block SAR below `usd/3.75`**, warn above +10%.

**Gate correction (owner review):** revising the FX rate shifts every production cost at once → it is a **superadmin** action, not adminkantor. Read is open to any office admin (costing screens need it); the revise route is wrapped in the `superadmin` group and the revise button/modal render only for `is_superadmin`. Relocates to `direktur` once executive roles land (Phase 6).

## Phase 2 — build record (vendor master, rate cards, coverage taxonomy)

Delivered (all additive): tables `coverage_tag`, `cost_component`, `visa_coverage_ruleset`, `vendor`, `vendor_service`, `rate_card`; models `App\Models\Costing\{CoverageTag,CostComponent,VisaCoverageRuleset,Vendor,VendorService,RateCard}`; services `Coverage\CoverageResolver` (+`CoverageProvider`/`CoverageResolution` VOs) and `Rates\RateResolver` (+`ResolvedRate` VO); seeders `CoverageTagSeeder`, `CostComponentSeeder` (23 components), `VisaCoverageRulesetSeeder` (2023 pre-Taif → 2025 Taif-free), `BaselineRateCardSeeder`, orchestrated by `CostingDatabaseSeeder`.

Key decisions realised:
- **Eligibility is per-component, not per-vendor.** `cost_component.requires_incorporated_vendor` / `rejects_individual_vendor`; only `tiket_pesawat` sets both (the 2022 rule). `CostComponent::allowsVendor()` — individuals pass for hotels, fail for tickets. Vendor legal-entity fields are descriptive only.
- **Payment/bridging is first-class on the vendor** (`deposit_*`, `deposit_is_layered`, `contingent_liability_on_cancel`, `payment_rigidity`, `will_bridge_payment`, `bridging_window_days`, `bridging_ceiling`) — carried now for Module 2's supplier-credit-vs-cost-of-capital comparison; enforcement in Phase 4. `is_related_party` for internal catering (reporting only).
- **Provenance: baseline vs contracted.** `rate_card.source`; baseline rates carry no vendor and link to a component; `RateResolver::resolve()` prefers a contracted vendor rate and falls back to baseline **flagged**; `componentsOnBaseline()` is the "still on assumption, no quote" report. Baseline never overwritten.
- **Coverage resolver detects overlap + gap** (overlap is the normal case): visa (effective-dated ruleset) + LA both covering `city_tour` → overlap; an uncovered required tag → gap. Non-API hotel providers modelled as `vendor_service.hotel_id` → the same property sold by many providers at different prices, reusing the hotel master.

Verified (6 temp tests, 43 assertions, since deleted): baseline reproduces workbook to the rupiah (visa USD 140, tasreh SAR 30, mutawwif SAR 250, handling USD 75, flight Rp16.5jt, farkiyah USD 20); contracted beats baseline; per-component eligibility; overlap/gap detection; visa effective-dating (no Taif 2024, Taif 2026); baseline report. Full suite green, `npm run build` OK.

**NEXT — Phase 3:** cost-component behaviour strategies + `CostingEngine`, reproducing the workbook golden master (Rp1,174,975,000 / Rp33,570,714.29 per pilgrim / margins / TL cliff) to the rupiah. No UI.

