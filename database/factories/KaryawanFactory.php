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
        $namaKaryawan = [
            'Ento', 'Udin', 'Pardi', 'Suwel', 'Ruswono', 'Pendi', 'Pardi', 'Udin'
        ];
        return [
            'nama' => $this->faker->randomElement($namaKaryawan),
            'jabatan' => 'Karyawan',
            'tanggal_lahir' => $this->faker->date(),
            'alamat' => 'Medan',
            'no_telp' => $this->faker->phoneNumber,
        ];
    }
}
