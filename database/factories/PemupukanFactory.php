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
    protected $model = \App\Models\Pemupukan::class;
    public function definition(): array

    {
        return [
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'jumlah_kg' => $this->faker->numberBetween(100, 1000),
            'jenis_pupuk' => $this->faker->randomElement(['Urea', 'NPK', 'Organik', 'KCL']),
            'karyawan_id' => \App\Models\Karyawan::factory()->create()->id,
            'created_at' => now(),
            'updated_at' => now(),
            'catatan' => $this->faker->sentence(6, true),
        ];
    }
}
