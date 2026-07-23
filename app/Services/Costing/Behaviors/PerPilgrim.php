<?php

namespace App\Services\Costing\Behaviors;

use App\Services\Costing\Engine\ComponentLine;
use App\Services\Costing\Engine\CostingContext;

/** rate × pax × qty_multiplier (e.g. CGK handling = 2 legs). */
class PerPilgrim implements CostBehavior
{
    public function key(): string
    {
        return 'PER_PILGRIM';
    }

    public function groupTotalIdr(ComponentLine $line, CostingContext $ctx): float
    {
        $multiplier = (float) $line->param('qty_multiplier', 1);

        return $ctx->payingPax * $multiplier * $line->rateIdr;
    }
}
