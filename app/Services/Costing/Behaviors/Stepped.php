<?php

namespace App\Services\Costing\Behaviors;

use App\Services\Costing\Engine\ComponentLine;
use App\Services\Costing\Engine\CostingContext;

/**
 * ceil(pax / step) × unit_cost — the generic staircase. The tour-leader
 * requirement (1 per 45) and any per-bus / per-N-seat vendor are the same shape;
 * none needs a bespoke class. unit_cost defaults to the line rate.
 */
class Stepped implements CostBehavior
{
    public function key(): string
    {
        return 'STEPPED';
    }

    public function groupTotalIdr(ComponentLine $line, CostingContext $ctx): float
    {
        $step = (int) $line->param('step', 1);
        $unitCost = (float) $line->param('unit_cost', $line->rateIdr);

        return (int) ceil($ctx->payingPax / max(1, $step)) * $unitCost;
    }
}
