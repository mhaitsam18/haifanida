<?php

namespace App\Jobs\Inventory;

use App\Models\HotelExternalId;
use App\Models\HotelSyncRun;
use App\Services\Inventory\HotelSyncService;
use App\Services\Inventory\InventoryManager;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Throwable;

/**
 * Downloads ONE hotel's static content from the provider and folds it into the
 * curated master (via HotelSyncService, which gap-fills nulls only). One job
 * per hotel = the unit of resumability: a failure isolates to that hotel, the
 * batch retries it, and re-running is idempotent (updateOrCreate throughout).
 * Provider-agnostic — it resolves whichever provider the run names.
 */
class SyncHotelDetailJob implements ShouldQueue
{
    use Batchable, Queueable;

    public int $tries = 3;
    public array $backoff = [10, 30, 60];

    public function __construct(
        public int $runId,
        public string $provider,
        public string $hotelCode,
    ) {}

    public function handle(InventoryManager $manager, HotelSyncService $sync): void
    {
        if ($this->batch()?->cancelled()) {
            return;
        }

        $provider = $manager->contentProvider($this->provider);
        $content = $provider->getHotelContent($this->hotelCode);

        if ($content !== null) {
            $hotel = $sync->syncContent($provider, $content);

            $hotel->externalIds()
                ->where('provider', $provider->key())
                ->where('external_id', $this->hotelCode)
                ->update([
                    'sync_status' => 'synced',
                    'last_synced_at' => now(),
                    // Provider's own last-modified, when the adapter supplies it,
                    // so future incremental logic can trust the source timestamp.
                    'provider_updated_at' => $content->providerUpdatedAt
                        ? Carbon::parse($content->providerUpdatedAt)
                        : null,
                    'sync_error' => null,
                ]);
        }

        HotelSyncRun::whereKey($this->runId)->increment('processed_hotels');
    }

    /** Runs after all retries are exhausted — record the failure, keep the run consistent. */
    public function failed(Throwable $e): void
    {
        HotelSyncRun::whereKey($this->runId)->increment('failed_hotels');

        // Mark the mapping failed if it already exists (a known hotel);
        // brand-new codes that never got created simply count on the run.
        HotelExternalId::forProvider($this->provider)
            ->where('external_id', $this->hotelCode)
            ->update([
                'sync_status' => 'failed',
                'sync_error' => Str::limit($e->getMessage(), 1000),
            ]);
    }
}
