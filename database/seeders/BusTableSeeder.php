<?php

namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buses = [
            [
                'paket_id' => 1,
                'nomor_rombongan' => '1',
                'nomor_polisi' => '5984 VJV',
                'merek' => 'SAPTCO',
                'kapasitas' => '45',
                'fasilitas' => '<ul>
                    <li>Ac</li>
                    <li>Toilet</li>
                    <li>Catering</li>
                </ul>',
            ],
            [
                'paket_id' => 1,
                'nomor_rombongan' => '2',
                'nomor_polisi' => '5985 VJV',
                'merek' => 'SAPTCO',
                'kapasitas' => '45',
                'fasilitas' => '<ul>
                    <li>Ac</li>
                    <li>Toilet</li>
                    <li>Catering</li>
                </ul>',
            ],
        ];
        foreach ($buses as $bus) {
            Bus::create($bus);
        }
    }
}
