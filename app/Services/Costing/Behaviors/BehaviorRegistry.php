<?php

namespace App\Services\Costing\Behaviors;

use InvalidArgumentException;

/**
 * Maps a cost_component.behavior key to its strategy. Adding a behaviour = one
 * entry here; the engine never switches on behaviour type.
 */
class BehaviorRegistry
{
    /** @var array<string, CostBehavior> */
    private array $behaviors;

    public function __construct()
    {
        $this->behaviors = collect([
            new PerPilgrim(),
            new PerRoomNight(),
            new PerGroup(),
            new PerGroupPerDay(),
            new Stepped(),
            new MinGuarantee(),
            new Markup(),
            new ChannelDependent(),
            new FocDiluted(),
        ])->keyBy(fn (CostBehavior $b) => $b->key())->all();
    }

    public function for(string $behaviorKey): CostBehavior
    {
        return $this->behaviors[$behaviorKey]
            ?? throw new InvalidArgumentException("No cost behaviour registered for [{$behaviorKey}].");
    }
}
