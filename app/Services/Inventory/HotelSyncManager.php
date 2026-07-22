<?php

namespace App\Services\Inventory;

use App\Jobs\Inventory\SyncHotelCodesJob;
use App\Models\HotelSyncRun;

/**
 * Entry point for starting a synchronization run (used by the admin page,
 * the Artisan command, and the scheduler). Provider-agnostic: it always acts
 * on config('inventory.default'). Guards against overlapping runs.
 */
class HotelSyncManager
{
    /**
     * @param  string  $type  full|incremental
     */
    public function start(string $type = 'full'): HotelSyncRun
    {
        $provider = config('inventory.default');

        // Never run two syncs for the same provider at once — return the live one.
        $active = HotelSyncRun::where('provider', $provider)
            ->whereIn('status', ['queued', 'running'])
            ->latest('id')
            ->first();

        if ($active) {
            return $active;
        }

        $run = HotelSyncRun::create([
            'provider' => $provider,
            'type' => in_array($type, ['full', 'incremental'], true) ? $type : 'full',
            'status' => 'queued',
        ]);

        SyncHotelCodesJob::dispatch($run->id);

        return $run;
    }

    public function currentProvider(): string
    {
        return config('inventory.default');
    }

    public function latestRun(): ?HotelSyncRun
    {
        return HotelSyncRun::latest('id')->first();
    }
}
