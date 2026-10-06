<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SuperAdminAuthController extends Controller
{
    public function create()
    {
        if (Auth::check()) {
            // Izinkan super_admin atau staff untuk masuk ke dashboard jika sudah login
            if (in_array(Auth::user()->role, ['super_admin', 'staff'])) {
                return redirect()->route('superadmin.dashboard');
            }
        }

        return view('auth.login-admin');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.'
            ]);
        }

        $request->session()->regenerate();
        $user = Auth::user();

        // IZINKAN LOGIN JIKA ROLE ADALAH 'super_admin' ATAU 'staff' DAN AKUN AKTIF
        if (!in_array($user->role, ['super_admin', 'staff']) || !$user->is_active) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Akun tidak memiliki hak akses ke panel ini.'
            ]);
        }

        return redirect()->route('superadmin.dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login');
    }
}