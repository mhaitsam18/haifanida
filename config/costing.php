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
        'farkiyah_floor' => 35,           // minimum billed seats (ground transport)
        'farkiyah_rate_usd' => 20,        // USD per seat below the floor
        'materialisation_pct' => 0.90,    // flight deposit forfeits below this (addendum 1)
    ],
];
