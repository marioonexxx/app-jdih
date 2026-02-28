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
        Schema::create('dokumen_hukum', function (Blueprint $table) {
            $table->id();

            // INFORMASI UMUM (Sesuai Contoh Semarang)
            $table->string('tipe_dokumen')->default('Peraturan Perundang-undangan');
            $table->string('jenis');              // Contoh: Peraturan Daerah
            $table->string('singkatan_jenis');    // Contoh: PERDA
            $table->string('nomor');              // Contoh: 14
            $table->integer('tahun');             // Contoh: 2025
            $table->text('judul');                // Judul Lengkap Peraturan

            // PENETAPAN & PENGUNDANGAN
            $table->date('tanggal_ditetapkan')->nullable();
            $table->date('tanggal_diundangkan')->nullable();

            // KLASIFIKASI
            $table->string('bidang_hukum')->nullable(); // Contoh: Hukum Tata Negara
            $table->text('sumber')->nullable();       // Contoh: LD KAB. MBD TAHUN 2025 NOMOR 14
            $table->text('subjek')->nullable();       // Contoh: Barang Milik Daerah
            $table->string('urusan_pemerintah')->nullable()->default('-');

            // ENTITAS & LOKASI
            $table->string('pemrakarsa')->nullable();   // Contoh: BPKAD
            $table->string('penandatangan')->nullable(); // Nama Bupati
            $table->string('lokasi')->default('Kabupaten Maluku Barat Daya');
            $table->string('teu_badan_orang')->default('Maluku Barat Daya(Kabupaten)');
            $table->string('tempat_terbit')->default('Tiakur');
            $table->string('tempat_penetapan')->default('Tiakur');

            // STATUS & FILE
            $table->enum('status', ['Berlaku','Berlaku (Diubah)' , 'Tidak Berlaku (Dicabut)', 'Tetap'])->default('Berlaku');
            $table->text('keterangan_status')->nullable();
            $table->string('bahasa')->default('Indonesia');
            $table->string('file_pdf')->nullable();

            // STATISTIK
            $table->integer('diakses')->default(0);
            $table->integer('diunduh')->default(0);

            // Menambahkan kolom id_user yang menginput
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');

            // Opsional: Jika ingin tahu siapa yang terakhir mengubah (edit)
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_hukum');
    }
};
