<?php

namespace Database\Seeders;

use App\Models\Costing\PackageTier;
use Illuminate\Database\Seeder;

/**
 * The four product tiers (Addendum 3). Only the standard-tier floor is a
 * confirmed value (Rp2jt absolute); budget/premium floors and the private
 * per-quotation target are left for the owner to set before Phase 6. The engine
 * falls back to the config floor and labels it as a default meanwhile.
 */
class PackageTierSeeder extends Seeder
{
    public function run(): void
    {
        $tiers = [
            ['budget', 'Budget ("sendal jepit")', 'Transit/LCC, hotel 3-star.', false, 30_000_000, null, null, null, 1],
            ['standard', 'Standard', 'Direct, hotel 4-star. Profil golden master.', false, 38_000_000, 'absolute', 2_000_000, null, 2],
            ['premium', 'Premium', 'Direct Saudia/Garuda, 5-star ring 1. Dibangun saat demand mendukung.', false, 50_000_000, null, null, null, 3],
            ['private', 'Private', 'FIT/business, luxury. Harga tidak dipublikasikan — per kuotasi.', true, 50_000_000, 'per_quotation', null, null, 4],
        ];

        foreach ($tiers as $t) {
            PackageTier::updateOrCreate(
                ['key' => $t[0]],
                [
                    'nama' => $t[1],
                    'deskripsi' => $t[2],
                    'is_private' => $t[3],
                    'estimated_publish' => $t[4],
                    'margin_floor_type' => $t[5],
                    'margin_floor_amount' => $t[6],
                    'margin_floor_pct' => $t[7],
                    'sort_order' => $t[8],
                ],
            );
        }
    }
}
