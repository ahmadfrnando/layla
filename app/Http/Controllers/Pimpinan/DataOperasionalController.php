<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\PengangkutanHasilPanen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataOperasionalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PengangkutanHasilPanen::with('afdeling')->with('pengangkutan')->where('is_selesai', 1);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('afdeling', function ($row) {
                    return $row->afdeling->name ?? '-';
                })
                ->addColumn('kode_pengangkutan', function ($row) {
                    return $row->pengangkutan->kode_pengangkutan ?? '-';
                })
                ->addColumn('blok', function ($row) {
                    return $row->pengangkutan->blok ?? '-';
                })
                ->addColumn('supir', function ($row) {
                    return $row->pengangkutan->nama_supir ?? '-';
                })
                ->rawColumns(['supir', 'afdeling', 'kode_pengangkutan', 'blok'])
                ->filterColumn('afdeling', function ($query, $value) {
                    $query->whereHas('afdeling', function ($q) use ($value) {
                        $q->where('nama', 'LIKE', '%' . $value . '%');
                    });
                })
                ->filterColumn('supir', function ($query, $value) {
                    $query->whereHas('pengangkutan', function ($q) use ($value) {
                        $q->where('nama_supir', 'LIKE', '%' . $value . '%');
                    });
                })
                ->filterColumn('kode_pengangkutan', function ($query, $value) {
                    $query->whereHas('pengangkutan', function ($q) use ($value) {
                        $q->where('kode_pengangkutan', 'LIKE', '%' . $value . '%');
                    });
                })
                ->make(true);
        }
        return view('pages.pimpinan.data-operasional.index');
    }

    public function cetak(Request $request)
    {
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            ]);

            $models = PengangkutanHasilPanen::with('afdeling', 'pengangkutan')->where('is_selesai', 1)->whereBetween('tanggal', [$validatedData['tanggal_mulai'], $validatedData['tanggal_selesai']])->get();

            $data = [
                'models' => $models,
                'tanggal_mulai' => $validatedData['tanggal_mulai'],
                'tanggal_selesai' => $validatedData['tanggal_selesai'],
            ];

            return view('pages.pimpinan.data-operasional.cetak', compact('data'));
        }

        return view('pages.pimpinan.data-operasional.form-cetak');
    }
}
