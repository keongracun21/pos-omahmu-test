<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPenjualan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\LaporanPenjualan::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $laporan = $query->orderBy('tanggal', 'desc')->get();
        $totalPenjualan = $laporan->sum('total');

        return view('laporan', compact('laporan', 'totalPenjualan'));
    }
}
