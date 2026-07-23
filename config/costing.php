<?php

/**
 * Costing engine defaults. Centralised so the confirmed policy magnitudes live
 * in one place instead of "in people's heads." Values below are the confirmed
 * defaults from the brief + the Anggaran-Biaya-Produksi-Umroh workbook; per
 * costing they can be overridden on the departure.
 */
return [

    // Fixed FX costing policy (Phase 1). Never a market rate.
    'fx' => [
        // SAR is pegged to USD at 3.75. FxPolicyService blocks any SAR rate
        // below usd_idr / peg (that would erase the safety buffer) and warns
        // when SAR sits more than sar_buffer_warn_pct above the peg-implied value.
        'peg_sar_per_usd' => 3.75,
        'sar_buffer_warn_pct' => 0.10,
    ],

    // Margin guardrails (Phase 3+). Planning regime; the endgame regime
    // (marginal contribution) is informational and never blocks — see addendum 1.
    'margin' => [
        'floor' => 2_000_000,     // absolute minimum per pilgrim
        'target' => 3_000_000,    // comfortable/safe per pilgrim
    ],

    // Operational rule defaults (Phase 3+).
    'defaults' => [
        'free_seat_divisor' => 35,        // free seats diluted over this, at publish price
        'channel_mix_agent_pct' => 0.90,  // ~90% of pilgrims come through agents
        'tl_ratio' => 45,                 // Saudi regulation: 1 tour leader per 45 pax
        'tl_allocation' => 1_000_000,     // budgeted TL levy per pilgrim
        'tl_seat_cost_estimate' => 28_000_000, // cost of one TL seat (~1 pilgrim's production) for the sufficiency test
        'farkiyah_floor' => 35,           // minimum billed seats (ground transport)
        'farkiyah_rate_usd' => 20,        // USD per seat below the floor
        'materialisation_pct' => 0.90,    // flight deposit forfeits below this (addendum 1)
        'occupancy' => 4,                 // quad base
        'staff_salary_flat' => 1_000_000, // the workbook's per-pilgrim figure (used as an explicit override)
    ],

    // Budget/promo three-scenario band (Addendum 4 §3). Promo economics swing on
    // whether cheap ticket/hotel inventory is actually secured (Feb-2025: IndiGo
    // ~Rp9jt turned a projected Rp900k margin into Rp1.5jt). Expected values and
    // the pessimistic/optimistic band are editable; owner to tune.
    'scenario_band' => [
        'ticket_expected' => 12_000_000,     // promo transit carrier (mid)
        'hotel_makkah_expected' => 3_500_000, // 3-star (mid)
        'hotel_madinah_expected' => 3_000_000,
        'ticket_up' => 0.25,    // pessimistic: fare rises
        'ticket_down' => 0.25,  // optimistic: cheap fare secured (e.g. IndiGo)
        'hotel_up' => 0.20,
        'hotel_down' => 0.20,
    ],

    // FX policy-vs-market watch (Addendum 4 §Phase-5). Warn when the policy rate
    // has fallen below market by more than this — costings then understate cost.
    'fx_market_warn_pct' => 0.00,   // any policy-below-market is flagged

    // Private quotation validity window (days) before a reopen warns.
    'quotation_valid_days' => 14,

    // Staff-salary / overhead absorption (Addendum 2). PRODUCTION uses the annual
    // pool ÷ expected annual pilgrims; the flat figure above is an explicit,
    // labelled override. Pool figures are left null until the owner confirms them
    // — with the pool unset, the engine falls back to the flat override and says so.
    'overhead' => [
        'mode' => 'flat',                 // 'flat' | 'pool' — default until the pool is configured
        'annual_pool' => null,            // total annual fixed overhead (salaries, bank, ops, utilities, annual events)
        // Divisor is split into two EXPLICIT inputs so the ~10-month year is a
        // conscious choice, not "monthly capacity × 12" entered by reflex.
        'departures_per_year' => 10,      // Hajj months carry no departures (Addendum 2)
        'pilgrims_per_departure' => null, // expected average; divisor = departures × pilgrims
    ],
];
