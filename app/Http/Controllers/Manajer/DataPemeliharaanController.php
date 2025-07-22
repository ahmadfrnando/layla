<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemeliharaanRequest;
use App\Models\Pemeliharaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataPemeliharaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            $data = Pemeliharaan::select('*')->orderBy('created_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('karyawan', function ($row) {
                    return $row->karyawan->nama ?? '-';
                })
                ->addColumn('deskripsi', function ($row) {
                    return $row->deskripsi ? '<span style="white-space: normal !important;">' . $row->deskripsi . '</span>' : '-';
                })
                ->rawColumns(['karyawan', 'deskripsi'])
                ->filterColumn('karyawan', function ($query, $value) {
                    $query->whereHas('karyawan', function ($q) use ($value) {
                        $q->where('nama', 'LIKE', '%' . $value . '%');
                    });
                })
                ->filterColumn('deskripsi', function ($query, $value) {
                    $query->where('deskripsi', 'LIKE', '%' . $value . '%');
                })
                ->make(true);
        }
        return view('pages.manajer.pemeliharaan.index');
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
    public function store(PemeliharaanRequest $request)
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
    public function update(PemeliharaanRequest $request, string $id)
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
