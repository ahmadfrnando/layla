<?php

namespace Database\Seeders;

use App\Models\HasilPanen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HasilPanenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HasilPanen::factory()->count(20)->create();
    }
}
