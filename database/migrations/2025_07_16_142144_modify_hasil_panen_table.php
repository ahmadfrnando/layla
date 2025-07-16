<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hasil_panen', function (Blueprint $table) {
            $table->string('blok');
            $table->decimal('toros_besar_kg', 6, 2);
            $table->decimal('toros_kecil_kg', 6, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_panen', function (Blueprint $table) {
            $table->dropColumn('blok');
            $table->dropColumn('toros_besar_kg');
            $table->dropColumn('toros_kecil_kg');
        });
    }
};
