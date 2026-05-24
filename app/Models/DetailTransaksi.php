<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksis';

    protected $fillable = [
        'transaksi_penjualan_id',
        'produk_id',
        'jumlah',
        'harga_satuan',
        'subtotal',
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function transaksiPenjualan()
    {
        return $this->belongsTo(TransaksiPenjualan::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
