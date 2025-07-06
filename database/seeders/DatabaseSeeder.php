<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Pekerja::factory(20)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('123'),
            'role_id' => 1,
        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'manajer',
            'username' => 'manajer',
            'password' => bcrypt('123'),
            'role_id' => 3,
        ]);
    }
}
