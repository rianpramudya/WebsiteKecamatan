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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_berita_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('excerpt'); // Untuk ringkasan
            $table->text('isi');
            $table->string('gambar')->nullable(); // Path ke gambar
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
