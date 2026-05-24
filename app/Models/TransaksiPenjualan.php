<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    protected $table = 'transaksi_penjualans';

    protected $fillable = [
        'nomor_transaksi',
        'tanggal',
        'nama_pelanggan',
        'no_hp',
        'metode_pembayaran',
        'total_bayar',
        'user_id',
        'nama_toko',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'total_bayar' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function jurnalUmums()
    {
        return $this->hasMany(JurnalUmum::class);
    }
}
