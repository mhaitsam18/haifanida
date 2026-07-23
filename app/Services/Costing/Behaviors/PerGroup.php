<?php

namespace App\Services\Costing\Behaviors;

use App\Services\Costing\Engine\ComponentLine;
use App\Services\Costing\Engine\CostingContext;

/** A flat per-group amount (e.g. a city-tour vehicle), divided across pax by the engine. */
class PerGroup implements CostBehavior
{
    public function key(): string
    {
        return 'PER_GROUP';
    }

    public function groupTotalIdr(ComponentLine $line, CostingContext $ctx): float
    {
        return $line->rateIdr;
    }
}
