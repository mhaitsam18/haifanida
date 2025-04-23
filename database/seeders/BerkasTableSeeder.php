<?php

namespace Database\Seeders;

use App\Models\Berkas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BerkasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $berkas = [
            'KTP', 'KK', 'Surat Nikah', 'Paspor', 'Ijazah', 'Surat Keterangan'
        ];
        foreach ($berkas as $key => $value) {
            Berkas::create([
                'nama_berkas' => $value
            ]);
        }
    }
}
