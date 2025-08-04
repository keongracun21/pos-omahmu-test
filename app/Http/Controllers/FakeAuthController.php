<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FakeAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Tampilkan halaman login
    }

    public function login(Request $request)
    {
        // Cek jika username dan password benar (hardcoded)
        if ($request->username === 'admin' && $request->password === 'password') {
            session(['user' => $request->username]); // Simpan sesi
            return redirect()->route('dashboard'); // Arahkan ke dashboard
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        session()->forget('user'); // Hapus sesi
        return redirect()->route('login'); // Arahkan ke halaman login
    }
}
