<?php

namespace App\Services\Costing\Coverage;

use App\Models\Costing\VendorService;
use App\Models\Costing\VisaCoverageRuleset;
use Illuminate\Support\Carbon;

/**
 * Resolves which coverage-bearing sources satisfy the coverage a costing
 * requires, and flags double-coverage (overlap) and missing coverage (gap).
 *
 * Overlap is the NORMAL case, not the edge case: the visa already bundles the
 * city tour and Taif, and an LA bundle commonly re-lists the same things — so
 * the resolver names the conflict rather than quietly suppressing a row.
 */
class CoverageResolver
{
    /**
     * @param  string[]  $requiredTags
     * @param  CoverageProvider[]  $providers
     */
    public function resolve(array $requiredTags, array $providers): CoverageResolution
    {
        $perTag = [];
        foreach ($requiredTags as $tag) {
            $perTag[$tag] = [];
        }

        foreach ($providers as $provider) {
            foreach ($provider->tags as $tag) {
                // Only track coverage that is actually required; extra coverage
                // a bundle carries but nobody needs is harmless.
                if (array_key_exists($tag, $perTag)) {
                    $perTag[$tag][] = $provider->label;
                }
            }
        }

        $overlaps = array_filter($perTag, fn ($labels) => count($labels) > 1);
        $gaps = array_keys(array_filter($perTag, fn ($labels) => count($labels) === 0));

        return new CoverageResolution($perTag, $overlaps, array_values($gaps));
    }

    /**
     * Build the coverage provider for the Umrah visa as of a departure date,
     * from the effective-dated ruleset. Returns null if no ruleset applies.
     */
    public function visaProviderFor(Carbon|string $date): ?CoverageProvider
    {
        $ruleset = VisaCoverageRuleset::forDate($date);

        return $ruleset
            ? new CoverageProvider('Visa Umroh', $ruleset->provides_tags ?? [])
            : null;
    }

    /** Build a coverage provider from a selected vendor service (LA/handler/hotel). */
    public function serviceProvider(VendorService $service): CoverageProvider
    {
        $label = $service->vendor?->nama
            ? "{$service->vendor->nama} — {$service->nama}"
            : $service->nama;

        return new CoverageProvider($label, $service->providedTags());
    }
}
