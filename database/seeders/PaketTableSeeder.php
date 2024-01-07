<?php

namespace Database\Seeders;

use App\Models\Paket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pakets = [
            [
                'kantor_id' => 1,
                'nama_paket' => 'Umroh 24.24',
                'destinasi' => 'Jakarta - Jeddah - Mekkah - Madinah - Jakarta',
                'jenis_paket' => 'umroh',
                'durasi' => '9',
                'harga' => '24000000',
                'fasilitas' => '<p>
                    <h6>Harga Termasuk</h6>
                    <ul>
                        <li>Tiket Pesawat</li>
                        <li>Visa</li>
                        <li>Makan 3x Sehari</li>
                        <li>Muthowif Berbahasa Indonesia</li>
                        <li>Tour & Ziarah</li>
                        <li>Hotel Berbintang 3</li>
                    </ul>
                    <h6>Harga Tidak Termasuk</h6>
                    <ul>
                        <li>Pembuatan Paspor</li>
                        <li>Vaksin Meningitis</li>
                        <li>Tour diluar Paket</li>
                        <li>Biaya Lounge, Handling dan Perlengkapan 1,5 juta</li>
                        <li>Laundry</li>
                    </ul>
                </p>',
                'deskripsi' => 'Promo Umroh 24 Februari 2024',
                'tempat_keberangkatan' => 'Jakarta',
                'tempat_kepulangan' => 'Jakarta',
                'tanggal_mulai' => '2024-02-24',
                'tanggal_selesai' => '2024-03-04',
                'gambar' => 'paket-gambar/umroh-24.jpg',
            ]
        ];

        foreach ($pakets as $paket) {
            Paket::create($paket);
        }
    }
}
