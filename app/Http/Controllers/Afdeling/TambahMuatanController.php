<?php

namespace App\Http\Controllers\Afdeling;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengangkutanHasilPanenRequest;
use App\Models\PengangkutanHasilPanen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TambahMuatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PengangkutanHasilPanen::with('pengangkutan')->where('is_selesai', 0);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_pengangkutan', function ($row) {
                    return $row->pengangkutan->kode_pengangkutan ?? '-';
                })
                ->addColumn('blok', function ($row) {
                    return $row->pengangkutan->blok ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('afdeling.tambah-muatan.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" id="delete" class="ms-2 btn btn-sm btn-danger">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['kode_pengangkutan', 'blok', 'action'])
                ->filterColumn('blok', function ($query, $value) {
                    $query->whereHas('pengangkutan', function ($q) use ($value) {
                        $q->where('blok', 'LIKE', '%' . $value . '%');
                    });
                })
                ->filterColumn('kode_pengangkutan', function ($query, $value) {
                    $query->whereHas('pengangkutan', function ($q) use ($value) {
                        $q->where('kode_pengangkutan', 'LIKE', '%' . $value . '%');
                    });
                })
                ->make(true);
        }
        return view('pages.afdeling.tambah-muatan.index');
    }
    public function create(Request $request)
    {
        return view('pages.afdeling.tambah-muatan.create');
    }

    public function show($id)
    {
        //    
    }

    public function edit($id)
    {
        $pengangkutan = PengangkutanHasilPanen::findOrFail($id);
        return view('pages.afdeling.tambah-muatan.edit', compact('pengangkutan'));
    }

    public function store(PengangkutanHasilPanenRequest $request)
    {
        try {
            $pengangkutan = PengangkutanHasilPanen::create($request->validated());

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
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tandan_afdeling' => 'required|integer|min:1',
            'muatan_afdeling' => 'required|numeric|min:0.01'
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

    public function destroy($id)
    {
        try {
            $pengangkutan = PengangkutanHasilPanen::findOrFail($id);
            $pengangkutan->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
