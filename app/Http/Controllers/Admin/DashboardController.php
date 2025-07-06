<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Afdeling;
use App\Models\HasilPanen;
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
        $jumlahKaryawan = Karyawan::count();
        return view('pages.admin.dashboard', compact(
            'jumlahHasilPanen',
            'jumlahPemupukan',
            'jumlahPemeliharaan',
            'jumlahKaryawan'
        ));
    }
}
