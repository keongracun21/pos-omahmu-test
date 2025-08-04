<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    protected $table = 'laporan_penjualan'; // ⬅️ beri nama tabel yang sesuai di database kamu

    protected $fillable = ['id_transaksi', 'tanggal', 'total', 'order_details'];

    protected $casts = [
        'order_details' => 'array',
    ];

    public $timestamps = false;
}
