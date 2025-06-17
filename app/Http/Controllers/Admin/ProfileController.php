<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('pages.admin.profile.index', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $user->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diubah!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
