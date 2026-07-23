<?php

namespace App\Services\Costing\Engine;

/**
 * Resolves the staff-salary / overhead absorption per pilgrim, and states which
 * rule produced it (Addendum 2). Production derives it from the annual overhead
 * pool ÷ expected annual pilgrims — which absorbs the ~2 dead Hajj months the
 * old monthly rule ignored; the flat figure is an explicit, labelled override
 * (used by the golden-master fixture to prove the mechanics).
 */
class OverheadService
{
    /**
     * @return array{0: float, 1: string}  [per-pilgrim amount, rule label]
     */
    public function staffSalaryPerPilgrim(CostingContext $ctx): array
    {
        if ($ctx->staffSalaryMode === 'pool'
            && $ctx->overheadAnnualPool !== null
            && $ctx->expectedAnnualPilgrims
        ) {
            $amount = $ctx->overheadAnnualPool / $ctx->expectedAnnualPilgrims;

            return [
                $amount,
                sprintf(
                    'pool overhead tahunan (Rp%s) ÷ %s jemaah/tahun',
                    number_format($ctx->overheadAnnualPool, 0, ',', '.'),
                    number_format($ctx->expectedAnnualPilgrims, 0, ',', '.'),
                ),
            ];
        }

        return [
            $ctx->staffSalaryFlat,
            sprintf('override flat Rp%s/jemaah', number_format($ctx->staffSalaryFlat, 0, ',', '.')),
        ];
    }
}
