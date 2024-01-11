<?php

namespace Database\Seeders;

use App\Models\Grup;
use App\Models\IsuPerjalanan;
use App\Models\Jadwal;
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

        $isu_perjalanans = [
            [
                'grup_id' => 1,
                'masalah' => 'Uji Test Fitur :)',
                'solusi' => 'Stay Safe Semuaa ^_^',
                'waktu_pelaporan' => now(),
                'waktu_penyelesaian' => now(),
                'status' => 1
            ],
            [
                'grup_id' => 2,
                'masalah' => 'Tidak Ada Masalah :)',
                'solusi' => 'Stay Safe Semuaa ^_^',
                'waktu_pelaporan' => now(),
                'waktu_penyelesaian' => now(),
                'status' => 1
            ],
        ];
        foreach ($isu_perjalanans as $isu_perjalanan) {
            IsuPerjalanan::create($isu_perjalanan);
        }

        $jadwals = [
            [
                'grup_id' => 1,
                'nama_agenda' => 'Manasik Umroh',
                'lokasi' => 'Kantor Pusat PT. Haifa Nida Wisata Karawang',
                'waktu_mulai' => '2024-02-14 09:00:00',
                'waktu_selesai' => '2024-02-14 15:00:00',
                'keterangan' => 'Tidak Ada Keterangan',
            ],
            [
                'grup_id' => 2,
                'nama_agenda' => 'Manasik Umroh',
                'lokasi' => 'Kantor Pusat PT. Haifa Nida Wisata Karawang',
                'waktu_mulai' => '2024-02-14 09:00:00',
                'waktu_selesai' => '2024-02-14 15:00:00',
                'keterangan' => 'Tidak Ada Keterangan',
            ],
        ];
        foreach ($jadwals as $jadwal) {
            Jadwal::create($jadwal);
        }
    }
}
