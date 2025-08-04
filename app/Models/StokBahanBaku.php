<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBahanBaku extends Model
{
    protected $table = 'stok_bahan_baku';
    protected $primaryKey = 'id_bahan';
    
    protected $fillable = [
        'nama_bahan',
        'kuantitas',
        'satuan',
        'keterangan',
        'harga_total'
    ];
} 
