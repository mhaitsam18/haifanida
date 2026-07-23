<?php

namespace App\Services\Costing\Risk;

/**
 * Flight-deposit exposure for a departure. applicable=false for on-demand (no
 * block). atRiskNow is what would be forfeited if the departure closed at the
 * current realised count; totalDeposit is the committed exposure. basis
 * (booked|paid|flown) and forfeitMode (whole|prorated) are carried so a
 * conservative default is never mistaken for a confirmed contract term.
 */
final class DepositRisk
{
    public function __construct(
        public readonly bool $applicable,
        public readonly float $totalDeposit,
        public readonly float $atRiskNow,
        public readonly string $forfeitMode,
        public readonly string $basis,
        public readonly bool $breached,
        public readonly int $seatsBooked,
        public readonly int $realised,
    ) {}

    public static function notApplicable(): self
    {
        return new self(false, 0.0, 0.0, 'whole', 'booked', false, 0, 0);
    }
}
