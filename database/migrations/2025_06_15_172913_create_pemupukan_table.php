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
        Schema::create('pemupukan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jenis_pupuk');
            $table->enum('status', ['persiapan', 'proses', 'selesai'])->default('persiapan');
            $table->unsignedBigInteger('user_id');
            $table->string('blok');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemupukan');
    }
};
