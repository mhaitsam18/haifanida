<?php

namespace App\Services\Costing\Behaviors;

use App\Services\Costing\Engine\ComponentLine;
use App\Services\Costing\Engine\CostingContext;

/**
 * max(0, floor − billable_pax) × rate — a minimum-billing guarantee, not a
 * penalty. Farkiyah is this shape (floor 35, USD 20/seat, basis = total pax
 * including free seats). Any vendor with a seat floor reuses it.
 */
class MinGuarantee implements CostBehavior
{
    public function key(): string
    {
        return 'MIN_GUARANTEE';
    }

    public function groupTotalIdr(ComponentLine $line, CostingContext $ctx): float
    {
        $floor = (int) $line->param('floor', $ctx->farkiyahFloor);
        $basis = $line->param('basis', 'paying') === 'total' ? $ctx->totalPax() : $ctx->payingPax;

        return max(0, $floor - $basis) * $line->rateIdr;
    }
}
