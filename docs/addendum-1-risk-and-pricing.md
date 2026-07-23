# Addendum 1 — Risk structure, ticket procurement, and the pricing endgame

> Hand this to Claude Code at the next phase approval gate. It supplements the main costing engine brief; nothing here contradicts it.

---

## 1. Where the risk actually lives

In a correctly managed Umrah operation, **the only structural loss is the flight deposit.** Everything else is recoverable:

- **Hotels are safe.** We block a number of rooms and may materialise fewer; the money stays as credit with the hotel and can be rescheduled to another check-in date. Even when an individual pilgrim fails to depart, their hotel money is preserved rather than lost.
- **Visas are applied for after pilgrim payment has been collected**, so they carry no forward exposure in normal operation.
- **Tickets carry all of it.** Air tickets are roughly 60% of production cost, and the deposit on them is the one payment that can vanish.

Beyond this sit genuine tail risks — flight delays, war, airport closure, a vendor absconding after payment — which are not modellable but should not be assumed away either.

**Design implication:** risk reporting should not spread attention evenly across components. It should concentrate on the ticket position, because that is where essentially all controllable loss is.

## 2. The 90% materialisation threshold — the single largest cliff in the business

**The flight deposit is forfeited automatically if materialisation falls below 90% of the seats booked.**

On a 35-seat block that boundary sits at 32 pilgrims. At 31, the entire deposit burns. At a 25% deposit on a Rp16.5 million ticket across 35 seats, that is roughly **Rp144 million lost for being one pilgrim short** — two orders of magnitude larger than the farkiyah shortfall at comparable group sizes, and far larger than the tour leader step at 46.

Requirements:

- Model it as a **hard threshold with the highest alert priority in the system.** Distance to the materialisation floor should be the most prominent figure on any departure screen — more prominent than margin.
- Alerting must escalate as the departure date approaches while the threshold is unmet.
- **Confirm with the owner** whether forfeiture is the entire deposit or pro-rated to the shortfall, and whether the 90% is measured against seats booked or seats paid. The design should be able to express either.
- Because the deposit is sunk once paid, the threshold changes what counts as a rational decision near departure — see section 5.

## 3. Ticket deposit structures and contingent liability

Deposit terms vary substantially by vendor and are themselves a risk variable, not merely a cash-timing detail:

- **Airline direct:** typically 20–25%.
- **Broker, conventional:** 40–50% in some cases.
- **Broker, low-entry:** some offer as little as Rp2,000,000 per pilgrim. This is attractive because it secures seats with minimal capital, but **it is a token, not a full deposit.** The normal deposit remains around 30%, layered behind it. If we cancel, we forfeit the token *and* owe the balance of the deposit — cancellation creates a debt rather than merely a loss.

Model deposit terms as vendor contract attributes supporting: percentage or flat amount, **layered/multi-stage deposits**, and **contingent liability on cancellation**. A cancellation simulation must show the true cost of walking away, which is not always equal to what has been paid.

Note also that aggressive low-deposit offers usually indicate a broker raising working capital through cross-subsidy. This is safe for them and should be treated as a counterparty-risk signal on our side.

## 4. Vendor eligibility rules — encode them, do not merely document them

In 2022 the company purchased 160 tickets from a fraudulent individual provider. **Rp1.6 billion was lost in seconds, together with roughly Rp500 million of visas that were voided — approximately Rp2 billion in total.** The company borrowed from a bank in order to still fly every affected pilgrim, and that loan is still being serviced.

The resulting procurement policy is absolute:

- **Never purchase tickets from individuals.**
- **Brokers must be incorporated companies.**
- **Prefer airline direct wherever possible**, and treat broker purchase as an exception justified by the airline allocation being sold out or by a materially better price.

Implement these as **enforced vendor eligibility rules on the ticket component** — a blocking validation with an explicit, recorded override at director level, not a note in a field. The rule exists precisely so that a future staff member who did not live through 2022 cannot breach it unknowingly.

## 5. The pricing endgame — the margin floor has two regimes

The Rp2,000,000 margin floor in the main brief is a **planning** rule. Near departure, with the deposit already sunk and the materialisation threshold approaching, the correct decision rule changes. Both regimes must be supported.

**Planning regime** — while the departure is being priced and marketed. The Rp2m floor applies as specified.

**Endgame regime** — close to departure with seats unsold. The relevant question becomes **marginal contribution**, not per-seat margin:

- Margin may be compressed to Rp2m, then toward zero, to fill remaining seats.
- **A seat may rationally be sold at a loss**, provided aggregate departure profit stays positive and the sale protects the materialisation threshold.
- The engine must **inform this decision, never block it.** Display: aggregate departure profit, marginal contribution of the next seat, and distance to the 90% threshold, side by side.

**Cost-reduction lever order.** When tickets are expensive, the first lever is not margin — it is **substituting a cheaper hotel of equivalent star rating.** Margin compression comes second. The engine should support this explicitly: hold star rating constant and re-quote across available properties and providers.

## 6. Upward pricing, seat additions, and the waiting list

Demand does not stop when the block fills:

- **Once the block is full and demand continues, the price must rise**, because incremental tickets are bought at a different, usually higher, price than the original block.
- **Adding seats late is constrained on two sides**: availability must be confirmed with both the ticket vendor and the hotels. Either can block the addition.
- A **waiting list** matches late demand against cancellations and possible seat additions. Model it as a first-class object linked to the departure, so that a cancellation automatically surfaces the next candidate and so that late demand is visible when negotiating additional seats.

## 7. Hotel sourcing — non-API providers are first-class, not a fallback

Hotels are sourced from **hotel providers, most of which have no API**: Maysan, Diar Al-Manasik, Victory, and long-standing individual partners such as Mas Iki and Ustadz Juhri, several with over a decade of relationship with the company.

Key characteristics:

- **Provider catalogues overlap and diverge simultaneously.** The same property — Anjum, for example — is sold by Diar Al-Manasik, Maysan and Juhri at *different prices*. Provider and property are therefore a many-to-many relationship with provider-specific pricing.
- This **fits the existing design and requires no re-architecture.** The `hotel_external_id` table already maps one property to multiple provider identities, and the vendor plus rate-card model already supports multiple suppliers per component with independent pricing. Extend these rather than introducing a parallel structure.
- **Manual providers must be first-class citizens**, ranked and quoted alongside API-sourced inventory — not a degraded fallback used when an API is unavailable. In practice they are often the better commercial option.
- **Acknowledge the data-entry burden.** Requiring admins to hand-enter every provider's full catalogue is unrealistic. Mitigate with rate-card import, and by requiring rates only for properties actually being quoted rather than for entire catalogues up front.

## 8. Note for the future B2B module

The provider-to-hotel structure described in section 7 is structurally the same thing a hotel consolidator operates. Building it for internal use is therefore also a rehearsal for operating as one. Keep the schema clean enough that a provider-side view — our own inventory, sold outward — could be added later without redesign.
