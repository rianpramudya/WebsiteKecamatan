<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Kecamatan;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriList = KategoriBerita::pluck('id', 'slug');
        $kecamatanBinong = Kecamatan::where('slug', 'binong')->first();

        if ($kategoriList->isEmpty()) {
            $this->command->warn('Kategori berita belum tersedia. Jalankan KategoriBeritaSeeder terlebih dahulu.');
            return;
        }

        // 1. Berita kabupaten (tanpa kecamatan_id)
        $this->createUniqueBerita([
            'kategori_berita_id' => $kategoriList['pemerintahan'] ?? $kategoriList->first(),
            'judul' => 'Peresmian Jembatan Baru Menghubungkan Dua Desa',
            'excerpt' => 'Pemerintah Kabupaten Subang meresmikan jembatan gantung yang akan mempermudah akses warga.',
            'isi' => 'Isi lengkap berita mengenai peresmian jembatan baru...',
            'kecamatan_id' => null,
        ]);

        // 2. Berita kecamatan (Binong)
        if ($kecamatanBinong) {
            $this->createUniqueBerita([
                'kategori_berita_id' => $kategoriList['sosial'] ?? $kategoriList->first(),
                'judul' => 'Bakti Sosial di Kecamatan Binong Berhasil Kumpulkan Ratusan Kantong Darah',
                'excerpt' => 'Antusiasme warga Binong dalam kegiatan donor darah sangat tinggi.',
                'isi' => 'Isi lengkap berita bakti sosial Binong...',
                'kecamatan_id' => $kecamatanBinong->id,
            ]);
        }

        // 3. Tambahan berita acak (sebagian kabupaten, sebagian Binong)
        for ($i = 3; $i <= 15; $i++) {
            $judul = "Contoh Judul Berita Ke-$i di Kabupaten Subang";
            $this->createUniqueBerita([
                'kategori_berita_id' => $kategoriList->random(),
                'judul' => $judul,
                'excerpt' => "Ini adalah ringkasan singkat untuk berita ke-$i.",
                'isi' => "Isi lengkap untuk contoh berita ke-$i.",
                'published_at' => now()->subDays($i),
                'kecamatan_id' => $i % 2 === 0 && $kecamatanBinong ? $kecamatanBinong->id : null, // selang-seling kecamatan/kabupaten
            ]);
        }
    }

    private function createUniqueBerita(array $data): void
    {
        $baseSlug = Str::slug($data['judul']);
        $slug = $baseSlug;
        $counter = 1;

        while (Berita::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        Berita::create(array_merge($data, [
            'slug' => $slug,
            'published_at' => $data['published_at'] ?? now(),
        ]));
    }
}
