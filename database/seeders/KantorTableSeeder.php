<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use App\Models\Kantor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KantorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kabupaten::where('kabupaten', 'Kabupaten Karawang')->first();
        Kantor::create([
            'nama_kantor' => 'Kantor Pusat',
            'alamat_kantor' => 'Jl. RA. Kartini No.1, Karangpawitan, Kec. Karawang Barat, Karawang, Jawa Barat 41315',
            'kode_pos' => '41315',
            'kabupaten_id' => Kabupaten::where('kabupaten', 'Kabupaten Karawang')->first()->id,
            'kecamatan' => 'Karawang Barat',
            'jenis_kantor' => 'Pusat',
            'foto_kantor' => 'kantor-foto/kantor-haifa-pusat.jpeg',
        ]);
    }
}
