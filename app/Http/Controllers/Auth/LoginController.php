<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Pastikan model User di-import

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        // Cek apakah user ditemukan dan password plain text-nya cocok
        if ($user && $user->password === $credentials['password']) {
            
            // Pastikan akun aktif (jika kolom is_active ada)
            if (isset($user->is_active) && !$user->is_active) {
                return back()->withErrors([
                    'email' => 'Akun Anda belum aktif atau dinonaktifkan oleh admin.'
                ]);
            }

            // Login manual menggunakan instance user
            Auth::login($user);
            $request->session()->regenerate();

            if ($user->role === 'participant') {
                return redirect()->route('peserta.dashboard');
            }

            if ($user->role === 'staff') {
                return redirect('/');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}