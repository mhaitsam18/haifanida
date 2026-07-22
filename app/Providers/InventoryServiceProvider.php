<?php

namespace App\Providers;

use App\Services\Inventory\Contracts\InventoryProvider;
use App\Services\Inventory\Contracts\SupportsContentSync;
use App\Services\Inventory\Contracts\SupportsLiveInventory;
use App\Services\Inventory\InventoryManager;
use Illuminate\Support\ServiceProvider;

class InventoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(InventoryManager::class, fn () => new InventoryManager());

        // Business code injects the capability it needs and gets the configured
        // provider — or a clear error if that provider lacks the capability.
        $this->app->bind(InventoryProvider::class, fn ($app) => $app->make(InventoryManager::class)->provider());
        $this->app->bind(SupportsContentSync::class, fn ($app) => $app->make(InventoryManager::class)->contentProvider());
        $this->app->bind(SupportsLiveInventory::class, fn ($app) => $app->make(InventoryManager::class)->liveProvider());
    }
}
