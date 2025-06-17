<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupirRequest;
use App\Models\Supir;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SupirController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Supir::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('admin.supir.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" id="delete" class="ms-2 btn btn-sm btn-danger">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.supir.index');
    }

    public function create()
    {
        return view('pages.admin.supir.create');
    }

    public function store(SupirRequest $request)
    {   
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $supir = Supir::create($data);

            $user = new User();
            $user->name = $data['nama'];
            $now = now();
            $user->username = str_replace(' ', '', $data['nama']) . $now->format('His');
            $user->password = bcrypt('password');
            $user->role_id = 3;
            $user->save();

            $supir->user_id = $user->id;
            $supir->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $supir = Supir::findOrFail($id);
        return view('pages.admin.supir.edit', compact('supir'));
    }

    public function update(SupirRequest $request, $id)
    {   
        DB::transaction();
        try {
            $supir = Supir::findOrFail($id);
            $supir->update($request->validated());

            $user = User::where('id', $supir->user_id)->first();
            $user->update([
                'name' => $request->nama
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diubah!',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {   
        DB::beginTransaction();
        try {
            $supir = Supir::findOrFail($id);
            $id_supir = $supir->user_id;
            $supir->delete();

            $user = User::where('id', $id_supir)->first();
            $user->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus!',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
