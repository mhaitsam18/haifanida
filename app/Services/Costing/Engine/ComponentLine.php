<?php

namespace App\Services\Costing\Engine;

/**
 * A component resolved for a specific costing: its FX-converted unit rate, its
 * behaviour params, and whether an activate/suppress switch left it active. The
 * behaviour reads rateIdr + params + context; it never touches the DB or config.
 */
final class ComponentLine
{
    public function __construct(
        public readonly string $key,
        public readonly string $nama,
        public readonly string $kategori,
        public readonly string $behavior,
        public readonly string $currency,
        public readonly float $rawRate,
        public readonly float $rateIdr,   // rawRate × FX rate for its currency
        public readonly array $params,
        public readonly bool $active,
        public readonly bool $isBaseline,
        public readonly string $rateSource,
        public readonly ?string $suppressedReason = null,
    ) {}

    public function param(string $key, mixed $default = null): mixed
    {
        return $this->params[$key] ?? $default;
    }
}
