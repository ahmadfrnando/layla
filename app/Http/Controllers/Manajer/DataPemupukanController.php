<?php

namespace App\Http\Controllers\Manajer;

use App\Charts\GrafikPemupukanBulanan;
use App\Http\Controllers\Controller;
use App\Http\Requests\PemupukanRequest;
use App\Models\Pemupukan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataPemupukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request, GrafikPemupukanBulanan $chart)
    {
        if ($request->ajax()) {
            $data = Pemupukan::select('*')->orderBy('created_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('karyawan', function ($row) {
                    return $row->karyawan->nama ?? '-';
                })
                ->addColumn('catatan', function ($row) {
                    return $row->catatan ? '<span style="white-space: normal !important;">' . $row->catatan . '</span>' : '-';
                })
                ->rawColumns(['karyawan', 'catatan'])
                ->filterColumn('karyawan', function ($query, $value) {
                    $query->whereHas('karyawan', function ($q) use ($value) {
                        $q->where('nama', 'LIKE', '%' . $value . '%');
                    });
                })
                ->filterColumn('catatan', function ($query, $value) {
                    $query->where('catatan', 'LIKE', '%' . $value . '%');
                })
                ->make(true);
        }
        return view('pages.manajer.pemupukan.index', ['chart' => $chart->build()]);
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
    public function store(PemupukanRequest $request)
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
    public function update(PemupukanRequest $request, string $id)
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
