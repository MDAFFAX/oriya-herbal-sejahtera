<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurnalUmum extends Model
{
    protected $table = 'jurnal_umums';

    protected $fillable = [
        'tanggal',
        'nama_akun',
        'ref',
        'debet',
        'kredit',
        'transaksi_penjualan_id',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'debet' => 'decimal:2',
        'kredit' => 'decimal:2',
    ];

    public function transaksiPenjualan()
    {
        return $this->belongsTo(TransaksiPenjualan::class);
    }
}
