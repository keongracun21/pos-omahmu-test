<?php

namespace App\Http\Controllers;

use App\Models\StokMenu;

class DashboardController extends Controller
{
    public function index()
    {
        $menus = StokMenu::all(); // ambil semua data dari tabel stok_menu
        return view('dashboard', compact('menus'));
    }
}
