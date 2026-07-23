<?php

namespace App\Services\Costing\Snapshot;

use App\Models\Costing\Costing;
use App\Models\Costing\Keberangkatan;
use App\Models\Costing\VisaCoverageRuleset;
use App\Models\Paket;
use App\Services\Costing\Ancillary\AncillaryService;
use App\Services\Costing\Engine\CostingContextFactory;
use App\Services\Costing\Engine\CostingEngine;
use App\Services\Costing\Engine\CostingResult;
use App\Services\Costing\Fx\FxPolicyService;
use App\Services\Costing\Margin\MarginFloorService;
use App\Services\Costing\Risk\DepositRisk;
use App\Services\Costing\Risk\DepositRiskService;
use Illuminate\Support\Facades\DB;

/**
 * Builds and persists an immutable costing snapshot from a departure (or raw
 * overrides), pinning every rule that can drift — FX version, each line's
 * rate-card version, the effective-dated visa ruleset, and the overhead
 * rule/divisor — so a reopened costing reproduces its original result. publish()
 * additionally syncs the quad headline into the existing paket.harga (additive).
 */
class CostingSnapshotService
{
    public function __construct(
        private CostingEngine $engine,
        private CostingContextFactory $factory,
        private FxPolicyService $fxService,
        private MarginFloorService $marginFloor,
        private DepositRiskService $depositRisk,
        private AncillaryService $ancillary,
    ) {}

    public function createFromDeparture(Keberangkatan $dep, array $ancillaryItems = [], ?int $actorId = null): Costing
    {
        $overrides = [
            'costing_date' => optional($dep->departure_date)->toDateString() ?? now()->toDateString(),
            'paying_pax' => $dep->planned_pax,
            'free_seats' => $dep->free_seats,
            'night_makkah' => $dep->night_makkah,
            'night_madinah' => $dep->night_madinah,
            'occupancy' => $dep->occupancy,
            'saudi_ground_days' => $dep->saudi_ground_days ?? 8,
            'publish_price' => (float) ($dep->publish_price ?? 0),
            'channel_mix_agent_pct' => $dep->channel_mix_agent_pct !== null ? (float) $dep->channel_mix_agent_pct : null,
            'transit_villa' => $dep->transit_villa,
            'handling_bundled_la' => $dep->handling_bundled_la,
            'mutawwif_free' => $dep->mutawwif_free,
            'seats_booked' => $dep->seats_booked ?? $dep->planned_pax,
            'materialisation_pct' => (float) $dep->materialisation_pct,
            'materialisation_basis' => $dep->materialisation_basis,
            'procurement_mode' => $dep->procurement_mode,
            'tl_opt_in' => $dep->tl_opt_in,
            'package_tier' => $dep->tier?->key ?? 'standard',
        ];

        $fx = $this->fxService->policyFor($overrides['costing_date']);
        $risk = $this->depositRisk->forDeparture($dep->loadMissing('ticketLots'), $fx);

        return $this->build($overrides, $risk, $ancillaryItems, $dep, $dep->paket_id, $actorId);
    }

    /** Build a draft snapshot from raw overrides (no persisted departure yet). */
    public function createFromOverrides(array $overrides, array $ancillaryItems = [], ?int $paketId = null, ?int $actorId = null): Costing
    {
        return $this->build($overrides, DepositRisk::notApplicable(), $ancillaryItems, null, $paketId, $actorId);
    }

