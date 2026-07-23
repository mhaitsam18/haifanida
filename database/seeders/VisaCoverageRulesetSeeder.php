<?php

namespace Database\Seeders;

use App\Models\Costing\VisaCoverageRuleset;
use Illuminate\Database\Seeder;

/**
 * Effective-dated Umrah visa bundle coverage. Two versions demonstrate the
 * reproducibility requirement: a costing dated 2024 sees no Taif coverage
 * (Taif was a paid extra then), while a 2025+ costing sees Taif bundled free.
 * Idempotent on effective_from.
 */
class VisaCoverageRulesetSeeder extends Seeder
{
    public function run(): void
    {
        // Pre-Taif-free: visa bundles ground transport + city tour only.
        VisaCoverageRuleset::updateOrCreate(
            ['effective_from' => '2023-01-01'],
            [
                'provides_tags' => ['ground_transport_makkah_madinah', 'city_tour'],
                'note' => 'Visa membundel transportasi darat + city tour. Taif masih berbayar terpisah.',
            ],
        );

        // Current: Taif now included free under the latest Saudi rules.
        VisaCoverageRuleset::updateOrCreate(
            ['effective_from' => '2025-01-01'],
            [
                'provides_tags' => ['ground_transport_makkah_madinah', 'city_tour', 'taif_tour'],
                'note' => 'Aturan terbaru: Taif termasuk gratis dalam visa, bersama transportasi darat & city tour.',
            ],
        );
    }
}
