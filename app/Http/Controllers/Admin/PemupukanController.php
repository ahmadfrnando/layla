<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemupukan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PemupukanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pemupukan::with('pekerja')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('pekerja', function ($row) {
                    return $row->pekerja->nama ?? '-';
                })
                ->rawColumns(['pekerja'])
                ->filterColumn("pekerja", function ($query, $value) {
                    $query->whereHas("pekerja", fn($q) => $q->where("nama", "LIKE", "%$value%"));
                })
                ->make(true);
        }
        return view('pages.admin.pemupukan.index');
    }
}
