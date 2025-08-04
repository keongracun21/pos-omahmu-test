<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokMenu extends Model
{
    protected $table = 'stok_menu';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;

    protected $fillable = [
        'nama_menu',
        'harga',
        'kuantitas',
        'gambar_produk',
        'jenis_menu'
    ];
}
