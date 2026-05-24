<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BebanOperasional extends Model
{
    protected $table = 'beban_operasionals';

    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'nominal',
        'tanggal_pengeluaran',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'tanggal_pengeluaran' => 'date',
    ];

    public function coa()
    {
        return $this->belongsTo(COA::class, 'kode_akun', 'kode_akun');
    }
}
