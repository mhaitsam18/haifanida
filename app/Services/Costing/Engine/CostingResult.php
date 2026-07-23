<?php

namespace App\Services\Costing\Engine;

/**
 * The full result of costing one departure at one group size. Margins are
 * reported two ways: budgeted (all bookings agent-sourced, so the full agent fee
 * is cost) and expected (given the actual channel mix, the fee on direct
 * bookings is recovered as margin).
 */
final class CostingResult
{
    public function __construct(
        /** @var LineResult[] */
        public readonly array $lines,
        public readonly float $productionGroupTotal,
        public readonly float $productionPerPilgrim,
        public readonly float $focPerPilgrim,
        public readonly float $staffSalaryPerPilgrim,
        public readonly string $staffSalaryRule,
        public readonly float $agentFeePerPilgrim,
        public readonly float $burdenPerPilgrim,
        public readonly float $publishPrice,
        public readonly float $packageMargin,
        public readonly float $expectedMargin,
        public readonly float $distanceToFloor,
        public readonly string $marginStatus,
        public readonly float $minPublishForFloor,
        public readonly float $targetPublish,
        public readonly TlSufficiency $tl,
        public readonly Materialisation $materialisation,
        /** @var string[] */
        public readonly array $warnings,
    ) {}

    public function line(string $key): ?LineResult
    {
        foreach ($this->lines as $line) {
            if ($line->key === $key) {
                return $line;
            }
        }

        return null;
    }
}
