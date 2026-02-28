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
        Schema::create('profil_halaman', function (Blueprint $table) {
            $table->id();
            // Konten Profil
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->string('struktur_organisasi')->nullable();
            $table->longText('dasar_hukum')->nullable();

            // Konten Kontak (Tambahkan ini)
            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('google_maps')->nullable(); // Untuk simpan link iframe dari Google Maps

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_halaman');
    }
};
