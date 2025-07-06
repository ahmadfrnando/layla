<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JadwalTugas>
 */
class JadwalTugasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\JadwalTugas::class;
    public function definition(): array
    {
        return [
            'tanggal_tugas' => $this->faker->dateTimeBetween('first day of this month', 'now')->format('Y-m-d'),
            'karyawan_id' => \App\Models\Karyawan::inRandomOrder()->value('id'),
            'created_at' => now(),
            'updated_at' => now(),
            'deskripsi_tugas' => $this->faker->sentence(15),
            'status' => $this->faker->randomElement(['proses', 'selesai']),
        ];
    }
}
