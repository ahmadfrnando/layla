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
            'tanggal_tugas' => $this->faker->dateTimeBetween('first day of this month', 'now')->format('Y-m-d'),
            'karyawan_id' => \App\Models\Karyawan::inRandomOrder()->value('id'),
            'created_at' => now(),
            'updated_at' => now(),
            'deskripsi_tugas' => $this->faker->randomElement($deskripsiTugas),
            'status' => $this->faker->randomElement(['proses', 'selesai']),
        ];
    }
}
