<?php

namespace Database\Seeders;

use App\Models\HotelFacility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Standard reference facilities used to tag hotels. Generic, non-fabricated
 * reference data (a controlled vocabulary), Boxicons for the icon. Idempotent
 * via updateOrCreate on slug. Meal/board options live here as facilities.
 */
class HotelFacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            // [nama, icon, kategori]
            ['WiFi Gratis', 'bx-wifi', 'Umum'],
            ['AC', 'bx-wind', 'Kamar'],
            ['Restoran Halal', 'bx-restaurant', 'Makan'],
            ['Sarapan', 'bx-coffee', 'Makan'],
            ['Musholla / Ruang Salat', 'bx-moon', 'Ibadah'],
            ['Layanan Kamar 24 Jam', 'bx-bell', 'Layanan'],
            ['Resepsionis 24 Jam', 'bx-user-voice', 'Layanan'],
            ['Layanan Antar-Jemput (Shuttle)', 'bx-bus', 'Transportasi'],
            ['Parkir', 'bx-car', 'Transportasi'],
            ['Lift', 'bx-chevrons-up', 'Umum'],
            ['Laundry', 'bx-t-shirt', 'Layanan'],
            ['Kamar Keluarga', 'bx-group', 'Kamar'],
            ['Akses Kursi Roda', 'bx-accessibility', 'Aksesibilitas'],
            ['Brankas', 'bx-lock', 'Kamar'],
            ['Pusat Kebugaran', 'bx-dumbbell', 'Rekreasi'],
            ['ATM / Money Changer', 'bx-money', 'Layanan'],
        ];

        foreach ($facilities as [$nama, $icon, $kategori]) {
            HotelFacility::updateOrCreate(
                ['slug' => Str::slug($nama)],
                ['nama' => $nama, 'icon' => $icon, 'kategori' => $kategori]
            );
        }
    }
}
