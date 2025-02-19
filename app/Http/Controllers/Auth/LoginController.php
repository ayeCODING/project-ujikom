<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi user.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Coba login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika login berhasil
            return $this->redirectAfterLogin($request);
        }

        // Jika gagal login
        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    /**
     * Mengarahkan user setelah login berdasarkan role.
     */
    protected function redirectAfterLogin(Request $request)
    {
        if (Auth::user()->is_admin === 1) {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
        }

        return redirect('/')->with('success', 'Login berhasil!');
    }

    /**
     * Logout user dari sistem.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
