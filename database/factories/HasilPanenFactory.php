<?php

namespace Database\Factories;

use App\Models\HasilPanen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HasilPanen>
 */
class HasilPanenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = HasilPanen::class;
    public function definition(): array
    {
        return [
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'karyawan_id' => \App\Models\Karyawan::factory()->create()->id,
            'toros_besar_kg' => $this->faker->numberBetween(1, 100),
            'toros_kecil_kg' => $this->faker->numberBetween(1, 100),
            'jumlah_kg' => function (array $attributes) {
                return $attributes['toros_besar_kg'] + $attributes['toros_kecil_kg'];
            },
            'blok' => $this->faker->randomElement(['B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8', 'B9', 'B10']),
            'catatan' => $this->faker->sentence(6, true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
