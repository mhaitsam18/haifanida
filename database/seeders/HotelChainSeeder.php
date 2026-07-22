<?php

namespace Database\Seeders;

use App\Models\HotelChain;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Hotel brands present around the Haramain. These are widely-documented,
 * stable brand→parent-group facts (not fabricated). `negara_asal` is filled
 * only where the group's origin is unambiguous and left NULL otherwise.
 * Idempotent via updateOrCreate on slug.
 */
class HotelChainSeeder extends Seeder
{
    public function run(): void
    {
        $chains = [
            // [nama, negara_asal|null]  (parent group in comment)
            ['Fairmont', 'Kanada'],              // Accor
            ['Raffles', 'Singapura'],            // Accor
            ['Swissôtel', 'Swiss'],              // Accor
            ['Pullman', 'Prancis'],              // Accor
            ['Mövenpick', 'Swiss'],              // Accor
            ['Sofitel', 'Prancis'],              // Accor
            ['Novotel', 'Prancis'],              // Accor
            ['Conrad', 'Amerika Serikat'],       // Hilton
            ['Hilton', 'Amerika Serikat'],       // Hilton
            ['DoubleTree by Hilton', 'Amerika Serikat'], // Hilton
            ['Waldorf Astoria', 'Amerika Serikat'],      // Hilton
            ['Marriott', 'Amerika Serikat'],     // Marriott
            ['The Ritz-Carlton', 'Amerika Serikat'],     // Marriott
            ['Le Méridien', 'Prancis'],          // Marriott
            ['Sheraton', 'Amerika Serikat'],     // Marriott
            ['Hyatt Regency', 'Amerika Serikat'],// Hyatt
            ['InterContinental', 'Inggris'],     // IHG
            ['Crowne Plaza', 'Inggris'],         // IHG
            ['Voco', 'Inggris'],                 // IHG
            ['Holiday Inn', 'Amerika Serikat'],  // IHG
            ['Millennium', null],                // Millennium & Copthorne
            ['Anjum', null],
            ['Address', 'Uni Emirat Arab'],      // Emaar
            ['Shaza', null],
            ['Elaf', 'Arab Saudi'],
            ['The Oberoi', 'India'],
        ];

        foreach ($chains as [$nama, $negara]) {
            HotelChain::updateOrCreate(
                ['slug' => Str::slug($nama)],
                ['nama' => $nama, 'negara_asal' => $negara]
            );
        }
    }
}
