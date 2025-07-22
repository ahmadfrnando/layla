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
        $deskripsiTugas = [
            'Pemangkasan daun kering',
            'Pemupukan rutin',
            'Penyulaman bibit',
            'Pengendalian hama',
            'Pengairan lahan',
            'Pengawasan pertumbuhan',
            'Pembersihan gulma',
            'Pemeliharaan alat',
            'Perbaikan drainase',
            'Pengukuran pH tanah',
            'Pengecekan kualitas tanah',
            'Penyemprotan pestisida',
            'Perawatan tanaman muda',
            'Pemantauan iklim',
            'Pengolahan tanah',
            'Pengaturan jarak tanam',
            'Pengendalian penyakit',
            'Pengecekan sistem irigasi',
            'Penyediaan nutrisi tambahan',
            'Pembersihan area pemeliharaan'
        ];
        return [
            'tanggal' => $this->faker->dateTimeBetween('first day of this month', date('Y-m-d')),
            'jenis_tindakan' => $this->faker->randomElement(['penyiraman', 'pemangkasan', 'pembersihan']),
            'karyawan_id' => Karyawan::pluck('id')->random(),
            'deskripsi' => $this->faker->randomElement($deskripsiTugas),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
