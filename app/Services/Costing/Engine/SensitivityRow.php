<?php

namespace App\Services\Costing\Engine;

/**
 * One row of the group-size sensitivity table. Unlike the workbook — which held
 * hotel cost at its 35-pax value — every figure here is a full recompute at the
 * row's pax, and it carries the materialisation columns the workbook lacks.
 * status: materialisation breach dominates margin; a departure below the
 * threshold is never shown as safe.
 */
final class SensitivityRow
{
    public const STATUS_DEPOSIT_FORFEIT = 'DEPOSIT_HANGUS';

    public function __construct(
        public readonly int $pax,
        public readonly float $farkiyahPerPilgrim,
        public readonly float $mutawwifPerPilgrim,
        public readonly int $tlRequired,
        public readonly float $tlSurplus,
        public readonly float $burdenPerPilgrim,
        public readonly float $marginPerPilgrim,
        public readonly float $distanceToFloor,
        public readonly string $marginStatus,
        public readonly float $materialisationPct,
        public readonly bool $materialisationBreached,
        public readonly ?float $depositAtRisk,
        public readonly string $status,
    ) {}
}
