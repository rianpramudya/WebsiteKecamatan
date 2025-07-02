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
        Schema::create('penghargaans', function (Blueprint $table) {
            $table->id();
            // Kolom ini untuk menghubungkan penghargaan ke tenant/kecamatan.
            // Dibuat nullable agar bisa untuk penghargaan tingkat kabupaten (tidak terikat tenant).
            $table->foreignId('tenant_id')->nullable()->constrained()->onDelete('set null');
            
            $table->string('nama_penghargaan');
            $table->year('tahun');
            $table->string('tingkat'); // Misal: Nasional, Provinsi, Kabupaten
            $table->string('instansi_pemberi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghargaans');
    }
};
