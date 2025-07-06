<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenggunaHakAksesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::whereNotIn('role_id', [1,4]);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.pengguna.edit', $row->id) . '" class="btn btn-sm btn-danger">Ubah Kata Sandi</a>';
                    return $btn;
                })
                ->addColumn('posisi', function ($row) {
                    return $row->role->role ?? '-';
                })
                ->addColumn('status', function ($row) {
                    if ($row->is_active == 1) {
                        return '<span class="badge badge-sm bg-gradient-success">Online</span>';
                    } else {
                        return '<span class="badge badge-sm bg-gradient-secondary">Offline</span>';
                    }
                })
                ->rawColumns(['action', 'posisi', 'status'])
                ->make(true);
        }
        return view('pages.admin.pengguna.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.admin.pengguna.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ]);

        try {
            $user = User::find($id);
            $user->password = bcrypt($request->password);
            $user->update();
            return response()->json([
                'success' => true,
                'message' => 'Kata Sandi berhasil diubah!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
