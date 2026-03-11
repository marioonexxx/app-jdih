<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisProdukHukum extends Model
{
    // Karena nama tabel tidak jamak bahasa Inggris, tentukan manual
    protected $table = 'jenis_produk_hukum';

    protected $fillable = [
        'nama',
        'singkatan',
        'kelompok',
        'urutan'
    ];
}
