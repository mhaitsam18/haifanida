<?php

namespace App\Services\Costing\Engine;

/**
 * The tour-leader step test: 1 TL per tl_ratio pax, each seat ~ one pilgrim's
 * production cost, funded by the per-pilgrim allocation. Surplus turns negative
 * the moment a step is crossed (the cliff at 46 on a 45 ratio).
 */
final class TlSufficiency
{
    public function __construct(
        public readonly int $required,
        public readonly float $seatCost,
        public readonly float $collected,
        public readonly float $surplus,
        /** Pax at which this step count becomes self-funding again (surplus ≥ 0). */
        public readonly int $selfFundingAt,
    ) {}

    public function inDeficit(): bool
    {
        return $this->surplus < 0;
    }
}
