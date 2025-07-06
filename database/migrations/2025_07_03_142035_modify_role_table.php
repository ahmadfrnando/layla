<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('role');

        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->timestamps();
        });


        DB::table('role')->insert([
            ['id' => 1, 'role' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'role' => 'Petugas', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'role' => 'Mandor', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role');
    }
};
