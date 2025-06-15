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
        Schema::create('pengangkutan_hasil_panen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengangkutan_id');
            $table->date('tanggal');
            $table->decimal('muatan_afdeling', 5, 2)->nullable();
            $table->integer('tandan_afdeling')->nullable();
            $table->decimal('muatan_pabrik', 5, 2)->nullable();
            $table->integer('tandan_pabrik')->nullable();
            $table->decimal('muatan_hilang', 5, 2)->default(0);
            $table->integer('tandan_hilang')->default(0);
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengangkutan_hasil_panen');
    }
};
