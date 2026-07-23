<?php

namespace App\Services\Costing\Engine;

/**
 * The single largest financial cliff (Addendum 1): the flight deposit forfeits
 * if realised pax fall below a threshold percentage of seats booked. In phase 3
 * we compute the percentage and the breach; the rupiah at risk is filled in once
 * deposit terms are wired (phase 4), so depositAtRisk is null for now.
 */
final class Materialisation
{
    public function __construct(
        public readonly int $seatsBooked,
        public readonly int $realised,
        public readonly float $pct,
        public readonly float $thresholdPct,
        public readonly bool $breached,
        public readonly ?float $depositAtRisk = null,
        // On-demand (private/FIT) departures buy against a confirmed order, so
        // there is no block, no threshold and no deposit at risk — the whole
        // model is inapplicable and must not be displayed (Addendum 3).
        public readonly bool $applicable = true,
        public readonly ?string $basis = null, // booked | paid | flown — visible so a default isn't mistaken for contract
    ) {}
}
