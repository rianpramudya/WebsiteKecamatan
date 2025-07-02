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
            // Menambahkan kolom-kolom baru setelah kolom 'arti_lambang'
            $table->string('peta_url')->nullable()->after('arti_lambang');
            $table->text('letak_geografis')->nullable()->after('peta_url');
            $table->text('iklim')->nullable()->after('letak_geografis');
            $table->text('demografi')->nullable()->after('iklim');
            $table->text('topografi')->nullable()->after('demografi');
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
