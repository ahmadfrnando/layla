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
        Schema::table('pengangkutan_hasil_panen', function (Blueprint $table) {
            $table->boolean('is_selesai')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengangkutan_hasil_panen', function (Blueprint $table) {
            $table->dropColumn('is_selesai');
        });
    }
};
