<?php

namespace App\Http\Controllers\Petugas;

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
    protected $karyawan_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->karyawan_id = Karyawan::where('user_id', auth()->id())->first()->id;

            return $next($request);
        });
    }
    public function index()
    {
        $jumlahHasilPanen = HasilPanen::where('karyawan_id', $this->karyawan_id)->sum('jumlah_kg');
        $jumlahPemupukan = Pemupukan::where('karyawan_id', $this->karyawan_id)->sum('jumlah_kg');
        $jumlahPemeliharaan = Pemeliharaan::where('karyawan_id', $this->karyawan_id)->count();
        $jumlahJadwalTugas = Karyawan::count();
        return view('pages.petugas.dashboard', compact(
            'jumlahHasilPanen',
            'jumlahPemupukan',
            'jumlahPemeliharaan',
            'jumlahJadwalTugas',
        ));
    }
}
