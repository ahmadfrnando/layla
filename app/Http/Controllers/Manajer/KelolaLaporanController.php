<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\HasilPanen;
use App\Models\Pemeliharaan;
use App\Models\Pemupukan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;


class KelolaLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'jenis_laporan' => 'required|in:hasil_panen,pemupukan,pemeliharaan',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            ]);
            $models = [];
            $loadView = '';
            if ($validatedData['jenis_laporan'] === 'hasil_panen') {
                $models = HasilPanen::with('karyawan')->whereBetween('tanggal', [$validatedData['tanggal_mulai'], $validatedData['tanggal_selesai']])->get();
                $loadView = 'pages.manajer.laporan.cetak-hp';
            } elseif ($validatedData['jenis_laporan'] === 'pemupukan') {
                $models = Pemupukan::with('karyawan')->whereBetween('tanggal', [$validatedData['tanggal_mulai'], $validatedData['tanggal_selesai']])->get();
                $loadView = 'pages.manajer.laporan.cetak-pp';
            } elseif ($validatedData['jenis_laporan'] === 'pemeliharaan') {
                $models = Pemeliharaan::with('karyawan')->whereBetween('tanggal', [$validatedData['tanggal_mulai'], $validatedData['tanggal_selesai']])->get();
                $loadView = 'pages.manajer.laporan.cetak-pm';
            } else {
                return redirect()->back()->withErrors(['jenis_laporan' => 'Jenis laporan tidak valid.']);
            }
            $data = [
                'models' => $models,
                'tanggal_mulai' => $validatedData['tanggal_mulai'],
                'tanggal_selesai' => $validatedData['tanggal_selesai'],
            ];
            // dd($loadView);

            $pdf = Pdf::loadView($loadView, $data)->setPaper('a4', 'landscape');
            return $pdf->download('laporan - ' . $validatedData['jenis_laporan'] . ' - '  .  $validatedData['tanggal_mulai'] . '-' . $validatedData['tanggal_selesai'] . '.pdf');
        }
        return view('pages.manajer.laporan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function cetak(Request $request, String $type)
    {
        //
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
