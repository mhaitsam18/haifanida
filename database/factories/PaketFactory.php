<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\Maskapai;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paket>
 */
class PaketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hargaSingle = fake()->numerify('##000000');
        $hargaCouple = $hargaSingle + fake()->numerify('#000000');
        $hargaQuad = $hargaCouple + fake()->numerify('#000000');

        return [
            'hotel_madinah_id' => Hotel::factory(),
            'hotel_mekah_id' => Hotel::factory(),
            'maskapai_id' => Maskapai::factory(),
            'nama' => 'Paket '.fake()->numerify(),
            'jenis' => fake()->randomElement(['umrah', 'haji']),
            'harga_single' => $hargaSingle,
            'harga_couple' => $hargaCouple,
            'harga_quad' => $hargaQuad,
            'keberangkatan' => fake()->dateTimeBetween('+3 months', '+2 years'),
            'jumlah_hari' => fake()->randomElement([9, 11]),
            'stok' => fake()->randomNumber(2)
        ];
    }
}
