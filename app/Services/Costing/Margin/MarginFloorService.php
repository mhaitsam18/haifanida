<?php

namespace App\Services\Costing\Margin;

use App\Models\Costing\PackageTier;

/**
 * Resolves the margin floor for a tier (Addendum 3). Rp2jt is ~5% on standard
 * but drifts across tiers, so the floor is expressible as an absolute amount,
 * the greater of an absolute and a percentage of publish price, or a
 * per-quotation target (private, which has no published price). The rule in
 * force is reported back the way staffSalaryRule already is.
 */
class MarginFloorService
{
    /**
     * @return array{0: float, 1: string, 2: bool}  [floor amount, rule label, isTargetOnly]
     */
    public function floorFor(string $tierKey, float $publishPrice): array
    {
        $tier = PackageTier::where('key', $tierKey)->first();
        $fallback = (float) config('costing.margin.floor');

        if (! $tier || $tier->margin_floor_type === null) {
            return [$fallback, "default absolut Rp".number_format($fallback, 0, ',', '.'), false];
        }

        $amount = (float) ($tier->margin_floor_amount ?? $fallback);
        $pct = $tier->margin_floor_pct !== null ? (float) $tier->margin_floor_pct : null;

        return match ($tier->margin_floor_type) {
            'greater_of' => $this->greaterOf($amount, $pct, $publishPrice),
            'per_quotation' => [
                $amount,
                'target margin per-kuotasi (private, tanpa harga publish)',
                true,
            ],
            default => [ // 'absolute'
                $amount,
                'floor absolut Rp'.number_format($amount, 0, ',', '.'),
                false,
            ],
        };
    }

    /** @return array{0: float, 1: string, 2: bool} */
    private function greaterOf(float $amount, ?float $pct, float $publishPrice): array
    {
        $fromPct = $pct !== null ? $publishPrice * $pct / 100 : 0.0;
        $floor = max($amount, $fromPct);
        $label = sprintf(
            'greater of Rp%s / %s%% (Rp%s) = Rp%s',
            number_format($amount, 0, ',', '.'),
            $pct !== null ? rtrim(rtrim(number_format($pct, 2), '0'), '.') : '0',
            number_format($fromPct, 0, ',', '.'),
            number_format($floor, 0, ',', '.'),
        );

        return [$floor, $label, false];
    }
}
