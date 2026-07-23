<?php

namespace App\Services\Costing\Coverage;

/**
 * A source of coverage in a costing: the visa bundle (via the effective-dated
 * ruleset), an LA bundle, a specific handler, etc. Label is what the UI shows
 * when reporting an overlap ("covered by both Visa and LA").
 */
final class CoverageProvider
{
    public function __construct(
        public readonly string $label,
        /** @var string[] */
        public readonly array $tags,
    ) {}
}
