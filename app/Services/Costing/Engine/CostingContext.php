<?php

namespace App\Services\Costing\Engine;

use App\Services\Costing\Support\FxPolicy;
use InvalidArgumentException;

/**
 * Immutable set of inputs for one departure's costing. Behaviours read only from
 * here, so a costing is a pure function of its context — trivially re-runnable
 * for "what-if" and sensitivity. Build via CostingContextFactory (merges
 * config defaults); never mutate — vary an input by building a fresh context.
 */
final class CostingContext
{
    public function __construct(
        public readonly string $costingDate,   // resolves rate cards + visa ruleset as-of
        public readonly int $payingPax,
        public readonly int $freeSeats,
        public readonly int $nightMakkah,
        public readonly int $nightMadinah,
        public readonly int $occupancy,
        public readonly int $saudiGroundDays,
        public readonly FxPolicy $fx,
        public readonly float $publishPrice,
        public readonly float $channelMixAgentPct,
        // switches
        public readonly bool $transitVilla,
        public readonly bool $handlingBundledLA,
        public readonly bool $mutawwifFreeFromHandler,
        // operational rule params
        public readonly int $farkiyahFloor,
        public readonly int $tlRatio,
        public readonly float $tlAllocation,
        public readonly float $tlSeatCost,
        public readonly int $freeSeatDivisor,
        public readonly float $marginFloor,
        public readonly float $marginTarget,
        // materialisation (Addendum 1)
        public readonly int $seatsBooked,
        public readonly float $materialisationPct,
        // staff-salary resolution (Addendum 2)
        public readonly string $staffSalaryMode,     // 'flat' | 'pool'
        public readonly float $staffSalaryFlat,
        public readonly ?float $overheadAnnualPool = null,
        // Divisor split so the 10-vs-12-month decision is explicit (Addendum 2).
        public readonly ?int $departuresPerYear = null,
        public readonly ?int $pilgrimsPerDeparture = null,
        // Procurement & tier (Addendum 3).
        public readonly string $procurementMode = 'block',  // 'block' | 'on_demand'
        public readonly bool $tlOptIn = false,              // on-demand: TL only if requested
        public readonly string $packageTier = 'standard',
        public readonly string $materialisationBasis = 'booked', // booked | paid | flown
    ) {}

    public function totalPax(): int
    {
        return $this->payingPax + $this->freeSeats;
    }

    public function isOnDemand(): bool
    {
        return $this->procurementMode === 'on_demand';
    }

    /** Whether a tour leader is budgeted: always for block; on-demand only if opted in. */
    public function tlApplicable(): bool
    {
        return ! $this->isOnDemand() || $this->tlOptIn;
    }

    public function nights(string $key): int
    {
        return match ($key) {
            'makkah' => $this->nightMakkah,
            'madinah' => $this->nightMadinah,
            default => throw new InvalidArgumentException("Unknown nights key [{$key}]."),
        };
    }

    public function days(string $key): int
    {
        return match ($key) {
            'saudi_ground' => $this->saudiGroundDays,
            default => throw new InvalidArgumentException("Unknown days key [{$key}]."),
        };
    }

    /** Boolean context switch referenced by a component's activate/suppress param. */
    public function flag(string $name): bool
    {
        return match ($name) {
            'transit_villa' => $this->transitVilla,
            'handling_bundled_la' => $this->handlingBundledLA,
            'mutawwif_free' => $this->mutawwifFreeFromHandler,
            default => throw new InvalidArgumentException("Unknown context flag [{$name}]."),
        };
    }
}
