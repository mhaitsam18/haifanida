<?php

namespace App\Services\Costing\Behaviors;

use App\Services\Costing\Engine\ComponentLine;
use App\Services\Costing\Engine\CostingContext;

/**
 * rate × nights × rooms, where rooms = ceil(pax / occupancy). The rounding-up
 * exposes the cost of partially-filled rooms — the workbook's key fix over the
 * old flat per-pilgrim hotel figure.
 */
class PerRoomNight implements CostBehavior
{
    public function key(): string
    {
        return 'PER_ROOM_NIGHT';
    }

    public function groupTotalIdr(ComponentLine $line, CostingContext $ctx): float
    {
        $nights = $ctx->nights($line->param('nights_key', 'makkah'));
        $rooms = (int) ceil($ctx->payingPax / max(1, $ctx->occupancy));

        return $nights * $rooms * $line->rateIdr;
    }
}
