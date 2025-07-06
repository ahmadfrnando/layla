<?php

namespace Database\Seeders;

use App\Models\Pemupukan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemupukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pemupukan::factory()->count(20)->create();
    }
}
