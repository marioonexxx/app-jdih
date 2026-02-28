<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilHalaman extends Model
{
    use HasFactory;
    protected $table = 'profil_halaman';

    /**
     * $guarded = ['id'] berarti semua kolom BOLEH diisi
     * secara massal, kecuali kolom 'id'.
     */
    protected $guarded = ['id'];
}
