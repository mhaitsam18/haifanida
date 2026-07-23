<?php

namespace App\Services\Costing\Ancillary;

/**
 * Computes ancillary (Produk Tambahan) margins. All-in = 100% take-up, certain
 * revenue, MAY count toward the package margin floor. Optional = partial take-up,
 * uncertain revenue, must NOT count toward the floor. Reproduces the workbook's
 * Rp21,000,000 all-in / Rp7,350,000 optional split.
 */
class AncillaryService
{
    /**
     * @param  array<int, array{key?:string, nama?:string, packaging:string, cost:float, sell:float, takeup_pct?:float|null}>  $items
     * @return array{lines: array<int,array<string,mixed>>, allInMargin: float, optionalMargin: float, allInMarginPerPilgrim: float}
     */
    public function compute(array $items, int $payingPax): array
    {
        $lines = [];
        $allIn = 0.0;
        $optional = 0.0;

        foreach ($items as $item) {
            $allInMode = ($item['packaging'] ?? 'optional') === 'all_in';
            $takeup = $allInMode ? 1.0 : (float) ($item['takeup_pct'] ?? 0);
            $participants = $payingPax * $takeup;

            $totalCost = (float) $item['cost'] * $participants;
            $totalRevenue = (float) $item['sell'] * $participants;
            $margin = $totalRevenue - $totalCost;

            if ($allInMode) {
                $allIn += $margin;
            } else {
                $optional += $margin;
            }

            $lines[] = [
                'key' => $item['key'] ?? null,
                'nama' => $item['nama'] ?? ($item['key'] ?? ''),
                'packaging' => $allInMode ? 'all_in' : 'optional',
                'cost' => (float) $item['cost'],
                'sell' => (float) $item['sell'],
                'takeup_pct' => $allInMode ? null : $takeup,
                'participants' => $participants,
                'total_cost' => $totalCost,
                'total_revenue' => $totalRevenue,
                'margin' => $margin,
                'counts_to_floor' => $allInMode,   // only certain revenue supports the floor
            ];
        }

        return [
            'lines' => $lines,
            'allInMargin' => $allIn,
            'optionalMargin' => $optional,
            'allInMarginPerPilgrim' => $payingPax > 0 ? $allIn / $payingPax : 0.0,
        ];
    }
}
