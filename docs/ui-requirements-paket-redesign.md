# UI requirements — package screens and shared pickers

> For the post-Phase-6 redesign pass. Supplements the constraints already recorded: no nested modals, master-detail preferred, and the deferred Phase 5 items (live coverage overlap/gap panel, vendor-service selection UI).

---

## 1. Replace reference dropdowns with searchable pickers

Airline and hotel selection must become **type-ahead search**, not `select` dropdowns.

**Airlines.** There are far too many to scan visually. The user should type and see the list narrow as the text fills in.

**Hotels.** More urgent still — there are thousands of properties across Makkah and Madinah. A dropdown is not merely inconvenient here, it is unusable. Typing "ajyad" should surface every Ajyad property.

**This also resolves a performance finding.** The show page currently runs `Maskapai::all()` for 300 full rows on every visit, whether or not the package has any flights, alongside similar `::all()` calls for Kantor, Ekstra, Hotel and Agen. A search picker loads **nothing** up front and queries only on input, returning only matches. The UX fix and the performance fix are the same change — implement it once, in a shared component.

Requirements for the picker: server-side search against an indexed column, debounced input, a sensible result cap, keyboard navigation, and correct behaviour when editing an existing record whose current selection must be displayed without a search having run.

## 2. Hotel labels must disambiguate

A bare hotel name is ambiguous. Label as:

```
Al-Shafwah — Mekkah · ⭐4
```

**City is mandatory** — Makkah versus Madinah is the single most important distinction and its absence makes the list genuinely confusing.

**Star rating should also appear.** Package tiers are chosen by star level constantly — 3-star for budget, 4-star for standard, 5-star ring 1 for premium — so it belongs in the label rather than requiring a second look-up. The data already exists in the hotel master from the Phase-2 schema.

Where distance or ring information is available, consider it as a third element, but city and stars are the required minimum.

## 3. Choose the thing first, the provider second — for hotels *and* flights

**Critical, and easy to get wrong.** This is how the business actually works, in both domains.

**Hotels.** The same property is sold by several providers at different prices — Anjum is available through Diar Al-Manasik, Maysan and Ustadz Juhri, each at their own rate. When a user types "anjum", the picker must return **one entry**, not three. A hotel is a property in the `hotel` table; who supplies it is a separate decision made afterwards through `vendor_service`.

**Flights follow the identical pattern.** Demand is assessed from agent requests and market analysis, an **airline** is chosen — Saudia, Garuda, IndiGo — and only then is a source selected: direct through the airline's official channel (e.g. Ayuberga for Saudia) or through a broker such as Inatagroup, Umroh.com, Marwah or Flyfursan. Typing "saudia" must return **one entry**, not one per broker.

The correct order in both cases is: choose the product, then compare who supplies it. Returning one row per provider inverts that — it forces the user to know every provider's price before they can even pick a hotel or an airline, and it makes the list unusable at scale.

**One structural difference between the two, which matters for the schema.** Hotel provider offers are relatively stable. **Flight provider offers are attached to a date.** Saudia in March and Saudia in July are entirely different prices — ticket rates move every month, and that variability is the dominant driver of package cost. So flights need three levels rather than two:

```
airline  →  departure date  →  provider offer
```

A two-level model borrowed from hotels will collide across months. Rate cards for flights must be keyed to the airline **and** the date or date range, not to the airline alone.

**Check whether `vendor_service` supports this.** Phase 2 built it with `hotel_id` to map a service to a property. Confirm there is an equivalent path for airlines, and if not, add one before any flight rate data is entered. Consider whether a generic sellable-item reference is cleaner than accumulating one nullable foreign key per product type.

**Note on vendor eligibility.** Every flight source named above — Ayuberga, Inatagroup, Umroh.com, Marwah, Flyfursan — is an incorporated company, so the component-level rule barring individual vendors from ticket purchase blocks none of them. The rule protects without obstructing. These are good candidates to seed as the first real flight vendors.

## 4. Build the pickers as shared components

The same airline and hotel pickers are needed in at least three places: the package management screens, the costing wizard, and the deferred vendor-service selection UI. Both should share a single underlying pattern — search the product, then choose the provider — since the interaction is identical even though the underlying tables differ.

Build them once as shared components. Two independently written hotel pickers will drift in labelling, search behaviour and provider handling, and the inconsistency will be visible to users moving between the costing wizard and the package screens.

## 5. After Phase 10, the package screen's role changes

This is more than cosmetic and should shape the redesign now rather than being retrofitted.

Once costing is live, `paket.harga` is **derived from the costing snapshot**, not typed by a user. The package screen stops being where price is decided and becomes where the **product is defined** — duration, night split, star tier, itinerary, inclusions. Price arrives from costing.

Design accordingly:

- The price field becomes **read-only**, showing the synced value with a **link to the costing that produced it**, and an indication of when it was last synced.
- No path should allow a staff member to type a price that silently overwrites a costed figure. If a manual override is ever needed it must be explicit and recorded, consistent with how the below-floor override behaves.
- Where a package has **no costing yet**, say so plainly rather than presenting an empty editable field that invites a guess.
- The full per-occupancy price matrix lives in `costing_published_price`; `paket.harga` carries only the quad headline for backward compatibility. The package screen should surface the whole matrix rather than implying the headline is the only price.

## 6. Layout, restated

Master-detail — list on one side, detail on the other — remains the preferred approach. It satisfies both goals at once: no page-to-page navigation, and no rendering every row's editing surface up front. One editing surface is reused as the selection changes, which means one pair of rich-text editors for the entire screen instead of two per row.

No nested modals under any circumstances.
