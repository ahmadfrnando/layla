<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalTugasRequest;
use App\Models\JadwalTugas;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class JadwalTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $karyawan_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->karyawan_id = Karyawan::where('user_id', auth()->id())->first()->id;

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JadwalTugas::where('karyawan_id', $this->karyawan_id)->orderBy('created_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
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
                ->addColumn('deskripsi_tugas', function ($row) {
                    return '<span style="white-space: normal !important;">' . $row->deskripsi_tugas . '</span>';
                })
                ->rawColumns(['deskripsi_tugas', 'status'])
                ->filterColumn('deskripsi_tugas', function ($query, $value) {
                    $query->where('deskripsi_tugas', 'LIKE', '%' . $value . '%');
                })
                ->make(true);
        }
        return view('pages.petugas.jadwal-tugas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JadwalTugasRequest $request)
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
    public function update(JadwalTugasRequest $request, string $id)
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
