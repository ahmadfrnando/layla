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
        });

        DB::table('role')->insert([
            ['id' => 1, 'role' => 'Admin'],
            ['id' => 2, 'role' => 'Petugas'],
            ['id' => 3, 'role' => 'Manajer'],
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
