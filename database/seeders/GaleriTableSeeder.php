<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GaleriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $galeries = [
        //     [
        //         'paket_id' => 1,
        //         'nama' => 'Dokumentasi',
        //         'deskripsi' => 'Umroh 2014',
        //         'file_path' => 'paket-galeri/galeri-1.jpg',
        //         'jenis' => 'gambar',
        //     ],
        // ];
        // foreach ($galeries as $galeri) {
        //     Galeri::create($galeri);
        // }
        for ($i = 1; $i <= 10; $i++) {
            Galeri::create([
                'paket_id' => 1,
                'nama' => 'Dokumentasi',
                'deskripsi' => 'Umroh 2018',
                'file_path' => "paket-galeri/galeri-$i.jpg",
                'jenis' => 'gambar',
            ]);
        }
    }
}
