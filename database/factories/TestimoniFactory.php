<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\testimoni>
 */
class TestimoniFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pelanggan_id' => Pelanggan::factory(),
            'pesanan_id' => Pesanan::factory(),
            'testimoni' => fake()->paragraph(),
            'rating' => fake()->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
