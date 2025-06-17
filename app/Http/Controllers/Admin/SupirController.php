<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupirRequest;
use App\Models\Supir;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupirController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Supir::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('admin.supir.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" id="delete" class="ms-2 btn btn-sm btn-danger">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.supir.index');
    }

    public function create()
    {
        return view('pages.admin.supir.create');
    }

    public function store(SupirRequest $request)
    {
        try {
            $data = $request->validated();
            Supir::create($data);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $supir = Supir::findOrFail($id);
        return view('pages.admin.supir.edit', compact('supir'));
    }

    public function update(SupirRequest $request, $id)
    {
        try {
            $supir = Supir::findOrFail($id);
            $supir->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diubah!',
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
            $supir = Supir::findOrFail($id);
            $supir->delete();
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
