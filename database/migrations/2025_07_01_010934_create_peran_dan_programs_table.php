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
        Schema::create('peran_dan_programs', function (Blueprint $table) {
            $table->id();
            // Kolom untuk menghubungkan ke kecamatan. Nullable berarti milik kabupaten.
            $table->foreignId('kecamatan_id')->nullable()->constrained('kecamatans')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->integer('urutan')->default(0); // Untuk pengurutan tampilan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peran_dan_programs');
    }
};
