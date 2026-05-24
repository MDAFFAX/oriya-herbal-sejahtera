<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'satuan',
        'harga_jual',
        'harga_beli',
    ];

    protected $casts = [
        'harga_jual' => 'decimal:2',
        'harga_beli' => 'decimal:2',
    ];
}
