<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Afdeling;
use App\Models\PengangkutanHasilPanen;
use App\Models\Supir;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {   
        $jumlahMuatanPabrik = PengangkutanHasilPanen::where('is_selesai', 1)->count();
        $jumlahMuatanPanen = PengangkutanHasilPanen::where(['muatan_pabrik' => null, 'muatan_pabrik' => null])->count();
        $jumlahAfdeling = Afdeling::count();
        $jumlahSupir = Supir::count();
        return view('pages.admin.dashboard', compact('jumlahMuatanPabrik', 'jumlahMuatanPanen', 'jumlahAfdeling', 'jumlahSupir'));
    }
}
