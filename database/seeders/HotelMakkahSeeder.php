<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\HotelChain;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Curated master records for well-known Makkah hotels around Masjidil Haram.
 *
 * VERIFICATION STANDARD (per Haifa's rule — accuracy over completeness):
 * only fields that are widely-documented, stable public facts are set here —
 * the hotel's name, brand/chain, city, and (for the unambiguous luxury
 * towers) the 5-star class, plus a factual location note. Every precision
 * field that would require live verification — exact GPS, phone, email,
 * official URL, metres/minutes to the Haram, room count, check-in/out — is
 * left NULL on purpose, to be enriched later from official sources or via the
 * TBO content sync (HotelSyncService gap-fills nulls without clobbering
 * curated values). NULL is always preferred over a guess.
 *
 * Idempotent: updateOrCreate keyed on slug.
 */
class HotelMakkahSeeder extends Seeder
{
    public function run(): void
    {
        $chain = fn (string $name) => HotelChain::where('slug', Str::slug($name))->value('id');

        // [nama, chain|null, bintang|null, deskripsi|null]
        $hotels = [
            // Abraj Al Bait / Makkah Clock Royal Tower complex — adjacent to Masjidil Haram
            ['Fairmont Makkah Clock Royal Tower', 'Fairmont', 5, 'Hotel bintang 5 di menara Makkah Clock Royal Tower (Abraj Al Bait), berdekatan dengan Masjidil Haram.'],
            ['Raffles Makkah Palace', 'Raffles', 5, 'Hotel mewah di kompleks Abraj Al Bait, menghadap Masjidil Haram.'],
            ['Swissôtel Makkah', 'Swissôtel', 5, 'Bagian dari kompleks Abraj Al Bait, dekat Masjidil Haram.'],
            ['Swissôtel Al Maqam Makkah', 'Swissôtel', 5, 'Bagian dari kompleks Abraj Al Bait, dekat Masjidil Haram.'],
            ['Pullman ZamZam Makkah', 'Pullman', 5, 'Bagian dari kompleks Abraj Al Bait, dekat Masjidil Haram.'],
            ['Mövenpick Hotel & Residence Hajar Tower Makkah', 'Mövenpick', 5, 'Menara Hajar di kompleks Abraj Al Bait, dekat Masjidil Haram.'],

            // Jabal Omar development — near Masjidil Haram
            ['Jabal Omar Marriott Hotel Makkah', 'Marriott', 5, 'Bagian dari pengembangan Jabal Omar, dekat Masjidil Haram.'],
            ['Jabal Omar Hyatt Regency Makkah', 'Hyatt Regency', 5, 'Bagian dari pengembangan Jabal Omar, dekat Masjidil Haram.'],
            ['Address Jabal Omar Makkah', 'Address', 5, 'Bagian dari pengembangan Jabal Omar, dekat Masjidil Haram.'],
            ['Conrad Makkah', 'Conrad', 5, 'Bagian dari pengembangan Jabal Omar, dekat Masjidil Haram.'],
            ['DoubleTree by Hilton Makkah Jabal Omar', 'DoubleTree by Hilton', null, 'Bagian dari pengembangan Jabal Omar, dekat Masjidil Haram.'],

            // Other well-known branded properties in Makkah
            ['Hilton Makkah Convention Hotel', 'Hilton', 5, 'Hotel bintang 5 di Makkah, dekat Masjidil Haram.'],
            ['Hilton Suites Makkah', 'Hilton', 5, 'Hotel suite di Makkah, dekat Masjidil Haram.'],
            ['Le Méridien Makkah', 'Le Méridien', 5, 'Hotel bintang 5 di Makkah.'],
            ['Voco Makkah', 'Voco', null, 'Hotel di Makkah, dekat Masjidil Haram.'],
            ['Anjum Hotel Makkah', 'Anjum', 5, 'Hotel besar di Makkah, dekat Masjidil Haram.'],
            ['Elaf Kinda Hotel', 'Elaf', null, 'Hotel di Makkah, dekat Masjidil Haram.'],
            ['Elaf Al Mashaer Hotel', 'Elaf', null, 'Hotel di Makkah, dekat Masjidil Haram.'],
            ['Millennium Makkah Al Naseem', 'Millennium', null, 'Hotel di Makkah.'],
            ['M Hotel Makkah by Millennium', 'Millennium', null, 'Hotel di Makkah, dekat Masjidil Haram.'],
        ];

        foreach ($hotels as [$nama, $chainName, $bintang, $deskripsi]) {
            Hotel::updateOrCreate(
                ['slug' => Str::slug($nama)],
                [
                    'nama_hotel' => $nama,
                    'hotel_chain_id' => $chainName ? $chain($chainName) : null,
                    'kota' => 'Makkah',
                    'negara' => 'Arab Saudi',
                    'bintang' => $bintang,
                    'deskripsi' => $deskripsi,
                    'aktif' => true,
                    // precision fields intentionally NULL — see class docblock
                ]
            );
        }
    }
}
