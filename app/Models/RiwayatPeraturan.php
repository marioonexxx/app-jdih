<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPeraturan extends Model
{
    protected $table = 'riwayat_peraturan';

    protected $guarded = ['id'];

    /**
     * Menghubungkan kembali ke dokumen utama
     */
    public function dokumen(): BelongsTo
    {
        return $this->belongsTo(DokumenHukum::class, 'dokumen_id');
    }

    /**
     * Menghubungkan ke dokumen yang menjadi target (dokumen lama)
     */
    public function dokumenTarget(): BelongsTo
    {
        return $this->belongsTo(DokumenHukum::class, 'target_dokumen_id');
    }
}
