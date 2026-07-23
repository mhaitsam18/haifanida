<?php

namespace App\Services\Costing\Behaviors;

use App\Services\Costing\Engine\ComponentLine;
use App\Services\Costing\Engine\CostingContext;

/**
 * Free-of-charge seat recovery, diluted across paying pilgrims at PUBLISH price
 * over a default divisor of 35 (a free seat is valued at what a paying pilgrim
 * would have paid). Per-pilgrim = free_seats × publish ÷ divisor.
 */
class FocDiluted implements CostBehavior
{
    public function key(): string
    {
        return 'FOC_DILUTED';
    }

    public function groupTotalIdr(ComponentLine $line, CostingContext $ctx): float
    {
        $perPilgrim = $ctx->freeSeats * $ctx->publishPrice / max(1, $ctx->freeSeatDivisor);

        return $ctx->payingPax * $perPilgrim;
    }
}
