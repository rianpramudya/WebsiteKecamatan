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
        Schema::table('beritas', function (Blueprint $table) {
            // Menambahkan kolom foreign key untuk relasi ke tabel kecamatans
            // `nullable()` berarti jika kolom ini kosong (null), maka berita ini milik kabupaten.
            // `after('id')` menempatkan kolom ini setelah kolom 'id' agar lebih rapi.
            $table->foreignId('kecamatan_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('kecamatans')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            // Menghapus relasi dan kolom jika migrasi di-rollback
            $table->dropForeign(['kecamatan_id']);
            $table->dropColumn('kecamatan_id');
        });
    }
};
