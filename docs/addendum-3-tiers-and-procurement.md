# Addendum 3 — Package tiers, procurement modes, and what the standard profile is not

> Hand to Claude Code before Phase 4 begins. One item is a live defect in the current stepped-cost rule.

---

## 1. The workbook models one tier, not the business

The figures in `Anggaran-Biaya-Produksi-Umroh.xlsx` — Rp16,500,000 flights, 4-star hotels, Rp38,000,000 publish — describe our **standard package** and nothing more. It is the most common profile, which is why it makes a good golden master, but it must never become a default that anchors the engine.

We build several genuinely different products:

| Tier | Flight | Hotel | Handling | Typical publish |
| --- | --- | --- | --- | --- |
| Budget ("sendal jepit") | Transit, low-cost — e.g. IndiGo around Rp10,000,000 | 3-star | Standard | ~Rp30,000,000 |
| Standard | Direct | 4-star | Standard | ~Rp38,000,000 |
| Premium | Direct, Saudia or Garuda | 5-star, ring 1 Makkah | Premium | Rp45,000,000–50,000,000 |
| Private | Business class, **FIT ticket** | Luxury, e.g. Safwah with Kaaba view | Limousine or GMC | **Not published** — estimated above Rp50,000,000, typically Rp70,000,000–100,000,000 |

Premium is built when demand supports it, not as a standing product. Private is sold to small family groups — five people is typical — and there is real demand at that price.

**Design implication.** Introduce a **package tier / profile** as a template above the departure: a named set of default component tier selections that a new departure is created from. The departure still owns its own rates and costs; the tier just determines which vendor service levels it starts with. Every rate in the workbook belongs to the standard tier and should be seeded as such, never as a global default.

## 2. Prices move every month — this is the normal case

Air fares differ every month. Hotel rates move seasonally, with Ramadan notably more expensive. We do not build the same specification every month either.

Nothing here requires new mechanisms — departure-level costing, effective-dated rate cards and seasonal validity already cover it. But treat monthly variation as **the expected condition rather than an exception**. Any behaviour that assumes a stable price between departures, or that carries a figure forward as a default, is wrong.

## 3. Procurement mode — private umroh breaks the risk model

This is the structural gap and it matters more than the pricing.

Everything built around ticket risk — the 90% materialisation threshold, deposit forfeiture, unsold-seat exposure, seat blocks and their lots — rests on one assumption: **we buy the seats first and sell them afterwards.**

Private umroh inverts this. There is **no advance ticket block.** It works like an open trip: an order arrives, and only then do we buy. Consequently a private departure has **no deposit at risk, no materialisation threshold, and no unsold-seat exposure.**

**Add a procurement mode to the departure**, with at least two values:

- **Block-based** — group seats purchased in advance under a block contract. The full ticket-risk model applies: deposit terms, materialisation threshold, deposit-at-risk, seat lots, waiting list.
- **On-demand** — **FIT tickets** purchased against a confirmed order, not group tickets. Published fare, ticketed on purchase, no block. The ticket-risk model does not apply and must not be displayed. Showing a materialisation warning on a departure that carries no such risk trains people to ignore warnings that do matter.

The FIT-versus-group distinction is also the reason private packages are expensive: we pay published individual fares rather than negotiated block rates. Model ticket type on the lot, since it drives both price and risk behaviour.

Farkiyah still applies to on-demand departures exactly as specified: a group of five incurs (35 − 5) × USD 20. That was already confirmed — the handler must still provide a vehicle, GMC or otherwise, regardless of group size.

**Private departures have no fixed date until the customer sets one.** They are genuinely open trip: an inquiry arrives, the trip is configured, and a date is agreed. Do not assume a departure exists on a published calendar before it is sold.

## 4. Defect — the stepped tour leader rule over-charges small groups

The current rule requires `ROUNDUP(pax ÷ 45)` tour leaders. **For five pilgrims this returns 1**, so the engine charges a full tour leader seat of roughly Rp28,000,000 against an allocation of only Rp5,000,000 — a Rp23,000,000 phantom deficit on a departure that is in fact highly profitable. The workbook's sensitivity table has the same flaw at its low end.

The Saudi regulation is a **ceiling** — no more than 45 pilgrims per tour leader — not a floor requiring every group to carry one.

**The fix is procurement mode, not a pilgrim-count threshold:**

- **Block-based departures:** the tour leader step is **rule-triggered** by the 1-per-45 ceiling, exactly as built.
- **On-demand (private) departures:** the tour leader is **opt-in and off by default.** Private groups do not normally take one; the duty falls to the family head or a leader among them. When a customer specifically requests a tour leader, it is budgeted like any other selected component.

**The mutawwif / tour guide is the inverse and must not be confused with it.** In the standard package a TG is optional and can be absorbed by a qualifying TL. In a private departure **a mutawwif is always present in the holy land** — it is the tour leader that is absent, not the guide. Make sure the "covered by TL" option cannot zero the mutawwif on an on-demand departure.

## 5. Private umroh is a quotation flow, not a publish flow

**This affects the Phase 5 UI scope and needs to be known before that phase is designed.**

Private prices are **never published.** The product is fully customisable — hotel, airline and cabin class, vehicle, whether a tour leader is included, whether a guide is included, and anything else the customer asks for. **The price only exists after consultation.** The most we quote in advance is an indicative floor of "above Rp50,000,000", and that figure moves with every customisation.

So the standard flow — publish a package, market it, fill the seats — does not apply. Private runs as: **inquiry → configure components → cost → apply margin → issue a quote → agree a date → purchase.**

Phase 5's costing wizard should be built so this is a **mode of the same wizard**, not a second application built later. The underlying costing engine is identical; what differs is that there is no published price, no seat block, no materialisation panel, and the output is a customer quotation rather than a price matrix on a marketed package.

## 6. Open question — should the margin floor vary by tier?

The Rp2,000,000 floor was stated with the standard package in mind, where it is roughly 5% of the publish price. Across the **published** tiers it behaves inconsistently:

- Budget at Rp30,000,000 → 6.7%
- Standard at Rp38,000,000 → 5.3%
- Premium at Rp50,000,000 → 4.0%

Private sits outside this entirely, since there is no published price to measure a percentage against — its margin is set per quotation.

**Ask me to set the policy** rather than assuming one. The likely shapes are a floor defined per tier, or a floor expressed as *the greater of* an absolute amount and a percentage of price. Build whichever mechanism can express both, apply it to published tiers, and treat private as a **per-quotation target margin** instead. Surface which rule is in force wherever the floor check appears, consistent with how `staffSalaryRule` already reports itself.
