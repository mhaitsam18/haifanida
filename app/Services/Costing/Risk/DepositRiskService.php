<?php

namespace App\Services\Costing\Risk;

use App\Models\Costing\Keberangkatan;
use App\Services\Costing\Support\FxPolicy;

/**
 * Turns ticket-lot deposit terms into the rupiah at risk behind the
 * materialisation threshold. On-demand departures carry no block, so there is
 * nothing at risk. For block departures the whole-deposit / seats-booked reading
 * is the conservative default; prorated forfeiture and the paid/flown bases are
 * expressible for when the vendor terms are confirmed.
 */
class DepositRiskService
{
    public function forDeparture(Keberangkatan $dep, FxPolicy $fx): DepositRisk
    {
        if ($dep->isOnDemand()) {
            return DepositRisk::notApplicable();
        }

        $seatsBooked = (int) ($dep->seats_booked ?? $dep->planned_pax);
        $realised = (int) $dep->planned_pax;
        $thresholdPct = (float) ($dep->materialisation_pct ?? config('costing.defaults.materialisation_pct'));
        $forfeitMode = $dep->forfeit_mode ?? 'whole';
        $basis = $dep->materialisation_basis ?? 'booked';

        $totalDeposit = 0.0;
        foreach ($dep->ticketLots as $lot) {
            $totalDeposit += $lot->depositAmount() * $fx->rateFor($lot->currency);
        }

        $breached = $seatsBooked > 0 && ($realised / $seatsBooked + 1e-9) < $thresholdPct;

        $atRiskNow = 0.0;
        if ($breached) {
            $atRiskNow = $forfeitMode === 'prorated' && $seatsBooked > 0
                ? $totalDeposit * (max(0, $seatsBooked - $realised) / $seatsBooked)
                : $totalDeposit;
        }

        return new DepositRisk(
            applicable: true,
            totalDeposit: $totalDeposit,
            atRiskNow: $atRiskNow,
            forfeitMode: $forfeitMode,
            basis: $basis,
            breached: $breached,
            seatsBooked: $seatsBooked,
            realised: $realised,
        );
    }
}
