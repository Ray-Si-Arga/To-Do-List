<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman/formulir login
     * 
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Memproses data login dari formulir.
     */
    public function login(Request $request)
    {
        // 1. Validasi Input: Pastikan email & password diisi
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        // 2. Coba Login
        //    Auth::attempt() akan otomatis mengecek data ke tabel 'users',
        //    meng-hash password, dan membandingkannya.
        if (Auth::attempt($credentials, $remember)) {

            // 3. JIKA BERHASIL:
            //    Regenerasi session (untuk keamanan)
            $request->session()->regenerate();

            // Arahkan user ke halaman 'dashboard'
            return redirect()->route('dashboard');
        }

        // 4. JIKA GAGAL:
        //    Kembalikan ke halaman login dengan pesan error.
        //    Pesan ini akan otomatis ditangkap oleh @error('email') di Blade
        throw ValidationException::withMessages([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    /**
     * Memproses logout user.
     */
    public function logout(Request $request)
    {
        // Logout user-nya
        Auth::logout();

        // Matikan session-nya
        $request->session()->invalidate();

        // Buat token CSRF baru
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login
        return redirect('/login') -> with('success', 'Anda Telah Logout');
    }
}
