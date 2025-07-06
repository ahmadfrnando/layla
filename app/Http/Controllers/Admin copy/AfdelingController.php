<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AfdelingRequest;
use App\Models\Afdeling;
use App\Models\RefBlok;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\Datatables;

class AfdelingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Afdeling::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('admin.afdeling.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" id="delete" class="ms-2 btn btn-sm btn-danger">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.afdeling.index');
    }

    public function create()
    {   
        $blok = RefBlok::all();
        return view('pages.admin.afdeling.create', compact('blok'));
    }

    public function store(AfdelingRequest $request)
    {

        try {
            DB::beginTransaction();
            $data = $request->validated();
            $afdeling = Afdeling::create($data);

            $user = new User();
            $user->name = $data['nama'];
            $now = now();
            $user->username = str_replace(' ', '', $data['nama']) . $now->format('His');
            $user->password = bcrypt('password');
            $user->role_id = 2;
            $user->save();

            $afdeling->user_id = $user->id;
            $afdeling->save();

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
        $afdeling = Afdeling::findOrFail($id);
        return view('pages.admin.afdeling.edit', compact('afdeling'));
    }

    public function update(AfdelingRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $afdeling = Afdeling::findOrFail($id);
            $afdeling->update($request->validated());

            $user = User::where('id', $afdeling->user_id)->first();
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
            $afdeling = Afdeling::findOrFail($id);
            $id_afdeling = $afdeling->user_id;
            $afdeling->delete();

            $user = User::where('id', $id_afdeling)->first();
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
