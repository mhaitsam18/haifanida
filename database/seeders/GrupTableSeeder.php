<?php

namespace Database\Seeders;

use App\Models\Grup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grups = [
            [
                'paket_id' => 1,
                'agen_id' => 1,
                'nama_grup' => 'ATET GROUP',
                'keterangan_grup' => 'Jemaahnya Asep Maulana',
                'status_grup' => '',
                'kuota_grup' => 50
            ],
            [
                'paket_id' => 1,
                'nama_grup' => 'HANEWA GROUP',
                'keterangan_grup' => 'Jemaahnya Pak Wahyu',
                'status_grup' => '',
                'kuota_grup' => 50
            ],
        ];
        foreach ($grups as $grup) {
            Grup::create($grup);
        }
    }
}
