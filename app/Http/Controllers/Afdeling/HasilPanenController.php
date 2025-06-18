<?php

namespace App\Http\Controllers\Afdeling;

use App\Http\Controllers\Controller;
use App\Models\Afdeling;
use App\Models\Pengangkutan;
use App\Models\PengangkutanHasilPanen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HasilPanenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PengangkutanHasilPanen::whereHas('pengangkutan', function ($query) {
                $query->where('user_id', auth()->user()->id);
            });
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_pengangkutan', function ($row) {
                    return $row->pengangkutan->kode_pengangkutan ?? '-';
                })
                ->addColumn('blok', function ($row) {
                    return $row->pengangkutan->blok ?? '-';
                })
                ->rawColumns(['kode_pengangkutan', 'blok'])
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
        return view('pages.afdeling.hasil-panen.index');
    }
    public function create(Request $request)
    {
        // 
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // 
    }

    public function destroy($id)
    {
        // 
    }
}
