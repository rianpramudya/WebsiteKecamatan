<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TenantSeeder::class,
            KecamatanSeeder::class,
            KategoriBeritaSeeder::class,
            BeritaSeeder::class,
            LaporanKeuanganSeeder::class,
            PeranDanProgramSeeder::class,
            PerangkatDaerahSeeder::class,
        ]);
    }
}
