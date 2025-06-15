<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengangkutan>
 */
class PengangkutanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_pengangkutan' => $this->faker->unique()->numerify('PGK-#####'),
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => 1,
            'status' => $this->faker->randomElement(['persiapan', 'proses', 'selesai']),
            'kendaraan_pengangkutan' => $this->faker->randomElement(['truk', 'motor']),
            'nomor_polisi' => $this->faker->optional()->regexify('[A-Z]{1,2}-[0-9]{1,4}-[A-Z]{1,3}'),
            'keterangan' => $this->faker->optional()->sentence(),
            'nama_supir' => $this->faker->name(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
