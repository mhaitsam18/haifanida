<?php

namespace App\Services\Costing\Engine;

use App\Models\Costing\CostComponent;
use App\Services\Costing\Behaviors\BehaviorRegistry;
use App\Services\Costing\Rates\RateResolver;
use App\Services\Costing\Support\FxPolicy;

/**
 * Assembles a departure's components, runs each through its behaviour, and
 * derives the full costing (production cost, burden, both margins, TL
 * sufficiency, materialisation). Pure over its CostingContext, so sensitivity
 * is just the same computation across a pax sweep.
 */
class CostingEngine
{
    public function __construct(
        private BehaviorRegistry $behaviors,
        private RateResolver $rates,
        private OverheadService $overhead,
        private CostingContextFactory $factory,
    ) {}

    public function cost(CostingContext $ctx): CostingResult
    {
        $components = CostComponent::whereIn('kategori', ['production', 'markup'])
            ->orderBy('sort_order')->get();

        $lines = [];
        $staffRule = '';

        foreach ($components as $component) {
            [$rawRate, $currency, $source, $isBaseline] = $this->resolveRate($component, $ctx, $staffRule);
            $rateIdr = $rawRate * $ctx->fx->rateFor($currency);

            [$active, $suppressedReason] = $this->activation($component, $ctx);

            $line = new ComponentLine(
                key: $component->key,
                nama: $component->nama,
                kategori: $component->kategori,
                behavior: $component->behavior,
                currency: $currency,
                rawRate: $rawRate,
                rateIdr: $rateIdr,
                params: $component->params ?? [],
                active: $active,
                isBaseline: $isBaseline,
                rateSource: $source,
                suppressedReason: $suppressedReason,
            );

            $groupTotal = $active
                ? $this->behaviors->for($component->behavior)->groupTotalIdr($line, $ctx)
                : 0.0;
            $perPilgrim = $ctx->payingPax > 0 ? $groupTotal / $ctx->payingPax : 0.0;

            $lines[] = new LineResult(
                key: $component->key,
                nama: $component->nama,
                kategori: $component->kategori,
                behavior: $component->behavior,
                groupTotal: $groupTotal,
                perPilgrim: $perPilgrim,
                active: $active,
                isBaseline: $isBaseline,
                rateSource: $source,
                suppressedReason: $suppressedReason,
            );
        }

        // Production HPP is the production category only (markups excluded).
        $productionGroupTotal = array_sum(array_map(
            fn (LineResult $l) => $l->kategori === 'production' ? $l->groupTotal : 0.0,
            $lines,
        ));
        $productionPerPilgrim = $ctx->payingPax > 0 ? $productionGroupTotal / $ctx->payingPax : 0.0;

        $staffPerPilgrim = $this->perPilgrimOf($lines, 'gaji_staff');
        $agentFeePerPilgrim = $this->perPilgrimOf($lines, 'fee_agen');
        $focPerPilgrim = $ctx->freeSeats * $ctx->publishPrice / max(1, $ctx->freeSeatDivisor);

        $burdenPerPilgrim = $productionPerPilgrim + $focPerPilgrim + $staffPerPilgrim + $agentFeePerPilgrim;
        $packageMargin = $ctx->publishPrice - $burdenPerPilgrim;
        // Fee on direct bookings is recovered as margin; expected uses the actual mix.
        $expectedMargin = $packageMargin + $agentFeePerPilgrim * (1 - $ctx->channelMixAgentPct);
        $distanceToFloor = $packageMargin - $ctx->marginFloor;

        $marginStatus = $this->marginStatus($packageMargin, $ctx);
        $tl = $this->tlSufficiency($ctx);
        $materialisation = $this->materialisation($ctx);
        $warnings = $this->warnings($ctx, $tl, $materialisation, $lines);

        return new CostingResult(
            lines: $lines,
            productionGroupTotal: $productionGroupTotal,
            productionPerPilgrim: $productionPerPilgrim,
            focPerPilgrim: $focPerPilgrim,
            staffSalaryPerPilgrim: $staffPerPilgrim,
            staffSalaryRule: $staffRule,
            agentFeePerPilgrim: $agentFeePerPilgrim,
            burdenPerPilgrim: $burdenPerPilgrim,
            publishPrice: $ctx->publishPrice,
            packageMargin: $packageMargin,
            expectedMargin: $expectedMargin,
            distanceToFloor: $distanceToFloor,
            marginStatus: $marginStatus,
            minPublishForFloor: $burdenPerPilgrim + $ctx->marginFloor,
            targetPublish: $burdenPerPilgrim + $ctx->marginTarget,
            tl: $tl,
            materialisation: $materialisation,
            warnings: $warnings,
        );
    }

