<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required', // Ini menerima email dari form Anda
            'password' => 'required',
        ]);

        // Cari user berdasarkan email (sesuai form Anda)
        $user = DB::table('users')
            ->where('email', $request->username)
            ->first();

        // Verifikasi password
        if ($user && Hash::check($request->password, $user->password)) {
            // Login menggunakan Auth Laravel dengan primary key user_id
            $authUser = User::find($user->user_id);
            Auth::login($authUser);

            // Simpan data tambahan di session
            Session::put('user_id', $user->user_id);
            Session::put('name', $user->name);
            Session::put('role', $user->role ?? null);

            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
