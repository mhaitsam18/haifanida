<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Runs the hotel master-data seeders in dependency order (chains + facilities
 * before hotels, which reference chains). All are idempotent (updateOrCreate),
 * so this is safe to re-run. Call with:
 *   php artisan db:seed --class=HotelDatabaseSeeder
 */
class HotelDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            HotelChainSeeder::class,
            HotelFacilitySeeder::class,
            HotelMakkahSeeder::class,
            HotelMadinahSeeder::class,
        ]);
    }
}
