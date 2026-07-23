<?php

namespace App\Services\Costing\Rates;

use App\Models\Costing\CostComponent;
use App\Models\Costing\RateCard;
use App\Models\Costing\VendorService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Chooses the rate to cost a component with, honouring provenance precedence:
 * a contracted vendor rate always beats the internal baseline, and the baseline
 * is kept as a reference — never overwritten, never silently shadowed.
 */
class RateResolver
{
    /** The active baseline rate for a component (the internal prevailing assumption). */
    public function baselineRateFor(CostComponent $component, Carbon|string $date): ?RateCard
    {
        return RateCard::query()
            ->baseline()
            ->where('cost_component_id', $component->id)
            ->activeOn($date)
            ->orderByDesc('valid_from')->orderByDesc('id')
            ->first();
    }

    /** The active contracted rate under a specific vendor service. */
    public function contractedRateFor(VendorService $service, Carbon|string $date): ?RateCard
    {
        return RateCard::query()
            ->where('vendor_service_id', $service->id)
            ->where('source', 'contracted')
            ->activeOn($date)
            ->orderByDesc('valid_from')->orderByDesc('id')
            ->first();
    }

    /**
     * Resolve the rate for a component. When a vendor service is chosen and has
     * a contracted rate, that wins; otherwise fall back to the baseline (flagged).
     */
    public function resolve(CostComponent $component, Carbon|string $date, ?VendorService $service = null): ?ResolvedRate
    {
        if ($service) {
            $contracted = $this->contractedRateFor($service, $date);
            if ($contracted) {
                return $this->toResolved($contracted, isBaseline: false);
            }
        }

        $baseline = $this->baselineRateFor($component, $date);

        return $baseline ? $this->toResolved($baseline, isBaseline: true) : null;
    }

    /**
     * Components whose costing currently rests on a baseline rate (assumption,
     * not a contracted quote) — the "where do we still lack a real quote" report.
     *
     * @return Collection<int, CostComponent>
     */
    public function componentsOnBaseline(Carbon|string $date): Collection
    {
        $componentIds = RateCard::query()
            ->baseline()
            ->activeOn($date)
            ->pluck('cost_component_id')
            ->filter()
            ->unique();

        return CostComponent::whereIn('id', $componentIds)
            ->orderBy('sort_order')
            ->get();
    }

    private function toResolved(RateCard $rate, bool $isBaseline): ResolvedRate
    {
        return new ResolvedRate(
            amount: (float) $rate->amount,
            currency: $rate->currency,
            source: $rate->source,
            isBaseline: $isBaseline,
            rateCardId: (int) $rate->id,
            unit: $rate->unit,
        );
    }
}
