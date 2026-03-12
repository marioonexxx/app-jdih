<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    // Paksa model menggunakan tabel 'sliders' (jamak) sesuai standar migration
    protected $table = 'slider';

    // Daftarkan kolom agar bisa diisi (Mass Assignment)
    protected $fillable = [
        'title',
        'description',
        'image',
        'button_text',
        'button_link',
        'order',
        'is_active'
    ];

    // Opsional: Memastikan status is_active dianggap sebagai boolean
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