    private function build(array $overrides, DepositRisk $risk, array $ancillaryItems, ?Keberangkatan $dep, ?int $paketId, ?int $actorId): Costing
    {
        $date = $overrides['costing_date'] ?? now()->toDateString();
        $fx = $this->fxService->policyFor($date);
        $ctx = $this->factory->build($fx, $overrides);
        $result = $this->engine->cost($ctx);

        $visaRulesetId = VisaCoverageRuleset::forDate($date)?->id;
        [$floorAmount, $floorRule] = $this->marginFloor->floorFor($ctx->packageTier, $ctx->publishPrice);
        $distance = $result->packageMargin - $floorAmount;
        $marginStatus = $this->statusFor($result->packageMargin, $floorAmount, $ctx->marginTarget);

        $ancillary = $this->ancillary->compute($ancillaryItems, $ctx->payingPax);
        $depositAtRisk = $risk->applicable ? $risk->totalDeposit : null;

        return DB::transaction(function () use (
            $ctx, $result, $fx, $visaRulesetId, $floorAmount, $floorRule, $distance,
            $marginStatus, $ancillary, $depositAtRisk, $dep, $paketId, $actorId
        ) {
            $costing = Costing::create([
                'keberangkatan_id' => $dep?->id,
                'paket_id' => $paketId,
                'status' => 'draft',
                'package_tier' => $ctx->packageTier,
                'procurement_mode' => $ctx->procurementMode,
                'paying_pax' => $ctx->payingPax,
                'free_seats' => $ctx->freeSeats,
                'seats_booked' => $ctx->seatsBooked,
                'publish_price' => $ctx->publishPrice,
                'materialisation_basis' => $ctx->materialisationBasis,
                'fx_policy_version_id' => $fx->versionId ?: null,
                'visa_coverage_ruleset_id' => $visaRulesetId,
                'staff_salary_mode' => $ctx->staffSalaryMode,
                'staff_salary_rule' => $result->staffSalaryRule,
                'margin_floor_rule' => $floorRule,
                'production_group_total' => $result->productionGroupTotal,
                'production_per_pilgrim' => $result->productionPerPilgrim,
                'burden_per_pilgrim' => $result->burdenPerPilgrim,
                'package_margin' => $result->packageMargin,
                'expected_margin' => $result->expectedMargin,
                'margin_floor' => $floorAmount,
                'distance_to_floor' => $distance,
                'margin_status' => $marginStatus,
                'deposit_at_risk' => $depositAtRisk,
                'materialisation_applicable' => $result->materialisation->applicable,
                'inputs_json' => $this->inputsSnapshot($ctx),
                'warnings_json' => $result->warnings,
                'created_by' => $actorId,
            ]);

            foreach ($result->lines as $line) {
                $costing->lines()->create([
                    'cost_component_id' => optional(\App\Models\Costing\CostComponent::where('key', $line->key)->first())->id,
                    'rate_card_id' => $line->rateCardId,
                    'key' => $line->key,
                    'nama' => $line->nama,
                    'kategori' => $line->kategori,
                    'behavior' => $line->behavior,
                    'group_total' => $line->groupTotal,
                    'per_pilgrim' => $line->perPilgrim,
                    'active' => $line->active,
                    'is_baseline' => $line->isBaseline,
                    'rate_source' => $line->rateSource,
                    'suppressed_reason' => $line->suppressedReason,
                ]);
            }

            $this->persistOccupancyMatrix($costing, $result, $fx);

            foreach ($ancillary['lines'] as $a) {
                $costing->ancillaries()->create([
                    'key' => $a['key'],
                    'nama' => $a['nama'],
                    'packaging' => $a['packaging'],
                    'cost' => $a['cost'],
                    'sell' => $a['sell'],
                    'takeup_pct' => $a['takeup_pct'],
                    'participants' => $a['participants'],
                    'total_cost' => $a['total_cost'],
                    'total_revenue' => $a['total_revenue'],
                    'margin' => $a['margin'],
                    'counts_to_floor' => $a['counts_to_floor'],
                ]);
            }

            return $costing;
        });
    }

    /** Per-occupancy price matrix, holding the base margin constant across tiers. */
    private function persistOccupancyMatrix(Costing $costing, CostingResult $base, $fx): void
    {
        $baseMargin = $base->packageMargin;
        $labels = [4 => 'Quad', 3 => 'Triple', 2 => 'Double', 1 => 'Single'];

        foreach ($labels as $occupancy => $label) {
            $ctxO = $this->factory->build($fx, array_merge($this->reinputs($costing), ['occupancy' => $occupancy]));
            $rO = $this->engine->cost($ctxO);
            $costing->publishedPrices()->create([
                'occupancy' => $occupancy,
                'label' => $label,
                'price' => $rO->burdenPerPilgrim + $baseMargin,
            ]);
        }
    }

    public function publish(Costing $costing): Costing
    {
        $costing->update(['status' => 'published', 'published_at' => now()]);

        // Additive: sync the quad headline into the existing paket.harga so the
        // current booking flow keeps working unchanged.
        if ($costing->paket_id) {
            $quad = $costing->publishedPrices()->where('occupancy', 4)->value('price')
                ?? $costing->publish_price;
            if ($quad) {
                Paket::whereKey($costing->paket_id)->update(['harga' => $quad]);
            }
        }

        return $costing->refresh();
    }

    public function freeze(Costing $costing): Costing
    {
        $costing->update(['status' => 'frozen', 'frozen_at' => now()]);

        return $costing->refresh();
    }

    private function statusFor(float $margin, float $floor, float $target): string
    {
        if ($margin < $floor) {
            return 'DI_BAWAH_LANTAI';
        }

        return $margin < $target ? 'AMAN_MINIMUM' : 'AMAN';
    }

    private function inputsSnapshot($ctx): array
    {
        return [
            'costing_date' => $ctx->costingDate,
            'paying_pax' => $ctx->payingPax,
            'free_seats' => $ctx->freeSeats,
            'night_makkah' => $ctx->nightMakkah,
            'night_madinah' => $ctx->nightMadinah,
            'occupancy' => $ctx->occupancy,
            'saudi_ground_days' => $ctx->saudiGroundDays,
            'publish_price' => $ctx->publishPrice,
            'channel_mix_agent_pct' => $ctx->channelMixAgentPct,
            'transit_villa' => $ctx->transitVilla,
            'handling_bundled_la' => $ctx->handlingBundledLA,
            'mutawwif_free' => $ctx->mutawwifFreeFromHandler,
            'seats_booked' => $ctx->seatsBooked,
            'materialisation_pct' => $ctx->materialisationPct,
            'materialisation_basis' => $ctx->materialisationBasis,
            'procurement_mode' => $ctx->procurementMode,
            'tl_opt_in' => $ctx->tlOptIn,
            'package_tier' => $ctx->packageTier,
            'staff_salary_mode' => $ctx->staffSalaryMode,
            'staff_salary_flat' => $ctx->staffSalaryFlat,
            'overhead_annual_pool' => $ctx->overheadAnnualPool,
            'departures_per_year' => $ctx->departuresPerYear,
            'pilgrims_per_departure' => $ctx->pilgrimsPerDeparture,
        ];
    }

    private function reinputs(Costing $costing): array
    {
        return $costing->inputs_json ?? [];
    }
}
