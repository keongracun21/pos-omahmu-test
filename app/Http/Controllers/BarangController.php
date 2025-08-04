<?php

namespace App\Http\Controllers;

use App\Models\StokMenu;
use App\Models\StokBahanBaku;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $menus = StokMenu::all();

        $query = StokBahanBaku::query();
        // Filter tanggal jika ada
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_selesai);
        }
        $bahanBakus = $query->get();
        $totalHarga = $bahanBakus->sum('harga_total');

        $lowStockMenus = StokMenu::where('kuantitas', '<=', 10)->orderBy('kuantitas', 'asc')->get();
        return view('barang', compact('menus', 'bahanBakus', 'lowStockMenus', 'totalHarga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan' => 'required|string|max:255',
            'kuantitas' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'keterangan' => 'nullable|string|max:500',
            'harga_total' => 'required|integer|min:0',
        ]);

        StokBahanBaku::create([
            'nama_bahan' => $request->nama_bahan,
            'kuantitas' => $request->kuantitas,
            'satuan' => $request->satuan,
            'keterangan' => $request->keterangan,
            'harga_total' => $request->harga_total,
        ]);

        return redirect()->route('barang.index')->with('success', 'Bahan baku berhasil ditambahkan!');
    }

    public function restokBatch(Request $request)
    {
        $request->validate([
            'restok_items' => 'required|array',
            'restok_items.*.id' => 'required|exists:stok_menu,id_menu',
            'restok_items.*.kuantitas' => 'required|integer|min:1',
        ]);

        $updatedItems = [];
        
        foreach ($request->restok_items as $item) {
            $menu = StokMenu::find($item['id']);
            $oldStok = $menu->kuantitas;
            $jumlahRestok = $item['kuantitas'];
            $newStok = $oldStok + $jumlahRestok;
            
            $menu->kuantitas = $newStok;
            $menu->save();
            
            $updatedItems[] = [
                'nama' => $menu->nama_menu,
                'old_stok' => $oldStok,
                'new_stok' => $menu->kuantitas,
                'added_amount' => $jumlahRestok
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Restok batch berhasil dilakukan!',
            'updated_items' => $updatedItems
        ]);
    }
} 
