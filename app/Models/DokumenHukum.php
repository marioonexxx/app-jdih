<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenHukum extends Model
{
    use HasFactory;
    protected $table = 'dokumen_hukum';
    protected $guarded = ['id'];


    // Menampilkan dokumen-dokumen yang diubah/dicabut oleh peraturan ini
    public function riwayatKeBawah()
    {
        return $this->hasMany(RiwayatPeraturan::class, 'dokumen_id');
    }

    // Menampilkan peraturan mana yang pernah mengubah dokumen ini (untuk dokumen lama)
    public function riwayatKeAtas()
    {
        return $this->hasMany(RiwayatPeraturan::class, 'target_dokumen_id');
    }
}
