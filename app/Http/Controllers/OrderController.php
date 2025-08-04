<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\LaporanPenjualan;
use App\Models\StokMenu;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function submit(Request $request)
    {
        try {
            DB::beginTransaction();

            // Ambil data order dari session atau request
            $orderData = $request->input('order_items', []);
            
            // Validasi dan update stok untuk setiap item
            foreach ($orderData as $item) {
                $menu = StokMenu::where('nama_menu', $item['nama'])->first();
                
                if (!$menu) {
                    throw new \Exception("Menu '{$item['nama']}' tidak ditemukan");
                }
                
                if ($menu->kuantitas < $item['qty']) {
                    throw new \Exception("Stok menu '{$item['nama']}' tidak mencukupi. Tersedia: {$menu->kuantitas}, Dibutuhkan: {$item['qty']}");
                }
                
                // Kurangi stok
                $menu->kuantitas -= $item['qty'];
                $menu->save();
            }

            // Catat laporan penjualan
            LaporanPenjualan::create([
                'id_transaksi' => $request->id_transaksi,
                'tanggal' => now(),
                'total' => $request->total,
                'order_details' => json_encode($orderData), // Simpan detail order
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil! Stok telah diperbarui.'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
