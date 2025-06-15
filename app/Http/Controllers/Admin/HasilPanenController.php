<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengangkutanHasilPanen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class HasilPanenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PengangkutanHasilPanen::with('afdeling')
                ->whereNotNull('muatan_pabrik')
                ->whereNotNull('tandan_pabrik')
                ->orderBy('tanggal', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('afdeling', function ($row) {
                    return $row->afdeling->name ?? '-';
                })
                ->addColumn('kode_pengangkutan', function ($row) {
                    return $row->pengangkutan->kode_pengangkutan ?? '-';
                })
                ->addColumn('blok', function ($row) {
                    return $row->pengangkutan->blok ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('admin.hasil-panen.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    $btn .= ' <form action="' . route('admin.hasil-panen.destroy', $row->id) . '" method="POST" style="display:inline-block;">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<button type="submit" class="btn btn-sm btn-danger">Hapus</button>';
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['afdeling', 'action', 'kode_pengangkutan', 'blok'])
                ->filterColumn('afdeling', function ($query, $value) {
                    $query->whereHas('afdeling', function ($q) use ($value) {
                        $q->where('name', 'LIKE', '%' . $value . '%');
                    });
                })
                ->filterColumn('kode_pengangkutan', function ($query, $value) {
                    $query->whereHas('pengangkutan', function ($q) use ($value) {
                        $q->where('kode_pengangkutan', 'LIKE', '%' . $value . '%');
                    });
                })
                ->make(true);
        }
        return view('pages.admin.hasil-panen.index');
    }

    public function create()
    {
        return view('pages.admin.hasil-panen.create');
    }
}
