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
    ) {}
}
