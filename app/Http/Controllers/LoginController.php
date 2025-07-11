<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {   
        if (Auth::check()) {
            if (Auth::user()->role_id == 1) {
                return redirect('admin/dashboard');
            } elseif (Auth::user()->role_id == 2) {
                return redirect('petugas/dashboard');
            } elseif (Auth::user()->role_id == 3) {
                return redirect('manajer/dashboard');
            }
        }
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id == 1) {
                return redirect()->intended('admin/dashboard');
            } elseif (Auth::user()->role_id == 2) {
                return redirect()->intended('petugas/dashboard');
            } elseif (Auth::user()->role_id == 3) {
                return redirect()->intended('manajer/dashboard');
            }
        }
        return back()->withErrors([
            'username' => 'Username tidak terdaftar atau kata sandi salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
