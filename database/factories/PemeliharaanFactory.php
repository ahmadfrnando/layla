<?php

namespace Database\Factories;

use App\Models\Karyawan;
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
    protected $model = \App\Models\Pemeliharaan::class;

    public function definition(): array
    {
        return [
            'tanggal' => $this->faker->dateTimeBetween('first day of this month', date('Y-m-d')),
            'jenis_tindakan' => $this->faker->randomElement(['penyiraman', 'pemangkasan', 'pembersihan']),
            'karyawan_id' => Karyawan::pluck('id')->random(),
            'deskripsi' => $this->faker->sentence(15, true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
