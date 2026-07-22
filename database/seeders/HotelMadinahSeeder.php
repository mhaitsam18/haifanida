<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\HotelChain;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Curated master records for well-known Madinah hotels around Masjid Nabawi.
 * Same strict verification standard as HotelMakkahSeeder: only stable public
 * facts (name, chain, city, unambiguous 5-star class, factual location note);
 * all precision fields left NULL for later enrichment. Idempotent on slug.
 */
class HotelMadinahSeeder extends Seeder
{
    public function run(): void
    {
        $chain = fn (string $name) => HotelChain::where('slug', Str::slug($name))->value('id');

        // [nama, chain|null, bintang|null, deskripsi|null]
        $hotels = [
            ['Anwar Al Madinah Mövenpick Hotel', 'Mövenpick', 5, 'Hotel bintang 5 di Madinah, dekat Masjid Nabawi.'],
            ['The Oberoi Madina', 'The Oberoi', 5, 'Hotel mewah di Madinah, dekat Masjid Nabawi.'],
            ['Pullman ZamZam Madina', 'Pullman', 5, 'Hotel bintang 5 di Madinah, dekat Masjid Nabawi.'],
            ['Dar Al Taqwa Hotel Madinah', null, 5, 'Hotel bintang 5 di Madinah, menghadap ke arah Masjid Nabawi.'],
            ['Shaza Al Madina', 'Shaza', 5, 'Hotel bintang 5 di Madinah, dekat Masjid Nabawi.'],
            ['InterContinental Dar Al Iman Madinah', 'InterContinental', 5, 'Hotel bintang 5 di Madinah, dekat Masjid Nabawi.'],
            ['Crowne Plaza Madinah', 'Crowne Plaza', 5, 'Hotel bintang 5 di Madinah, dekat Masjid Nabawi.'],
            ['Le Méridien Madinah', 'Le Méridien', 5, 'Hotel bintang 5 di Madinah.'],
            ['Millennium Al Aqeeq Hotel', 'Millennium', 5, 'Hotel bintang 5 di Madinah.'],
            ['Millennium Taiba Hotel', 'Millennium', null, 'Hotel di Madinah, dekat Masjid Nabawi.'],
            ['Frontel Al Harithia Hotel', null, null, 'Hotel di Madinah, dekat Masjid Nabawi.'],
        ];

        foreach ($hotels as [$nama, $chainName, $bintang, $deskripsi]) {
            Hotel::updateOrCreate(
                ['slug' => Str::slug($nama)],
                [
                    'nama_hotel' => $nama,
                    'hotel_chain_id' => $chainName ? $chain($chainName) : null,
                    'kota' => 'Madinah',
                    'negara' => 'Arab Saudi',
                    'bintang' => $bintang,
                    'deskripsi' => $deskripsi,
                    'aktif' => true,
                ]
            );
        }
    }
}
