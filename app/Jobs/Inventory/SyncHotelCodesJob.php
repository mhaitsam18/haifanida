<?php

namespace App\Jobs\Inventory;

use App\Models\HotelExternalId;
use App\Models\HotelSyncRun;
use App\Services\Inventory\InventoryManager;
use Illuminate\Bus\Batch;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Str;
use Throwable;

/**
 * Step 1 of a sync run: download the provider's hotel codes for the configured
 * cities, then fan out one SyncHotelDetailJob per hotel inside a Bus batch.
 * The batch gives resumable progress + per-hotel failure isolation; this job
 * only enumerates and dispatches. Provider-agnostic (works for any provider
 * implementing SupportsContentSync).
 */
class SyncHotelCodesJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 2;

    public function __construct(public int $runId) {}

    public function handle(InventoryManager $manager): void
    {
        $run = HotelSyncRun::findOrFail($this->runId);
        $run->update(['status' => 'running', 'started_at' => now()]);

        // Resolve as a content-sync provider — throws (→ run failed) if the
        // configured provider can't enumerate content.
        $provider = $manager->contentProvider($run->provider);

        // Enumerate + de-duplicate codes across the configured cities.
        $codes = collect(config('inventory.sync.cities', []))
            ->flatMap(fn ($city) => $provider->listHotelCodes($city))
            ->unique()
            ->values();

        // Incremental: skip hotels synced within the freshness window.
        if ($run->type === 'incremental') {
            $cutoff = now()->subHours((int) config('inventory.sync.incremental_after_hours', 24));
            $fresh = HotelExternalId::forProvider($run->provider)
                ->where('last_synced_at', '>=', $cutoff)
                ->pluck('external_id')
                ->all();
            $codes = $codes->reject(fn ($code) => in_array($code, $fresh, true))->values();
        }

        $run->update(['total_hotels' => $codes->count(), 'processed_hotels' => 0, 'failed_hotels' => 0]);

        if ($codes->isEmpty()) {
            $run->update(['status' => 'completed', 'finished_at' => now()]);

            return;
        }

        $runId = $run->id;
        $jobs = $codes->map(fn ($code) => new SyncHotelDetailJob($run->id, $run->provider, $code))->all();

        $batch = Bus::batch($jobs)
            ->name("hotel-sync:{$run->provider}:{$run->id}")
            ->allowFailures()
            ->onQueue(config('inventory.sync.detail_job_queue', 'default'))
            ->finally(function (Batch $b) use ($runId) {
                HotelSyncRun::whereKey($runId)->update([
                    'status' => $b->cancelled() ? 'cancelled' : 'completed',
                    'finished_at' => now(),
                ]);
            })
            ->dispatch();

        $run->update(['batch_id' => $batch->id]);
    }

    public function failed(Throwable $e): void
    {
        HotelSyncRun::whereKey($this->runId)->update([
            'status' => 'failed',
            'finished_at' => now(),
            'error' => Str::limit($e->getMessage(), 1000),
        ]);
    }
}
