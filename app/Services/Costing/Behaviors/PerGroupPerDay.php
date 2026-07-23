<?php

namespace App\Services\Costing\Behaviors;

use App\Services\Costing\Engine\ComponentLine;
use App\Services\Costing\Engine\CostingContext;

/**
 * rate × days, per group (e.g. mutawwif at SAR 250/day). Days come from a
 * context driver — Saudi ground days, counted landing-to-takeoff, which differ
 * from the headline package day count.
 */
class PerGroupPerDay implements CostBehavior
{
    public function key(): string
    {
        return 'PER_GROUP_PER_DAY';
    }

    public function groupTotalIdr(ComponentLine $line, CostingContext $ctx): float
    {
        $days = $ctx->days($line->param('days_key', 'saudi_ground'));

        return $days * $line->rateIdr;
    }
}
