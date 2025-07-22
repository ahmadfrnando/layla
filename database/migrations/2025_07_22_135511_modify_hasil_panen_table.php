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
        Schema::dropIfExists('hasil_panen');

        Schema::create('hasil_panen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->date('tanggal');
            $table->decimal('jumlah_kg', 6, 2)->default(0);
            $table->text('catatan')->nullable();
            $table->string('blok')->nullable();
            $table->decimal('toros_besar_kg', 6 ,2)->default(0);
            $table->decimal('toros_kecil_kg', 6 ,2)->default(0);
            $table->timestamps();
        });

        $data = [
            [
                'karyawan_id' => 1,
                'blok' => '4',
                'tanggal' => '2025-06-02',
                'toros_besar_kg' => 105.00,
                'toros_kecil_kg' => 0.00,
                'jumlah_kg' => 105.00,
            ],
            [
                'karyawan_id' => 2,
                'blok' => '4',
                'tanggal' => '2025-06-02',
                'toros_besar_kg' => 143.00,
                'toros_kecil_kg' => 0.00,
                'jumlah_kg' => 143.00,
            ],
            [
                'karyawan_id' => 3,
                'blok' => '4',
                'tanggal' => '2025-06-02',
                'toros_besar_kg' => 38.00,
                'toros_kecil_kg' => 83.00,
                'jumlah_kg' => 121.00,
            ],
            [
                'karyawan_id' => 4,
                'blok' => '4',
                'tanggal' => '2025-06-02',
                'toros_besar_kg' => 31.00,
                'toros_kecil_kg' => 52.00,
                'jumlah_kg' => 83.00,
            ],
            [
                'karyawan_id' => 5,
                'blok' => '4',
                'tanggal' => '2025-06-02',
                'toros_besar_kg' => 108.00,
                'toros_kecil_kg' => 89.00,
                'jumlah_kg' => 197.00,
            ],
            [
                'karyawan_id' => 1,
                'blok' => '3',
                'tanggal' => '2025-06-03',
                'toros_besar_kg' => 90.00,
                'toros_kecil_kg' => 0.00,
                'jumlah_kg' => 90.00,
            ],
            [
                'karyawan_id' => 6,
                'blok' => '3',
                'tanggal' => '2025-06-03',
                'toros_besar_kg' => 97.00,
                'toros_kecil_kg' => 0.00,
                'jumlah_kg' => 97.00,
            ],
            [
                'karyawan_id' => 3,
                'blok' => '3',
                'tanggal' => '2025-06-03',
                'toros_besar_kg' => 33.00,
                'toros_kecil_kg' => 67.00,
                'jumlah_kg' => 100.00,
            ],
            [
                'karyawan_id' => 4,
                'blok' => '3',
                'tanggal' => '2025-06-03',
                'toros_besar_kg' => 43.00,
                'toros_kecil_kg' => 82.00,
                'jumlah_kg' => 125.00,
            ],
            [
                'karyawan_id' => 5,
                'blok' => '3',
                'tanggal' => '2025-06-03',
                'toros_besar_kg' => 14.00,
                'toros_kecil_kg' => 65.00,
                'jumlah_kg' => 79.00,
            ],
            [
                'karyawan_id' => 1,
                'blok' => '2',
                'tanggal' => '2025-06-04',
                'toros_besar_kg' => 105.00,
                'toros_kecil_kg' => 00.00,
                'jumlah_kg' => 105.00,
            ],
            [
                'karyawan_id' => 6,
                'blok' => '2',
                'tanggal' => '2025-06-04',
                'toros_besar_kg' => 80.00,
                'toros_kecil_kg' => 00.00,
                'jumlah_kg' => 80.00,
            ],
            [
                'karyawan_id' => 3,
                'blok' => '2',
                'tanggal' => '2025-06-04',
                'toros_besar_kg' => 47.00,
                'toros_kecil_kg' => 70.00,
                'jumlah_kg' => 117.00,
            ],
            [
                'karyawan_id' => 4,
                'blok' => '2',
                'tanggal' => '2025-06-04',
                'toros_besar_kg' => 108.00,
                'toros_kecil_kg' => 106.00,
                'jumlah_kg' => 214.00,
            ],
            [
                'karyawan_id' => 5,
                'blok' => '2',
                'tanggal' => '2025-06-04',
                'toros_besar_kg' => 53.00,
                'toros_kecil_kg' => 118.00,
                'jumlah_kg' => 171.00,
            ],
            [
                'karyawan_id' => 1,
                'blok' => '2',
                'tanggal' => '2025-06-05',
                'toros_besar_kg' => 68.00,
                'toros_kecil_kg' => 0.00,
                'jumlah_kg' => 68.00,
            ],
            [
                'karyawan_id' => 6,
                'blok' => '2',
                'tanggal' => '2025-06-05',
                'toros_besar_kg' => 50.00,
                'toros_kecil_kg' => 0.00,
                'jumlah_kg' => 50.00,
            ],
            [
                'karyawan_id' => 3,
                'blok' => '1',
                'tanggal' => '2025-06-05',
                'toros_besar_kg' => 62.00,
                'toros_kecil_kg' => 0.00,
                'jumlah_kg' => 62.00,
            ],
            [
                'karyawan_id' => 2,
                'blok' => '1',
                'tanggal' => '2025-06-05',
                'toros_besar_kg' => 60.00,
                'toros_kecil_kg' => 0.00,
                'jumlah_kg' => 60.00,
            ],
            [
                'karyawan_id' => 5,
                'blok' => '1',
                'tanggal' => '2025-06-05',
                'toros_besar_kg' => 46.00,
                'toros_kecil_kg' => 80.00,
                'jumlah_kg' => 126.00,
            ],
            
        ];

        DB::table('hasil_panen')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_panen');
    }
};
