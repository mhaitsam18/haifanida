<?php

namespace Database\Seeders;

use App\Models\Costing\AncillaryProduct;
use Illuminate\Database\Seeder;

/**
 * Ancillary catalogue from the "Produk Tambahan" sheet. Equipment/manasik and
 * the Indonesia bus default to all-in (certain revenue); vaccine, passport and
 * merchandise to optional with their take-up assumptions.
 */
class AncillaryProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['perlengkapan_manasik', 'Perlengkapan + Manasik + Catering', 'equipment_manasik', 'per_pilgrim', 'all_in', 2_000_000, 2_500_000, null, 1],
            ['bus_indonesia', 'Bus Indonesia (jemput PP)', 'transport', 'per_pilgrim', 'all_in', 200_000, 300_000, null, 2],
            ['vaksin', 'Vaksin & Layanan Kesehatan', 'health', 'per_pilgrim', 'optional', 500_000, 650_000, 0.60, 3],
            ['paspor', 'Pengurusan Paspor', 'passport', 'per_pilgrim', 'optional', 150_000, 350_000, 0.30, 4],
            ['merchandise', 'Merchandise', 'merchandise', 'per_pilgrim', 'optional', 200_000, 350_000, 0.40, 5],
        ];

        foreach ($products as $p) {
            AncillaryProduct::updateOrCreate(
                ['key' => $p[0]],
                [
                    'nama' => $p[1],
                    'family' => $p[2],
                    'vendor_choice_level' => $p[3],
                    'default_packaging' => $p[4],
                    'default_cost' => $p[5],
                    'default_sell' => $p[6],
                    'default_takeup_pct' => $p[7],
                    'sort_order' => $p[8],
                ],
            );
        }
    }
}
