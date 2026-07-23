<?php

namespace App\Services\Costing\Engine;

use App\Services\Costing\Support\FxPolicy;

/**
 * Builds a CostingContext by merging explicit departure inputs over config
 * defaults. Both cost() and sensitivity() build contexts through here, so the
 * pax sweep rebuilds fresh immutable contexts rather than mutating one.
 */
class CostingContextFactory
{
    /**
     * @param  array<string, mixed>  $o  overrides (paying_pax, night_makkah, ...)
     */
    public function build(FxPolicy $fx, array $o = []): CostingContext
    {
        $d = config('costing.defaults');
        $margin = config('costing.margin');
        $overhead = config('costing.overhead');

        return new CostingContext(
            costingDate: (string) ($o['costing_date'] ?? now()->toDateString()),
            payingPax: (int) ($o['paying_pax'] ?? 35),
            freeSeats: (int) ($o['free_seats'] ?? 0),
            nightMakkah: (int) ($o['night_makkah'] ?? 4),
            nightMadinah: (int) ($o['night_madinah'] ?? 4),
            occupancy: (int) ($o['occupancy'] ?? $d['occupancy']),
            saudiGroundDays: (int) ($o['saudi_ground_days'] ?? 8),
            fx: $fx,
            publishPrice: (float) ($o['publish_price'] ?? 39_500_000),
            channelMixAgentPct: (float) ($o['channel_mix_agent_pct'] ?? $d['channel_mix_agent_pct']),
            transitVilla: (bool) ($o['transit_villa'] ?? true),
            handlingBundledLA: (bool) ($o['handling_bundled_la'] ?? false),
            mutawwifFreeFromHandler: (bool) ($o['mutawwif_free'] ?? false),
            farkiyahFloor: (int) ($o['farkiyah_floor'] ?? $d['farkiyah_floor']),
            tlRatio: (int) ($o['tl_ratio'] ?? $d['tl_ratio']),
            tlAllocation: (float) ($o['tl_allocation'] ?? $d['tl_allocation']),
            tlSeatCost: (float) ($o['tl_seat_cost'] ?? $d['tl_seat_cost_estimate']),
            freeSeatDivisor: (int) ($o['free_seat_divisor'] ?? $d['free_seat_divisor']),
            marginFloor: (float) ($o['margin_floor'] ?? $margin['floor']),
            marginTarget: (float) ($o['margin_target'] ?? $margin['target']),
            seatsBooked: (int) ($o['seats_booked'] ?? 35),
            materialisationPct: (float) ($o['materialisation_pct'] ?? $d['materialisation_pct']),
            staffSalaryMode: (string) ($o['staff_salary_mode'] ?? $overhead['mode']),
            staffSalaryFlat: (float) ($o['staff_salary_flat'] ?? $d['staff_salary_flat']),
            overheadAnnualPool: isset($o['overhead_annual_pool']) ? (float) $o['overhead_annual_pool'] : $overhead['annual_pool'],
            departuresPerYear: isset($o['departures_per_year']) ? (int) $o['departures_per_year'] : $overhead['departures_per_year'],
            pilgrimsPerDeparture: isset($o['pilgrims_per_departure']) ? (int) $o['pilgrims_per_departure'] : $overhead['pilgrims_per_departure'],
            procurementMode: (string) ($o['procurement_mode'] ?? 'block'),
            tlOptIn: (bool) ($o['tl_opt_in'] ?? false),
            packageTier: (string) ($o['package_tier'] ?? 'standard'),
            materialisationBasis: (string) ($o['materialisation_basis'] ?? 'booked'),
        );
    }
}
