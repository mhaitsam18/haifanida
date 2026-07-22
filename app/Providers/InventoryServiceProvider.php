<?php

namespace App\Providers;

use App\Services\Inventory\Contracts\InventoryProvider;
use App\Services\Inventory\InventoryManager;
use Illuminate\Support\ServiceProvider;

class InventoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // The manager (resolve any provider by name — for future aggregation).
        $this->app->singleton(InventoryManager::class, fn () => new InventoryManager());

        // The default provider: business code type-hints InventoryProvider and
        // gets whatever config('inventory.default') names — TBO today.
        $this->app->bind(
            InventoryProvider::class,
            fn ($app) => $app->make(InventoryManager::class)->provider()
        );
    }
}
