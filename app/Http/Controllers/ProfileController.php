<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        $users = User::where('user_id', '!=', $user->user_id)->get(); // Mengambil semua user kecuali yang sedang login

        return view('pengaturan', [
            'user' => $user,
            'users' => $users
        ]);
    }

    public function update(Request $request)
    {
        // Validasi manual tanpa try-catch
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id() . ',user_id',
            'password' => 'nullable|min:8|confirmed'
        ]);

        // Update langsung ke database
        $updated = User::where('user_id', Auth::id())
            ->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password']
                    ? Hash::make($validated['password'])
                    : Auth::user()->password
            ]);

        if ($updated) {
            return redirect()->route('pengaturan')
                ->with('success', 'Profil berhasil diupdate');
        }

        return back()->with('error', 'Gagal mengupdate profil');
    }
}
