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
        Schema::dropIfExists('afdeling');
        Schema::dropIfExists('pemupukan');
        Schema::dropIfExists('pengangkutan_hasil_panen');
        Schema::dropIfExists('pengangkutan');
        Schema::dropIfExists('ref_blok');
        Schema::dropIfExists('supir');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
