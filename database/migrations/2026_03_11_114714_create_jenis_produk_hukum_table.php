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
        Schema::create('jenis_produk_hukum', function (Blueprint $table) {
            $table->id();
            $table->string('nama');           // Contoh: Peraturan Daerah
            $table->string('singkatan');      // Contoh: PERDA
            $table->string('kelompok');       // Contoh: Peraturan (Regeling)
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_produk_hukum');
    }
};
