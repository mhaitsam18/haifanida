<?php

namespace App\Console\Commands;

use App\Services\Inventory\HotelSyncManager;
use Illuminate\Console\Command;

/**
 * Start a hotel content sync from the CLI or the scheduler.
 *   php artisan hotel:sync                # full
 *   php artisan hotel:sync --type=incremental
 */
class HotelSyncCommand extends Command
{
    protected $signature = 'hotel:sync {--type=full : full|incremental}';
    protected $description = 'Synchronize hotel master data from the configured inventory provider';

    public function handle(HotelSyncManager $manager): int
    {
        $type = $this->option('type');
        $run = $manager->start($type);

        $this->info("Hotel sync started: provider={$run->provider}, type={$run->type}, run #{$run->id}, status={$run->status}.");

        return self::SUCCESS;
    }
}
