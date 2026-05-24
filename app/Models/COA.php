<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class COA extends Model
{
    protected $table = 'coas';

    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'header_akun',
    ];
}
