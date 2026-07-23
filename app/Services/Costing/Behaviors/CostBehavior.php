<?php

namespace App\Services\Costing\Behaviors;

use App\Services\Costing\Engine\ComponentLine;
use App\Services\Costing\Engine\CostingContext;

/**
 * A cost behaviour computes one component's total cost for the whole group, in
 * IDR. Per-pilgrim is always groupTotal ÷ paying pax, derived uniformly by the
 * engine — never inside a behaviour. Behaviours are pure and generic: they read
 * the line's rate + params and the context, and know nothing about any specific
 * component.
 */
interface CostBehavior
{
    public function key(): string;

    public function groupTotalIdr(ComponentLine $line, CostingContext $ctx): float;
}
