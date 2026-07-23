<?php

namespace App\Services\Costing\Engine;

/** One component's computed contribution to a costing. */
final class LineResult
{
    public function __construct(
        public readonly string $key,
        public readonly string $nama,
        public readonly string $kategori,
        public readonly string $behavior,
        public readonly float $groupTotal,
        public readonly float $perPilgrim,
        public readonly bool $active,
        public readonly bool $isBaseline,
        public readonly string $rateSource,
        public readonly ?string $suppressedReason = null,
    ) {}
}
