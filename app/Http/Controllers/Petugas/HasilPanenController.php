<?php

namespace App\Http\Controllers\Petugas;

use App\Charts\GrafikHasilPanenBulanan;
use App\Http\Controllers\Controller;
use App\Http\Requests\HasilPanenRequest;
use App\Models\HasilPanen;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HasilPanenController extends Controller
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
            $data = HasilPanen::where('karyawan_id', $this->karyawan_id)->orderBy('created_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('petugas.hasil-panen.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    return $btn;
                })
                ->addColumn('catatan', function ($row) {
                    return '<span style="white-space: normal !important;">' . $row->catatan . '</span>';
                })
                ->rawColumns(['action', 'catatan'])
                ->filterColumn('catatan', function ($query, $value) {
                    $query->where('catatan', 'LIKE', '%' . $value . '%');
                })
                ->make(true);
        }
        return view('pages.petugas.hasil-panen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.petugas.hasil-panen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HasilPanenRequest $request)
    {
        $validatedData = $request->validated();
        if (!isset($validatedData['karyawan_id'])) {
            $validatedData['karyawan_id'] = $this->karyawan_id;
        }
        try {
            $hasilPanen = HasilPanen::create($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $hasilPanen
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
        $hasilPanen = HasilPanen::findOrFail($id);
        return view('pages.petugas.hasil-panen.edit', compact('hasilPanen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HasilPanenRequest $request, string $id)
    {
        $validatedData = $request->validated();
        if (!isset($validatedData['karyawan_id'])) {
            $validatedData['karyawan_id'] = $this->karyawan_id;
        }
        try {
            $hasilPanen = HasilPanen::findOrFail($id);
            $hasilPanen->update($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $hasilPanen
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
