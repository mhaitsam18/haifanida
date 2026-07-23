<?php

namespace App\Services\Costing\Rates;

/**
 * The rate chosen for a component in a costing, with its provenance. isBaseline
 * marks a figure that rests on the internal prevailing assumption rather than a
 * contracted vendor quote — always surfaced, never presented as contracted.
 */
final class ResolvedRate
{
    public function __construct(
        public readonly float $amount,
        public readonly string $currency,
        public readonly string $source,
        public readonly bool $isBaseline,
        public readonly int $rateCardId,
        public readonly ?string $unit = null,
    ) {}
}
