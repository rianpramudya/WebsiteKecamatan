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
        Schema::create('laporan_keuangans', function (Blueprint $table) {
            $table->id();
            // Kolom ini untuk menghubungkan laporan ke tenant/kecamatan.
            // Dibuat nullable agar bisa untuk laporan tingkat kabupaten.
            $table->foreignId('tenant_id')->nullable()->constrained()->onDelete('cascade');
            
            $table->year('tahun');
            $table->string('judul_laporan');
            $table->string('jenis_laporan'); // Misal: APBD, Realisasi Anggaran, LRA
            $table->text('deskripsi_singkat')->nullable();
            $table->string('file_url'); // Path ke file PDF di storage
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keuangans');
    }
};
