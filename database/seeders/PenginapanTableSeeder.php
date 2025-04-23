<?php

namespace Database\Seeders;

use App\Models\Kamar;
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
                'jumlah_kamar' => '23',
                'total_harga' => 23 * 4000000 + 5000000,
                'keterangan_hotel' => 'Dekat dengan Masjid',
            ],
            [
                'paket_id' => 1,
                'hotel_id' => 2,
                'nomor_reservasi' => '2',
                'tanggal_check_in' => '2024-02-29',
                'tanggal_check_out' => '2024-03-04',
                'jumlah_kamar' => '23',
                'total_harga' => 23 * 4000000 + 5000000,
                'keterangan_hotel' => 'Dekat dengan Masjid',
            ],
        ];
        foreach ($penginapans as $penginapan) {
            PaketHotel::create($penginapan);
        }

        for ($i = 1; $i <= 22; $i++) {
            Kamar::create([
                'paket_hotel_id' => 1,
                'nomor_kamar' => $i,
                'tipe_kamar' => 'Quad',
                'kapasitas' => '4',
                'fasilitas' => 'Bintang 5',
            ]);
        }
        Kamar::create([
            'paket_hotel_id' => 1,
            'nomor_kamar' => 23,
            'tipe_kamar' => 'Double',
            'kapasitas' => '2',
            'fasilitas' => 'Bintang 5',
        ]);
        for ($i = 1; $i <= 22; $i++) {
            Kamar::create([
                'paket_hotel_id' => 2,
                'nomor_kamar' => $i,
                'tipe_kamar' => 'Quad',
                'kapasitas' => '4',
                'fasilitas' => 'Bintang 5',
            ]);
        }
        Kamar::create([
            'paket_hotel_id' => 2,
            'nomor_kamar' => 23,
            'tipe_kamar' => 'Double',
            'kapasitas' => '2',
            'fasilitas' => 'Bintang 5',
        ]);
    }
}
