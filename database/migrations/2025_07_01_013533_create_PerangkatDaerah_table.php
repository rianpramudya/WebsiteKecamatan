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
        Schema::create('Perangkatdaerah', function (Blueprint $table) {
            $table->id();
            // Kolom untuk menghubungkan ke kecamatan. Nullable berarti milik kabupaten.
            $table->foreignId('kecamatan_id')->nullable()->constrained('kecamatans')->onDelete('cascade');
            $table->string('nama_desa');
            $table->string('kepala_desa')->nullable();
            $table->string('luas_wilayah')->nullable(); // e.g., "150.5 ha"
            $table->unsignedInteger('jumlah_penduduk')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desas');
    }
};
