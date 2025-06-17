<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengangkutanHasilPanenRequest;
use App\Models\PengangkutanHasilPanen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\Datatables;

class HasilPanenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PengangkutanHasilPanen::with('afdeling');
            return Datatables::of($data)
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
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('admin.hasil-panen.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    $btn .= ' <form action="' . route('admin.hasil-panen.destroy', $row->id) . '" method="POST" style="display:inline-block;">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<button type="submit" class="btn btn-sm btn-danger">Hapus</button>';
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['afdeling', 'action', 'kode_pengangkutan', 'blok'])
                ->filterColumn('afdeling', function ($query, $value) {
                    $query->whereHas('afdeling', function ($q) use ($value) {
                        $q->where('name', 'LIKE', '%' . $value . '%');
                    });
                })
                ->filterColumn('kode_pengangkutan', function ($query, $value) {
                    $query->whereHas('pengangkutan', function ($q) use ($value) {
                        $q->where('kode_pengangkutan', 'LIKE', '%' . $value . '%');
                    });
                })
                ->make(true);
        }
        return view('pages.admin.hasil-panen.index');
    }
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $data = PengangkutanHasilPanen::with('afdeling')
                ->whereNull('muatan_pabrik')
                ->whereNull('tandan_pabrik');
            return Datatables::of($data)
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
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('admin.hasil-panen.show', $row->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Masukkan Hasil Panen</a>';
                    return $btn;
                })
                ->rawColumns(['afdeling', 'action', 'kode_pengangkutan', 'blok'])
                ->filterColumn('afdeling', function ($query, $value) {
                    $query->whereHas('afdeling', function ($q) use ($value) {
                        $q->where('name', 'LIKE', '%' . $value . '%');
                    });
                })
                ->filterColumn('kode_pengangkutan', function ($query, $value) {
                    $query->whereHas('pengangkutan', function ($q) use ($value) {
                        $q->where('kode_pengangkutan', 'LIKE', '%' . $value . '%');
                    });
                })
                ->make(true);
        }
        return view('pages.admin.hasil-panen.index');
    }

    public function show($id)
    {
        $pengangkutan = PengangkutanHasilPanen::findOrFail($id);
        return view('pages.admin.hasil-panen.show', compact('pengangkutan'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tandan_pabrik' => 'required|integer|min:1',
            'muatan_pabrik' => 'required|numeric|min:0.01'
        ]);

        try {
            $pengangkutan = PengangkutanHasilPanen::findOrFail($id);
            $pengangkutan->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $pengangkutan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
