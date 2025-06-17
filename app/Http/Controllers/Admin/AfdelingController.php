<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AfdelingRequest;
use App\Models\Afdeling;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class AfdelingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Afdeling::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('admin.afdeling.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" id="delete" class="ms-2 btn btn-sm btn-danger">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.afdeling.index');
    }

    public function create()
    {
        return view('pages.admin.afdeling.create');
    }

    public function store(AfdelingRequest $request)
    {
        try {
            $data = $request->validated();
            Afdeling::create($data);
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
        $afdeling = Afdeling::findOrFail($id);
        return view('pages.admin.afdeling.edit', compact('afdeling'));
    }

    public function update(AfdelingRequest $request, $id)
    {
        try {
            $afdeling = Afdeling::findOrFail($id);
            $afdeling->update($request->validated());
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
            $afdeling = Afdeling::findOrFail($id);
            $afdeling->delete();
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
