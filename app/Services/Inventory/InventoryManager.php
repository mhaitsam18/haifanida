<?php

namespace App\Services\Inventory;

use App\Services\Inventory\Contracts\InventoryProvider;
use App\Services\Inventory\Tbo\TboService;
use InvalidArgumentException;

/**
 * Resolves a concrete InventoryProvider by name from config/inventory.php.
 * Adding a provider = one more match arm + a config block; business code
 * keeps asking for the InventoryProvider interface and never changes.
 */
class InventoryManager
{
    /** @var array<string, InventoryProvider> */
    private array $resolved = [];

    public function provider(?string $name = null): InventoryProvider
    {
        $name ??= config('inventory.default');

        return $this->resolved[$name] ??= $this->build($name);
    }

    private function build(string $name): InventoryProvider
    {
        $config = config("inventory.providers.{$name}");

        if (! is_array($config)) {
            throw new InvalidArgumentException("Inventory provider [{$name}] is not defined in config/inventory.php.");
        }

        return match ($config['driver'] ?? null) {
            'tbo' => new TboService($config),
            // 'ratehawk'  => new \App\Services\Inventory\RateHawk\RateHawkService($config),
            // 'hotelbeds' => new \App\Services\Inventory\Hotelbeds\HotelbedsService($config),
            default => throw new InvalidArgumentException("Unsupported inventory driver [{$config['driver']}] for provider [{$name}]."),
        };
    }
}
