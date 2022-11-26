<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  Mengarahkan ke halaman login
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
        ]);
    }

    // Method untuk authentikasi login
    public function authenticate(Request $request)
    {
        // Input login di validasi dulu
        $credentials = $request->validate([
            'username' => 'required|alpha_dash',
            'password' => 'required'
        ]);
        // Jika berhasil login
            if (Auth::attempt($credentials)) {
                // Menghindari session fixation
                // Hacking dengan menggunakan session yang sama
                $request->session()->regenerate();
                // Diarahkan ke halaman /home
                return redirect()->intended('/home');
            }
        // Jika gagal login maka akan dikembalikan ke halaman login dengan pesan gagal
        return back()->with('gagalLogin', 'Username atau Password salah!');
    }

    // Method logout
    public function logout() {
        // Menjalankan fungsi logout milik Auth laravel
        Auth::logout();
        // Menutup session
        request()->session()->invalidate();
        // Membuat session baru
        // Agar session lama tidak dapat digunakan untuk membajak website
        request()->session()->regenerateToken();
        // Mengambalikan user ke halaman login
        return redirect('/');
    }   
}
