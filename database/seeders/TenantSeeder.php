<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        // Nonaktifkan foreign key constraint sementara agar bisa truncate tanpa error
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Kosongkan tabel tenants
        DB::table('tenants')->truncate();

        // Aktifkan kembali foreign key constraint
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Daftar nama kecamatan
        $kecamatanList = [
            'Binong', 'Blanakan', 'Ciasem', 'Ciater', 'Cibogo',
            'Cijambe', 'Cikaum', 'Cipeundeuy', 'Compreng', 'Dawuan',
            'Jalancagak', 'Kalijati', 'Kasomalang', 'Legonkulon', 'Pagaden',
            'Pagaden Barat', 'Pamanukan', 'Patokbeusi', 'Purwadadi', 'Pusakajaya',
            'Pusakanagara', 'Sagalaherang', 'Serangpanjang', 'Subang', 'Sukasari',
            'Tambakdahan', 'Tanjungsiang', 'Cipunagara', 'Cisalak', 'Pabuaran'
        ];

        // Masukkan data ke tabel tenants
        foreach ($kecamatanList as $kecamatan) {
            $slug = Str::slug($kecamatan);

            DB::table('tenants')->insert([
                'name' => $kecamatan,
                'slug' => $slug,
                'subdomain' => $slug . '.subang.go.id',
                'logo' => null,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
