<?php

namespace App\Http\Controllers\Manajer;

use App\Charts\GrafikHasilPanenBulanan;
use App\Http\Controllers\Controller;
use App\Http\Requests\HasilPanenRequest;
use App\Models\HasilPanen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataHasilPanenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request, GrafikHasilPanenBulanan $chart)
    {
        if ($request->ajax()) {
            $data = HasilPanen::select('*')->orderBy('created_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('karyawan', function ($row) {
                    return $row->karyawan->nama ?? '-';
                })
                ->addColumn('catatan', function ($row) {
                    return '<span style="white-space: normal !important;">' . $row->catatan . '</span>';
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
        return view('pages.manajer.hasil-panen.index', ['chart' => $chart->build()]);
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
    public function store(HasilPanenRequest $request)
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
    public function update(HasilPanenRequest $request, string $id)
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
