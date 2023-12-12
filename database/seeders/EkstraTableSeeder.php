<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ekstra;

class EkstraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tambahkan data ke tabel ekstra menggunakan Eloquent
        Ekstra::create([
            'nama_ekstra' => 'Perlengkapan',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Koper',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Batik Kain',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Blazer Batik',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Kemeja Batik Pria',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Kemeja Batik Wanita',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Gamis Batik',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Rok Merah Maroon',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Kerudung Merah Maroon',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Celana Merah Maroon',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Perlengkapan Ihrom',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Kain Ihrom',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Sabuk Ihrom',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Tas Selempang',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Tas Ransel',
            'jenis_ekstra' => 'perlengkapan',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Pembuatan Paspor',
            'jenis_ekstra' => 'jasa',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Pesawat Class Business',
            'jenis_ekstra' => 'pesawat',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Pesawat Class Eksekutif',
            'jenis_ekstra' => 'pesawat',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Kamar View Kakbah',
            'jenis_ekstra' => 'permintaan kamar',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'Kamar View Masjid Nabawi',
            'jenis_ekstra' => 'permintaan kamar',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'tipe kamar quad gabung',
            'jenis_ekstra' => 'tipe kamar',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'tipe kamar quad keluarga',
            'jenis_ekstra' => 'tipe kamar',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'tipe kamar quad keluarga isi 3 dan 1 bed kosong',
            'jenis_ekstra' => 'tipe kamar',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'tipe kamar double gabung',
            'jenis_ekstra' => 'tipe kamar',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'tipe kamar double keluarga',
            'jenis_ekstra' => 'tipe kamar',
            'harga_default' => 1000000,
        ]);
        Ekstra::create([
            'nama_ekstra' => 'tipe kamar single',
            'jenis_ekstra' => 'tipe kamar',
            'harga_default' => 1000000,
        ]);
    }
}
