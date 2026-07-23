<?php

namespace App\Services\Costing\Preview;

use App\Services\Costing\Ancillary\AncillaryService;
use App\Services\Costing\Engine\CostingContext;
use App\Services\Costing\Engine\CostingContextFactory;
use App\Services\Costing\Engine\CostingEngine;
use App\Services\Costing\Engine\CostingResult;
use App\Services\Costing\Fx\FxPolicyService;
use App\Services\Costing\Margin\MarginFloorService;

/**
 * Runs the engine and shapes a full, display-ready result for the wizard WITHOUT
 * persisting. Adds the Addendum-4 views: TOTAL departure margin beside per-pilgrim
 * (the real buffer against per-departure unforeseen cost), a packaging comparison,
 * and — for the budget/promo tier — a pessimistic/expected/optimistic range
 * instead of a single false-precision point.
 */
class CostingPreviewService
{
    public function __construct(
        private CostingEngine $engine,
        private CostingContextFactory $factory,
        private FxPolicyService $fxService,
        private MarginFloorService $marginFloor,
        private AncillaryService $ancillary,
    ) {}

    /**
     * @param  array<string,mixed>  $overrides
     * @param  array<int,array<string,mixed>>  $ancillaryItems
     */
    public function preview(array $overrides, array $ancillaryItems = []): array
    {
        $date = $overrides['costing_date'] ?? now()->toDateString();
        $fx = $this->fxService->policyFor($date);
        $ctx = $this->factory->build($fx, $overrides);
        $result = $this->engine->cost($ctx);

        [$floor, $floorRule, $isTargetOnly] = $this->marginFloor->floorFor($ctx->packageTier, $ctx->publishPrice);
        $distance = $result->packageMargin - $floor;
        $status = $result->packageMargin < $floor ? 'DI_BAWAH_LANTAI'
            : ($result->packageMargin < $ctx->marginTarget ? 'AMAN_MINIMUM' : 'AMAN');

        $anc = $this->ancillary->compute($ancillaryItems, $ctx->payingPax);
        $onDemand = $ctx->isOnDemand();

        // Private/quotation: no published price — quote = burden + per-quotation target.
        $quotedPrice = $isTargetOnly ? $result->burdenPerPilgrim + $floor : null;

        return [
            'mode' => $onDemand ? 'private' : 'block',
            'package_tier' => $ctx->packageTier,
            'paying_pax' => $ctx->payingPax,
            'production_per_pilgrim' => $result->productionPerPilgrim,
            'burden_per_pilgrim' => $result->burdenPerPilgrim,
            'publish_price' => $ctx->publishPrice,
            'quoted_price' => $quotedPrice,
            'package_margin' => $result->packageMargin,
            'expected_margin' => $result->expectedMargin,
            // The real protection: absolute buffer on the departure (Addendum 4).
            'total_departure_margin' => $result->packageMargin * $ctx->payingPax,
            'margin_floor' => $floor,
            'margin_floor_rule' => $floorRule,
            'margin_is_target_only' => $isTargetOnly,
            'distance_to_floor' => $distance,
            'margin_status' => $status,
            'staff_salary_rule' => $result->staffSalaryRule,
            'lines' => $this->lines($result),
            'occupancy_matrix' => $onDemand ? [] : $this->occupancyMatrix($fx, $overrides, $result),
            'materialisation' => $result->materialisation->applicable ? [
                'pct' => $result->materialisation->pct,
                'breached' => $result->materialisation->breached,
                'basis' => $result->materialisation->basis,
                'seats_booked' => $result->materialisation->seatsBooked,
                'realised' => $result->materialisation->realised,
            ] : null,
            'sensitivity' => $onDemand ? [] : $this->sensitivity($fx, $overrides),
            'ancillary' => [
                'lines' => $anc['lines'],
                'all_in_margin' => $anc['allInMargin'],
                'optional_margin' => $anc['optionalMargin'],
            ],
            'packaging_comparison' => $this->packagingComparison($ctx, $result, $anc, $floor),
            'scenarios' => $ctx->packageTier === 'budget' ? $this->scenarios($overrides) : null,
            'warnings' => $result->warnings,
        ];
    }

    private function lines(CostingResult $result): array
    {
        return array_map(fn ($l) => [
            'key' => $l->key,
            'nama' => $l->nama,
            'kategori' => $l->kategori,
            'per_pilgrim' => $l->perPilgrim,
            'group_total' => $l->groupTotal,
            'active' => $l->active,
            'is_baseline' => $l->isBaseline,        // per-line baseline flag (Phase 5 requirement)
            'rate_source' => $l->rateSource,
            'suppressed_reason' => $l->suppressedReason,
        ], $result->lines);
    }

