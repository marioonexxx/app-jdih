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
        Schema::create('riwayat_peraturan', function (Blueprint $table) {
            $table->id();

            // Relasi ke ID Perda yang baru (misal Perda 14/2025)
            $table->foreignId('dokumen_id')->constrained('dokumen_hukum')->onDelete('cascade');

            // Relasi ke ID Perda yang lama/target (misal Perda 1/2024)
            $table->unsignedBigInteger('target_dokumen_id');
            $table->foreign('target_dokumen_id')->references('id')->on('dokumen_hukum')->onDelete('cascade');

            // Jenis Hubungan (Mengubah / Mencabut)
            $table->enum('tipe_relasi', ['Mengubah', 'Mencabut', 'Diubah Oleh', 'Dicabut Oleh']);
            $table->text('catatan')->nullable(); // Contoh: "Mencabut Pasal 10 saja"

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_peraturan');
    }
};
