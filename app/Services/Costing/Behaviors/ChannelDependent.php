<?php

namespace App\Services\Costing\Behaviors;

use App\Services\Costing\Engine\ComponentLine;
use App\Services\Costing\Engine\CostingContext;

/**
 * Always priced in per pilgrim (agent fee Rp1.5jt). It is recognised as COST on
 * agent-sourced bookings and as MARGIN on direct ones — so it is fully costed
 * here, and the engine adds back fee × (1 − agent_pct) when it reports EXPECTED
 * margin alongside budgeted margin.
 */
class ChannelDependent implements CostBehavior
{
    public function key(): string
    {
        return 'CHANNEL_DEPENDENT';
    }

    public function groupTotalIdr(ComponentLine $line, CostingContext $ctx): float
    {
        return $ctx->payingPax * $line->rateIdr;
    }
}
