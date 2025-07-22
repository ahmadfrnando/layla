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
        Schema::dropIfExists('karyawan');

        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->text('alamat');
            $table->date('tanggal_lahir');
            $table->string('no_telp');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });

        $data = [
            [
                'nama' => 'Ento',
                'jabatan' => 'Karyawan',
                'alamat' => 'Medan',
                'tanggal_lahir' => '1999-01-01',
                'no_telp' => '081234567890',
            ],
            [
                'nama' => 'Udin',
                'jabatan' => 'Karyawan',
                'alamat' => 'Medan',
                'tanggal_lahir' => '1999-01-01',
                'no_telp' => '081234567890',
            ],
            [
                'nama' => 'Pardi',
                'jabatan' => 'Karyawan',
                'alamat' => 'Medan',
                'tanggal_lahir' => '1999-01-01',
                'no_telp' => '081234567890',
            ],
            [
                'nama' => 'Suwel',
                'jabatan' => 'Karyawan',
                'alamat' => 'Medan',
                'tanggal_lahir' => '1999-01-01',
                'no_telp' => '081234567890',
            ],
            [
                'nama' => 'Ruswono',
                'jabatan' => 'Karyawan',
                'alamat' => 'Medan',
                'tanggal_lahir' => '1999-01-01',
                'no_telp' => '081234567890',
            ],
            [
                'nama' => 'Pendi',
                'jabatan' => 'Karyawan',
                'alamat' => 'Medan',
                'tanggal_lahir' => '1999-01-01',
                'no_telp' => '081234567890',
            ],
        ];

        DB::table('karyawan')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
