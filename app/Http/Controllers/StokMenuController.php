<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokMenu; // Pastikan sudah ada model StokMenu
use Illuminate\Support\Facades\Storage;

class StokMenuController extends Controller
{
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'gambar_produk' => 'required|image|mimes:jpg,png|max:2048',
            'jenis_menu' => 'required|string',
            'nama_menu' => 'required|string|max:255',
            'kuantitas' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:1000',
        ]);

        // Menyimpan gambar ke storage
        if ($request->hasFile('gambar_produk')) {
            $fileName = time() . '.' . $request->file('gambar_produk')->getClientOriginalExtension();
            $request->file('gambar_produk')->move(public_path('img'), $fileName);
            $imagePath = 'img/' . $fileName; // path relatif
        }

        // Menyimpan data ke tabel stok_menu
        StokMenu::create([
            'nama_menu' => $request->input('nama_menu'),
            'harga' => $request->input('harga'),
            'kuantitas' => $request->input('kuantitas'),
            'gambar_produk' => $imagePath ?? null,  // Menyimpan path gambar
            'jenis_menu' => $request->input('jenis_menu'),
        ]);

        // Redirect atau response setelah berhasil menyimpan
        return redirect()->route('dashboard')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function updateStok(Request $request, $id)
    {
        $request->validate([
            'kuantitas' => 'required|integer|min:1', // Minimal 1 untuk restok
            'keterangan' => 'nullable|string|max:500',
        ]);

        $menu = StokMenu::findOrFail($id);
        $oldStok = $menu->kuantitas;
        $jumlahRestok = $request->kuantitas; // Jumlah yang ditambahkan
        $newStok = $oldStok + $jumlahRestok; // Tambahkan ke stok yang ada
        
        $menu->kuantitas = $newStok;
        $menu->save();

        return response()->json([
            'success' => true,
            'message' => "Stok {$menu->nama_menu} berhasil ditambahkan! Penambahan: {$jumlahRestok} pcs, Total stok: {$newStok} pcs",
            'new_stok' => $menu->kuantitas,
            'added_amount' => $jumlahRestok
        ]);
    }

    public function getLowStock()
    {
        $lowStockMenus = StokMenu::where('kuantitas', '<=', 10)
            ->orderBy('kuantitas', 'asc')
            ->get();

        return response()->json($lowStockMenus);
    }

    public function destroy($id)
    {
        try {
            $menu = StokMenu::findOrFail($id);
            
            // Hapus gambar dari storage jika ada
            if ($menu->gambar_produk && Storage::disk('public')->exists($menu->gambar_produk)) {
                Storage::disk('public')->delete($menu->gambar_produk);
            }
            
            // Hapus data menu dari database
            $menu->delete();
            
            return response()->json([
                'success' => true,
                'message' => "Menu '{$menu->nama_menu}' berhasil dihapus!"
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus menu: ' . $e->getMessage()
            ], 500);
        }
    }
}
