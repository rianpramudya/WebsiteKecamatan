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
        Schema::table('tenants', function (Blueprint $table) {
            // Menambahkan kolom untuk menyimpan teks sejarah setelah kolom 'logo'
            $table->text('sejarah')->nullable()->after('logo');
            // Menambahkan kolom untuk menyimpan teks arti lambang
            $table->text('arti_lambang')->nullable()->after('sejarah');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            //
        });
    }
};
