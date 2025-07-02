<?php

namespace Database\Seeders;

use App\Models\KategoriBerita;
use Illuminate\Database\Seeder;

class KategoriBeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Pemerintahan', 'slug' => 'pemerintahan'],
            ['nama' => 'Sosial', 'slug' => 'sosial'],
            ['nama' => 'Ekonomi', 'slug' => 'ekonomi'],
            ['nama' => 'Pendidikan', 'slug' => 'pendidikan'],
        ];

        foreach ($data as $item) {
            KategoriBerita::firstOrCreate(
                ['slug' => $item['slug']], // cek berdasarkan slug
                ['nama' => $item['nama']]  // jika tidak ada, insert
            );
        }
    }
}
