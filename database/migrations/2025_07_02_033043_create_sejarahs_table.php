<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Membuat tabel 'sejarahs' untuk menyimpan event-event timeline
        Schema::create('sejarahs', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel kecamatans. Nullable berarti milik kabupaten.
            $table->foreignId('kecamatan_id')->nullable()->constrained('kecamatans')->onDelete('cascade');
            $table->string('tahun'); // e.g., "1968", "Era 1980-an"
            $table->string('judul'); // e.g., "Pembentukan Kabupaten"
            $table->text('deskripsi');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sejarahs');
    }
};
