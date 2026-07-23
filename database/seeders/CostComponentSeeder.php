<?php

namespace Database\Seeders;

use App\Models\Costing\CostComponent;
use Illuminate\Database\Seeder;

/**
 * The component taxonomy from the workbook's "Biaya Produksi" and "Produk
 * Tambahan" sheets. Behaviours drive the phase-3 calculation. Only the flight
 * ticket carries the individual-vendor ban (the 2022 rule), scoped here.
 *
 * The visa component intentionally has NO provides_tags: its bundle contents are
 * effective-dated and resolved via visa_coverage_ruleset by departure date.
 */
class CostComponentSeeder extends Seeder
{
    public function run(): void
    {
        $components = [
            // key, nama, kategori, behavior, unit, currency, provides, requires, reqInc, rejInd, mandatory
            ['tiket_pesawat', 'Tiket Pesawat PP', 'production', 'PER_PILGRIM', 'orang', 'IDR', null, null, true, true, true],
            ['hotel_makkah', 'Hotel Makkah', 'production', 'PER_ROOM_NIGHT', 'kamar-malam', 'IDR', null, ['hotel_makkah'], false, false, true],
            ['hotel_madinah', 'Hotel Madinah', 'production', 'PER_ROOM_NIGHT', 'kamar-malam', 'IDR', null, ['hotel_madinah'], false, false, true],
            ['visa_umroh', 'Visa Umroh', 'production', 'PER_PILGRIM', 'orang', 'USD', null, null, false, false, true],
            ['farkiyah', 'Farkiyah (kurang dari ambang)', 'production', 'MIN_GUARANTEE', 'kursi', 'USD', null, null, false, false, false],
            ['tasreh_raudhah', 'Tasreh Raudhah', 'production', 'PER_PILGRIM', 'orang', 'SAR', null, null, false, false, true],
            ['mutawwif', 'Mutawwif / Tour Guide', 'production', 'PER_GROUP_PER_DAY', 'hari', 'SAR', null, ['mutawwif'], false, false, false],
            ['tour_leader', 'Alokasi Tour Leader', 'production', 'PER_PILGRIM', 'orang', 'IDR', null, null, false, false, true],
            ['local_arrangement', 'Local Arrangement tambahan', 'production', 'PER_PILGRIM', 'orang', 'IDR', null, null, false, false, false],
            ['transit_villa', 'Transit Villa', 'production', 'CONDITIONAL', 'orang', 'IDR', null, null, false, false, false],
            ['handling_cgk', 'Airport Handling CGK', 'production', 'PER_PILGRIM', 'orang-leg', 'IDR', null, null, false, false, true],
            ['handling_makkah_madinah', 'Handling Makkah-Madinah', 'production', 'PER_PILGRIM', 'orang', 'USD', null, ['handling_makkah', 'handling_madinah', 'handling_jeddah'], false, false, true],
            ['asuransi', 'Asuransi Perjalanan', 'production', 'PER_PILGRIM', 'orang', 'IDR', null, null, false, false, true],
            ['administrasi', 'Administrasi', 'production', 'PER_PILGRIM', 'orang', 'IDR', null, null, false, false, true],
            ['operasional_kantor', 'Operasional Kantor', 'production', 'PER_PILGRIM', 'orang', 'IDR', null, null, false, false, true],
            ['cadangan_risiko', 'Cadangan Risiko', 'production', 'PER_PILGRIM', 'orang', 'IDR', null, null, false, false, true],

            // Markups (loaded onto price, not HPP).
            ['gaji_staff', 'Alokasi Gaji Staff', 'markup', 'MARKUP', 'orang', 'IDR', null, null, false, false, false],
            ['fee_agen', 'Fee Agen', 'markup', 'CHANNEL_DEPENDENT', 'orang', 'IDR', null, null, false, false, true],

            // Ancillary (Produk Tambahan) — sold all-in or optional.
            ['perlengkapan_manasik', 'Perlengkapan + Manasik + Catering', 'ancillary', 'PER_PILGRIM', 'orang', 'IDR', null, null, false, false, false],
            ['bus_indonesia', 'Bus Indonesia (jemput PP)', 'ancillary', 'PER_PILGRIM', 'orang', 'IDR', null, null, false, false, false],
            ['vaksin', 'Vaksin & Layanan Kesehatan', 'ancillary', 'PER_PILGRIM', 'orang', 'IDR', null, null, false, false, false],
            ['paspor', 'Pengurusan Paspor', 'ancillary', 'PER_PILGRIM', 'orang', 'IDR', null, null, false, false, false],
            ['merchandise', 'Merchandise', 'ancillary', 'PER_PILGRIM', 'orang', 'IDR', null, null, false, false, false],
        ];

        foreach ($components as $i => $c) {
            CostComponent::updateOrCreate(
                ['key' => $c[0]],
                [
                    'nama' => $c[1],
                    'kategori' => $c[2],
                    'behavior' => $c[3],
                    'default_unit' => $c[4],
                    'default_currency' => $c[5],
                    'provides_tags' => $c[6],
                    'requires_tags' => $c[7],
                    'requires_incorporated_vendor' => $c[8],
                    'rejects_individual_vendor' => $c[9],
                    'is_mandatory' => $c[10],
                    'sort_order' => $i + 1,
                ],
            );
        }
    }
}
