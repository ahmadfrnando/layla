<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PengaturanPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Karyawan::with(['user', 'user.role'])
                ->select('karyawan.*')
                ->join('users', 'karyawan.user_id', '=', 'users.id')
                ->whereNotNull('users.username');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('admin.pengaturan-pengguna.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" id="delete" class="ms-2 btn btn-sm btn-danger">Hapus</button>';

                    return $btn;
                })
                ->addColumn('role', function ($row) {
                    return $row->role ? $row->role->role : '-';
                })
                ->addColumn('username', function ($row) {
                    return $row->user ? $row->user->username : '-';
                })
                ->rawColumns(['action', 'karyawan', 'role', 'username'])
                // ->filterColumn('karyawan', function ($query, $value) {
                //     $query->whereHas('karyawan', function ($q) use ($value) {
                //         $q->where('nama', 'LIKE', '%' . $value . '%');
                //     })->get();
                // })
                ->make(true);
        }
        return view('pages.admin.pengaturan-pengguna.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.pengaturan-pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $karyawan = Karyawan::where('id', $request->karyawan_id)->first();
        try {
            $user = User::updateOrCreate(
                [
                    'name' => $karyawan->nama,
                    'username' => $validated['username'],
                    'password' => bcrypt($validated['password']),
                    'role_id' => 2,
                ]
            );
            $karyawanData = $karyawan->update(['user_id' => $user->id]);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $karyawanData
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        if ($karyawan->user) {
            $karyawan->user->delete();
        }
        try {
            $karyawan->update(['user_id' => null]);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ], 500);
        }
    }
}
