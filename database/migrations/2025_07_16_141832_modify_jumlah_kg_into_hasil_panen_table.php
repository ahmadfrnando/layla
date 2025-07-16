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
            $table->decimal('jumlah_kg', 6,2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_panen', function (Blueprint $table) {
            $table->decimal('jumlah_kg', 5,2)->change();
        });
    }
};