    /**
     * The group-size sensitivity table (full recompute per pax + materialisation).
     *
     * @param  array<string, mixed>  $baseOverrides
     * @param  int[]  $paxList
     * @return SensitivityRow[]
     */
    public function sensitivity(FxPolicy $fx, array $baseOverrides, array $paxList): array
    {
        $rows = [];

        foreach ($paxList as $pax) {
            $ctx = $this->factory->build($fx, array_merge($baseOverrides, ['paying_pax' => $pax]));
            $r = $this->cost($ctx);
            $mat = $r->materialisation;

            $status = $mat->breached ? SensitivityRow::STATUS_DEPOSIT_FORFEIT : $r->marginStatus;

            $rows[] = new SensitivityRow(
                pax: $pax,
                farkiyahPerPilgrim: $r->line('farkiyah')?->perPilgrim ?? 0.0,
                mutawwifPerPilgrim: $r->line('mutawwif')?->perPilgrim ?? 0.0,
                tlRequired: $r->tl->required,
                tlSurplus: $r->tl->surplus,
                burdenPerPilgrim: $r->burdenPerPilgrim,
                marginPerPilgrim: $r->packageMargin,
                distanceToFloor: $r->distanceToFloor,
                marginStatus: $r->marginStatus,
                materialisationPct: $mat->pct,
                materialisationBreached: $mat->breached,
                depositAtRisk: $mat->depositAtRisk,
                status: $status,
            );
        }

        return $rows;
    }

    /** @return array{0: float, 1: string, 2: string, 3: bool} [rawRate, currency, source, isBaseline] */
    private function resolveRate(CostComponent $component, CostingContext $ctx, string &$staffRule): array
    {
        // Staff salary is not a rate card — it is resolved from overhead policy.
        if ($component->key === 'gaji_staff') {
            [$amount, $rule] = $this->overhead->staffSalaryPerPilgrim($ctx);
            $staffRule = $rule;

            return [$amount, 'IDR', 'overhead', false];
        }

        $resolved = $this->rates->resolve($component, $ctx->costingDate);
        if (! $resolved) {
            return [0.0, $component->default_currency, 'missing', false];
        }

        return [$resolved->amount, $resolved->currency, $resolved->source, $resolved->isBaseline];
    }

    /** @return array{0: bool, 1: ?string} [active, suppressedReason] */
    private function activation(CostComponent $component, CostingContext $ctx): array
    {
        $params = $component->params ?? [];

        if (isset($params['active_when']) && ! $ctx->flag($params['active_when'])) {
            return [false, "tidak aktif ({$params['active_when']})"];
        }

        if (isset($params['suppress_when']) && $ctx->flag($params['suppress_when'])) {
            return [false, "tercakup bundel/handler ({$params['suppress_when']})"];
        }

        return [true, null];
    }

    private function perPilgrimOf(array $lines, string $key): float
    {
        foreach ($lines as $line) {
            if ($line->key === $key) {
                return $line->perPilgrim;
            }
        }

        return 0.0;
    }

    private function marginStatus(float $packageMargin, CostingContext $ctx): string
    {
        if ($packageMargin < $ctx->marginFloor) {
            return 'DI_BAWAH_LANTAI';
        }

        return $packageMargin < $ctx->marginTarget ? 'AMAN_MINIMUM' : 'AMAN';
    }

    private function tlSufficiency(CostingContext $ctx): TlSufficiency
    {
        $required = (int) ceil($ctx->payingPax / max(1, $ctx->tlRatio));
        $seatCost = $required * $ctx->tlSeatCost;
        $collected = $ctx->payingPax * $ctx->tlAllocation;
        // pax at which this step count self-funds again: pax × alloc ≥ required × seatCost
        $selfFundingAt = (int) ceil($seatCost / max(1, $ctx->tlAllocation));

        return new TlSufficiency($required, $seatCost, $collected, $collected - $seatCost, $selfFundingAt);
    }

    private function materialisation(CostingContext $ctx): Materialisation
    {
        $pct = $ctx->seatsBooked > 0 ? $ctx->payingPax / $ctx->seatsBooked : 1.0;
        $breached = ($pct + 1e-9) < $ctx->materialisationPct;

        // Rupiah at risk needs deposit terms (phase 4) — null for now.
        return new Materialisation($ctx->seatsBooked, $ctx->payingPax, $pct, $ctx->materialisationPct, $breached, null);
    }

    /** @param LineResult[] $lines @return string[] */
    private function warnings(CostingContext $ctx, TlSufficiency $tl, Materialisation $mat, array $lines): array
    {
        $w = [];

        if ($mat->breached) {
            $w[] = sprintf(
                'MATERIALISASI %.0f%% di bawah ambang %.0f%% — deposit tiket hangus (%d dari %d kursi).',
                $mat->pct * 100, $mat->thresholdPct * 100, $mat->realised, $mat->seatsBooked,
            );
        }

        if ($tl->inDeficit()) {
            $w[] = sprintf(
                'Alokasi TL defisit Rp%s (butuh %d TL). Kembali menutup di %d jemaah.',
                number_format(abs($tl->surplus), 0, ',', '.'), $tl->required, $tl->selfFundingAt,
            );
        }

        $farkiyah = $this->perPilgrimOf($lines, 'farkiyah');
        if ($farkiyah > 0) {
            $mutawwif = $this->perPilgrimOf($lines, 'mutawwif');
            $w[] = sprintf(
                'Grup kecil: beban jaminan minimum + per-grup Rp%s/jemaah (farkiyah Rp%s + mutawwif Rp%s).',
                number_format($farkiyah + $mutawwif, 0, ',', '.'),
                number_format($farkiyah, 0, ',', '.'),
                number_format($mutawwif, 0, ',', '.'),
            );
        }

        return $w;
    }
}
