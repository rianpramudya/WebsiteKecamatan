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
            // Menambahkan kolom untuk visi dan misi setelah kolom 'arti_lambang'
            $table->text('visi')->nullable()->after('arti_lambang');
            $table->text('misi')->nullable()->after('visi');
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
