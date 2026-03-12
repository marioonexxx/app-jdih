<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul Slider
            $table->text('description')->nullable(); // Sub-teks/Deskripsi
            $table->string('image'); // Path Gambar
            $table->string('button_text')->nullable(); // Teks di tombol (misal: "Lihat Detail")
            $table->string('button_link')->nullable(); // URL tujuan tombol
            $table->integer('order')->default(0); // Urutan tampil
            $table->boolean('is_active')->default(true); // Status aktif/non-aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider');
    }
};
