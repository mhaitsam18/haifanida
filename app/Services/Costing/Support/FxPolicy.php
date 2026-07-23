<?php

namespace App\Services\Costing\Support;

use InvalidArgumentException;

/**
 * Immutable value object: the FX policy in force for a costing, captured from a
 * specific FxPolicyVersion. Downstream cost behaviours convert foreign amounts
 * to IDR through this — never by reading config or the DB again — so a costing's
 * currency conversion is frozen the moment it is built. Mirrors the readonly DTO
 * style of the existing Inventory anti-corruption boundary.
 */
final class FxPolicy
{
    public function __construct(
        public readonly int $versionId,
        public readonly float $usdIdr,
        public readonly float $sarIdr,
        public readonly string $effectiveFrom,
    ) {}

    /** IDR per one unit of the given currency. */
    public function rateFor(string $currency): float
    {
        return match (strtoupper($currency)) {
            'USD' => $this->usdIdr,
            'SAR' => $this->sarIdr,
            'IDR' => 1.0,
            default => throw new InvalidArgumentException("Unsupported currency [{$currency}]."),
        };
    }

    public function toIdr(float $amount, string $currency): float
    {
        return $amount * $this->rateFor($currency);
    }
}
