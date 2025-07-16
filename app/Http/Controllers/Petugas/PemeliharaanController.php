<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemeliharaanRequest;
use App\Models\Karyawan;
use App\Models\Pemeliharaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PemeliharaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pemeliharaan::select('*')->orderBy('created_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('petugas.pemeliharaan.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    return $btn;
                })
                ->addColumn('deskripsi', function ($row) {
                    return '<span style="white-space: normal !important;">' . $row->deskripsi . '</span>';
                })
                ->rawColumns(['action', 'deskripsi'])
                ->filterColumn('deskripsi', function ($query, $value) {
                    $query->where('deskripsi', 'LIKE', '%' . $value . '%');
                })
                ->make(true);
        }
        return view('pages.petugas.pemeliharaan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.petugas.pemeliharaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemeliharaanRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $pemeliharaan = Pemeliharaan::create($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $pemeliharaan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
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
        $pemeliharaan = Pemeliharaan::findOrFail($id);
        return view('pages.petugas.pemeliharaan.edit', compact('pemeliharaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemeliharaanRequest $request, string $id)
    {
        $validatedData = $request->validated();
        try {
            $pemeliharaan = Pemeliharaan::findOrFail($id);
            $pemeliharaan->update($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $pemeliharaan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
