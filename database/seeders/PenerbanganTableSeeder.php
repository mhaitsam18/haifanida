<?php

namespace Database\Seeders;

use App\Models\PaketMaskapai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenerbanganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penerbangans = [
            [
                'paket_id' => 1,
                'maskapai_id' => 186,
                'nomor_penerbangan' => '1',
                'nomor_pnr' => '1',
                'kelas' => 'Ekonomi',
                'kuota' => '90',
                'keterangan_penerbangan' => '-',
                'total_harga' => 90 * 14000000,
                'bandara_asal' => 'CGK - Bandar Udara Internasional Soekarno-Hatta',
                'bandara_tujuan' => 'JED - King Abdul Aziz Internasional Airport',
                'waktu_keberangkatan' => '2024-02-24',
                'waktu_kedatangan' => '2024-02-25',
                'status_penerbangan' => 'On Schedule',
                'tipe_penerbangan' => 'Transit',
                'gate_penerbangan' => '4',
            ],
            [
                'paket_id' => 1,
                'maskapai_id' => 52,
                'nomor_penerbangan' => '2',
                'nomor_pnr' => '2',
                'kelas' => 'Ekonomi',
                'kuota' => '90',
                'keterangan_penerbangan' => '-',
                'total_harga' => 90 * 14000000,
                'bandara_asal' => 'MED - Prince Mohammad bin Abdul Aziz Internasional Airport',
                'bandara_tujuan' => 'CGK - Bandar Udara Internasional Soekarno-Hatta',
                'waktu_keberangkatan' => '2024-03-04',
                'waktu_kedatangan' => '2024-03-05',
                'status_penerbangan' => 'On Schedule',
                'tipe_penerbangan' => 'Transit',
                'gate_penerbangan' => '4',
            ],
        ];
        foreach ($penerbangans as $penerbangan) {
            PaketMaskapai::create($penerbangan);
        }
    }
}
