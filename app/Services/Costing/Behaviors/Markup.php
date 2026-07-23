<?php

namespace App\Services\Costing\Behaviors;

use App\Services\Costing\Engine\ComponentLine;
use App\Services\Costing\Engine\CostingContext;

/**
 * A per-pilgrim amount loaded onto the price (not production HPP). The amount is
 * decided by the engine before dispatch (staff salary: annual pool ÷ expected
 * pilgrims, or the flat override) and arrives here as rateIdr — the behaviour
 * stays a dumb multiplier.
 */
class Markup implements CostBehavior
{
    public function key(): string
    {
        return 'MARKUP';
    }

    public function groupTotalIdr(ComponentLine $line, CostingContext $ctx): float
    {
        return $ctx->payingPax * $line->rateIdr;
    }
}
