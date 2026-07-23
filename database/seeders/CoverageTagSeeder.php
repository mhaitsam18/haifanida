<?php

namespace Database\Seeders;

use App\Models\Costing\CoverageTag;
use Illuminate\Database\Seeder;

class CoverageTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'ground_transport_makkah_madinah' => 'Transportasi darat Jeddah–Makkah–Madinah',
            'city_tour' => 'City tour',
            'taif_tour' => 'Tur Taif',
            'handling_jeddah' => 'Handling Jeddah',
            'handling_makkah' => 'Handling Makkah',
            'handling_madinah' => 'Handling Madinah',
            'mutawwif' => 'Mutawwif / pembimbing ibadah',
            'hotel_makkah' => 'Hotel Makkah',
            'hotel_madinah' => 'Hotel Madinah',
        ];

        foreach ($tags as $key => $label) {
            CoverageTag::updateOrCreate(['key' => $key], ['label' => $label]);
        }
    }
}