    private function occupancyMatrix($fx, array $overrides, CostingResult $base): array
    {
        $baseMargin = $base->packageMargin;
        $labels = [4 => 'Quad', 3 => 'Triple', 2 => 'Double', 1 => 'Single'];
        $rows = [];

        foreach ($labels as $occ => $label) {
            $r = $this->engine->cost($this->factory->build($fx, array_merge($overrides, ['occupancy' => $occ])));
            $rows[] = [
                'occupancy' => $occ,
                'label' => $label,
                'price' => $r->burdenPerPilgrim + $baseMargin,
                'burden' => $r->burdenPerPilgrim,
            ];
        }

        return $rows;
    }

    private function sensitivity($fx, array $overrides): array
    {
        $rows = $this->engine->sensitivity($fx, $overrides, [5, 10, 20, 31, 32, 35, 46, 50]);

        return array_map(fn ($s) => [
            'pax' => $s->pax,
            'burden' => $s->burdenPerPilgrim,
            'margin' => $s->marginPerPilgrim,
            'total_departure_margin' => $s->marginPerPilgrim * $s->pax,
            'materialisation_pct' => $s->materialisationPct,
            'materialisation_applicable' => $s->materialisationApplicable,
            'status' => $s->status,
        ], $rows);
    }

    /** All-in (certain, counts to floor) vs stripped (package + separate optional add-ons). */
    private function packagingComparison(CostingContext $ctx, CostingResult $result, array $anc, float $floor): array
    {
        $allInSellPerPilgrim = 0.0;
        $addOns = [];
        foreach ($anc['lines'] as $line) {
            if ($line['packaging'] === 'all_in') {
                $allInSellPerPilgrim += $line['sell'];
            } else {
                $addOns[] = ['nama' => $line['nama'], 'sell' => $line['sell'], 'margin' => $line['margin']];
            }
        }

        $allInMarginPerPilgrim = $ctx->payingPax > 0 ? $anc['allInMargin'] / $ctx->payingPax : 0.0;
        $guaranteedMargin = $result->packageMargin + $allInMarginPerPilgrim; // all-in may support the floor

        return [
            // "True all-in equivalent price" a pilgrim ends up paying even when sold stripped.
            'all_in_equivalent_price' => $ctx->publishPrice + $allInSellPerPilgrim,
            'stripped_price' => $ctx->publishPrice,
            'package_margin' => $result->packageMargin,
            'guaranteed_margin' => $guaranteedMargin,
            'clears_floor_on_package_alone' => $result->packageMargin >= $floor,
            'clears_floor_with_all_in' => $guaranteedMargin >= $floor,
            'add_ons' => $addOns,
        ];
    }

    /** Budget/promo: three scenarios on the ticket + hotel band (Addendum 4 §3). */
    private function scenarios(array $overrides): array
    {
        $band = config('costing.scenario_band');
        $current = [
            'tiket_pesawat' => (float) ($overrides['rate_overrides']['tiket_pesawat'] ?? $band['ticket_expected']),
            'hotel_makkah' => (float) ($overrides['rate_overrides']['hotel_makkah'] ?? $band['hotel_makkah_expected']),
            'hotel_madinah' => (float) ($overrides['rate_overrides']['hotel_madinah'] ?? $band['hotel_madinah_expected']),
        ];

        $sets = [
            'pessimistic' => [
                'tiket_pesawat' => $current['tiket_pesawat'] * (1 + $band['ticket_up']),
                'hotel_makkah' => $current['hotel_makkah'] * (1 + $band['hotel_up']),
                'hotel_madinah' => $current['hotel_madinah'] * (1 + $band['hotel_up']),
            ],
            'expected' => $current,
            'optimistic' => [
                'tiket_pesawat' => $current['tiket_pesawat'] * (1 - $band['ticket_down']),
                'hotel_makkah' => $current['hotel_makkah'] * (1 - $band['hotel_down']),
                'hotel_madinah' => $current['hotel_madinah'] * (1 - $band['hotel_down']),
            ],
        ];

        $pax = (int) ($overrides['paying_pax'] ?? 35);
        $out = [];
        foreach ($sets as $name => $rates) {
            $o = array_merge($overrides, ['rate_overrides' => array_merge($overrides['rate_overrides'] ?? [], $rates)]);
            $fx = $this->fxService->policyFor($o['costing_date'] ?? now()->toDateString());
            $r = $this->engine->cost($this->factory->build($fx, $o));
            $out[$name] = [
                'ticket' => $rates['tiket_pesawat'],
                'margin_per_pilgrim' => $r->packageMargin,
                'total_departure_margin' => $r->packageMargin * $pax,
            ];
        }

        return $out;
    }
}
