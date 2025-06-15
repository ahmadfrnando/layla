<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemeliharaan>
 */
class PemeliharaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal_pemeliharaan' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'jenis_pemeliharaan' => $this->faker->randomElement(['penyiraman', 'pemangkasan', 'pembersihan']),
            'pekerja_id' => \App\Models\Pekerja::factory(),
            'keterangan' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
