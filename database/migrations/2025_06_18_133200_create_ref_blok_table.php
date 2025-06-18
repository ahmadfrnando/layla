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
        Schema::create('ref_blok', function (Blueprint $table) {
            $table->id();
            $table->string('blok');
            $table->timestamps();
        });

        DB::table('ref_blok')->insert([
            ['id' => 1, 'blok' => 'A'],
            ['id' => 2, 'blok' => 'B'],
            ['id' => 3, 'blok' => 'C'],
            ['id' => 4, 'blok' => 'D'],
            ['id' => 5, 'blok' => 'E'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_blok');
    }
};
