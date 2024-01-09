<?php

namespace Database\Seeders;

use App\Models\PaketHotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenginapanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penginapans = [
            [
                'paket_id' => 1,
                'hotel_id' => 1,
                'nomor_reservasi' => '1',
                'tanggal_check_in' => '2024-02-25',
                'tanggal_check_out' => '2024-02-29',
                'jumlah_kamar' => '90',
                'total_harga' => 90 * 4000000,
                'keterangan_hotel' => 'Dekat dengan Masjid',
            ],
            [
                'paket_id' => 1,
                'hotel_id' => 2,
                'nomor_reservasi' => '2',
                'tanggal_check_in' => '2024-02-29',
                'tanggal_check_out' => '2024-03-04',
                'jumlah_kamar' => '90',
                'total_harga' => 90 * 4000000,
                'keterangan_hotel' => 'Dekat dengan Masjid',
            ],
        ];
        foreach ($penginapans as $penginapan) {
            PaketHotel::create($penginapan);
        }
    }
}
