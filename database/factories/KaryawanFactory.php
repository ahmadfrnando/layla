<?php

namespace Database\Factories;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    protected $model = Karyawan::class;


    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'jabatan' => $this->faker->randomElement(['Mandor', 'Admin', 'Petugas']),
            'tanggal_lahir' => $this->faker->date(),
            'alamat' => $this->faker->address,
            'no_telp' => $this->faker->phoneNumber,
        ];
    }
}
