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
        Schema::create('pengangkutan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengangkutan')->unique();
            $table->integer('user_id');
            $table->enum('status', ['persiapan', 'proses', 'selesai'])->default('persiapan');
            $table->string('nama_supir');
            $table->enum('kendaraan_pengangkutan', ['truk', 'motor'])->nullable();
            $table->string('nomor_polisi')->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tanggal');
            $table->string('blok')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengangkutan');
    }
};
