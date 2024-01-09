<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(ProvinsiTableSeeder::class);
        $this->call(KabupatenTableSeeder::class);
        $this->call(KantorTableSeeder::class);
        $this->call(EkstraTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(KontenTableSeeder::class);
        $this->call(BerkasTableSeeder::class);
        $this->call(HotelTableSeeder::class);
        $this->call(MaskapaiTableSeeder::class);
        $this->call(PaketTableSeeder::class);


        //Data Detail Paket
        $this->call(PenginapanTableSeeder::class);
        $this->call(PenerbanganTableSeeder::class);
        $this->call(BusTableSeeder::class);
        $this->call(GaleriTableSeeder::class);


        //Data Transaksi
        $this->call(GrupTableSeeder::class);
        $this->call(PemesananTableSeeder::class);

        $this->call(JemaahTableSeeder::class);
    }
}
