<?php

namespace App\Services\Costing\Coverage;

/**
 * Result of resolving required coverage against the services/rulesets that
 * provide it. Overlap = a tag provided by more than one source (double-count
 * risk → the user must pick the authoritative one). Gap = a required tag no
 * source provides (a real cost silently missing).
 */
final class CoverageResolution
{
    public function __construct(
        /** @var array<string, string[]> tag => provider labels */
        public readonly array $perTag,
        /** @var array<string, string[]> tags provided by >1 source */
        public readonly array $overlaps,
        /** @var string[] required tags provided by no source */
        public readonly array $gaps,
    ) {}

    public function isClean(): bool
    {
        return $this->overlaps === [] && $this->gaps === [];
    }

    public function hasOverlap(): bool
    {
        return $this->overlaps !== [];
    }

    public function hasGap(): bool
    {
        return $this->gaps !== [];
    }
}
