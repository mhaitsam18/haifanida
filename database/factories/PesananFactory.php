<?php

namespace Database\Factories;

use App\Models\Paket;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pesanan>
 */
class PesananFactory extends Factory
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
            'paket_id' => Paket::factory(),
            'jumlah' => fake()->randomElement([1, 2, 3, 4]),
            'tanggal' => fake()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
