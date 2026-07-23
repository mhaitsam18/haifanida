<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Orchestrates the costing master-data seeders. Run explicitly:
 *   php artisan db:seed --class=CostingDatabaseSeeder
 * Not wired into DatabaseSeeder so it never runs unintentionally in production.
 * Every seeder is idempotent.
 */
class CostingDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            FxPolicyVersionSeeder::class,
            CoverageTagSeeder::class,
            CostComponentSeeder::class,
            VisaCoverageRulesetSeeder::class,
            BaselineRateCardSeeder::class,
        ]);
    }
}
