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
        Schema::create('pejabats', function (Blueprint $table) {
            $table->id();
            // Kolom ini untuk menghubungkan pejabat ke tenant/kecamatan.
            // Dibuat nullable agar bisa untuk pejabat tingkat kabupaten.
            $table->foreignId('tenant_id')->nullable()->constrained()->onDelete('cascade');
            
            $table->string('nama');
            $table->string('jabatan');
            $table->string('foto_url')->nullable(); // Path ke foto pejabat
            $table->integer('urutan')->default(0); // Untuk sorting hierarki
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejabats');
    }
};
