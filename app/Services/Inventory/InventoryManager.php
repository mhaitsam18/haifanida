<?php

namespace App\Services\Inventory;

use App\Services\Inventory\Contracts\InventoryProvider;
use App\Services\Inventory\Contracts\SupportsContentSync;
use App\Services\Inventory\Contracts\SupportsLiveInventory;
use App\Services\Inventory\Tbo\TboService;
use InvalidArgumentException;

/**
 * Resolves inventory providers from config/inventory.php and exposes them by
 * capability. Business code asks for the capability it needs
 * (contentProvider / liveProvider) and gets a clear error if the configured
 * provider does not offer it. Adding a provider = one match arm + a config
 * block; nothing else changes.
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

    /** The provider as a STATIC-content source (throws if unsupported). */
    public function contentProvider(?string $name = null): SupportsContentSync
    {
        $provider = $this->provider($name);

        if (! $provider instanceof SupportsContentSync) {
            throw new InvalidArgumentException("Provider [{$provider->key()}] does not support content synchronization.");
        }

        return $provider;
    }

    /** The provider as a DYNAMIC-inventory source (throws if unsupported). */
    public function liveProvider(?string $name = null): SupportsLiveInventory
    {
        $provider = $this->provider($name);

        if (! $provider instanceof SupportsLiveInventory) {
            throw new InvalidArgumentException("Provider [{$provider->key()}] does not support live inventory.");
        }

        return $provider;
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
