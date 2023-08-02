<?php

namespace Database\Factories;

use App\Models\KategoriCatatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\catatan>
 */
class CatatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kategori_catatan_id' => KategoriCatatan::factory(),
            'catatan' => fake()->paragraph(1),
        ];
    }
}
