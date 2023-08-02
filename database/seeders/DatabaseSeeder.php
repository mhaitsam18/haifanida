<?php

namespace Database\Seeders;

use App\Models\Catatan;
use App\Models\Faq;
use App\Models\KategoriCatatan;
use App\Models\Kontak;
use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\Testimoni;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Paket::factory(5)
            ->create();

        User::factory(2)
            ->admin()
            ->create();

        Pelanggan::factory(10)
            ->has(Testimoni::factory(1))
            ->create();

        KategoriCatatan::factory()
            ->has(Catatan::factory(5))
            ->create([
                'nama'     => 'Boleh dibawa',
                'kategori' => 'boleh_dibawa'
            ]);

        KategoriCatatan::factory()
            ->has(Catatan::factory(5))
            ->create([
                'nama'     => 'Jangan dibawa',
                'kategori' => 'jangan_dibawa'
            ]);

        KategoriCatatan::factory()
            ->has(Catatan::factory(6))
            ->create([
                'nama'     => 'Syarat Daftar',
                'kategori' => 'syarat_daftar'
            ]);

        Faq::factory(4)
            ->create();

        Kontak::factory(4)
            ->create();

    }
}
