<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemupukan>
 */
class PemupukanFactory extends Factory
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
            'jumlah' => $this->faker->numberBetween(1, 100),
            'jenis_pupuk' => $this->faker->randomElement(['Urea', 'NPK', 'Organik', 'KCL']),
            'pekerja_id' => \App\Models\Pekerja::factory()->create()->id,
            'created_at' => now(),
            'updated_at' => now(),
            'keterangan' => $this->faker->sentence(6, true),
        ];
    }
}
