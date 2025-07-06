<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalTugasRequest;
use App\Models\JadwalTugas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JadwalTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JadwalTugas::select('*')->orderBy('created_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('admin.jadwal-tugas.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    switch ($row->status) {
                        case 'proses':
                            $status = ' <button type="button" data-id=' . $row->id . ' class="badge bg-gradient-primary" data-status="selesai" id="btn-status">Proses</button>';
                            break;
                        case 'selesai':
                            $status = ' <span class="badge bg-gradient-success">Selesai</span>';
                            break;
                    }
                    return $status;
                })
                ->addColumn('karyawan', function ($row) {
                    return $row->karyawan->nama ?? '-';
                })
                ->addColumn('deskripsi_tugas', function ($row) {
                    return '<span style="white-space: normal !important;">' . $row->deskripsi_tugas . '</span>';
                })
                ->rawColumns(['action', 'karyawan', 'deskripsi_tugas', 'status'])
                ->filterColumn('karyawan', function ($query, $value) {
                    $query->whereHas('karyawan', function ($q) use ($value) {
                        $q->where('nama', 'LIKE', '%' . $value . '%');
                    });
                })
                ->filterColumn('deskripsi_tugas', function ($query, $value) {
                    $query->where('deskripsi_tugas', 'LIKE', '%' . $value . '%');
                })
                ->make(true);
        }
        return view('pages.admin.jadwal-tugas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.jadwal-tugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JadwalTugasRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $jadwalTugas = JadwalTugas::create($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $jadwalTugas
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
        $jadwalTugas = JadwalTugas::findOrFail($id);
        return view('pages.admin.jadwal-tugas.edit', compact('jadwalTugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JadwalTugasRequest $request, string $id)
    {
        $validatedData = $request->validated();
        try {
            $jadwalTugas = JadwalTugas::findOrFail($id);
            $jadwalTugas->update($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $jadwalTugas
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

    public function updateStatus($id, $status)
    {
        try {
            $jadwalTugas = JadwalTugas::findOrFail($id);
            $jadwalTugas->update(['status' => $status]);
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
}
