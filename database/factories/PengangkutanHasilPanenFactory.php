<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PengangkutanHasilPanenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => 1,
            'pengangkutan_id' => $this->faker->numberBetween(6, 10),
            'muatan_afdeling' => $this->faker->numberBetween(1, 1000),
            'tandan_afdeling' => $this->faker->numberBetween(1, 1000),
            // 'muatan_pabrik' => $this->faker->numberBetween(1, 1000),
            // 'tandan_pabrik' => $this->faker->numberBetween(1, 1000),
            'keterangan' => $this->faker->optional()->sentence(),
        ];
    }
}
