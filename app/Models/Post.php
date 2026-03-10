<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'status',
        'views_count',
        'published_at'
    ];

    // Mengatur agar Laravel otomatis memformat tanggal
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Relasi ke Category (Tabel: category)
     */
    public function category(): BelongsTo
    {
        // Secara eksplisit merujuk ke model Category
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relasi ke User (Penulis/Admin)
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Boot function untuk generate Slug otomatis saat membuat post
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title) . '-' . Str::random(5);
            }
        });
    }
}
