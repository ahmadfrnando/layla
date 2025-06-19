<?php

namespace App\Http\Controllers\Afdeling;

use App\Http\Controllers\Controller;
use App\Models\PengangkutanHasilPanen;
use App\Models\Supir;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {   
        $jumlahMuatan = PengangkutanHasilPanen::all();
        $supir = Supir::all();
        return view('pages.afdeling.dashboard', compact('jumlahMuatan', 'supir'));
    }
}
