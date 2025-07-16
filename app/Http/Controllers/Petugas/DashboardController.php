<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Afdeling;
use App\Models\HasilPanen;
use App\Models\JadwalTugas;
use App\Models\Karyawan;
use App\Models\Pemeliharaan;
use App\Models\Pemupukan;
use App\Models\PengangkutanHasilPanen;
use App\Models\Supir;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahHasilPanen = HasilPanen::sum('jumlah_kg');
        $jumlahPemupukan = Pemupukan::sum('jumlah_kg');
        $jumlahPemeliharaan = Pemeliharaan::count();
        $jumlahJadwalTugas = JadwalTugas::count();
        return view('pages.petugas.dashboard', compact(
            'jumlahHasilPanen',
            'jumlahPemupukan',
            'jumlahPemeliharaan',
            'jumlahJadwalTugas',
        ));
    }
}
