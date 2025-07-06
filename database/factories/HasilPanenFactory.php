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
            'jumlah_kg' => $this->faker->numberBetween(1, 100),
            'karyawan_id' => $this->faker->numberBetween(1, 3),
            'catatan' => $this->faker->sentence(6, true),
        ];
    }
}
