<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PerangkatDaerah;
use App\Models\Kecamatan;

class PerangkatDaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data untuk Kecamatan Binong (contoh)
        $kecamatanBinong = Kecamatan::where('slug', 'binong')->first();
        if ($kecamatanBinong) {
            PerangkatDaerah::create([
                'kecamatan_id' => $kecamatanBinong->id,
                'nama_desa' => 'Karangwangi',
                'kepala_desa' => 'Asep Surasep',
                'luas_wilayah' => '270.5 Ha',
                'jumlah_penduduk' => 5400,
                'keterangan' => 'Pusat Pemerintahan Kecamatan',
            ]);
            PerangkatDaerah::create([
                'kecamatan_id' => $kecamatanBinong->id,
                'nama_desa' => 'Cicadas',
                'kepala_desa' => 'Budi Santoso',
                'luas_wilayah' => '190.2 Ha',
                'jumlah_penduduk' => 4100,
                'keterangan' => 'Wilayah Pertanian',
            ]);
        }

        // Data untuk Kecamatan Ciasem
        $kecamatanCiasem = Kecamatan::where('slug', 'ciasem')->first();
        if ($kecamatanCiasem) {
            PerangkatDaerah::create([
                'kecamatan_id' => $kecamatanCiasem->id,
                'nama_desa' => 'Ciasem Tengah',
                'kepala_desa' => 'Siti Komariah',
                'luas_wilayah' => '310.0 Ha',
                'jumlah_penduduk' => 6250,
                'keterangan' => 'Area Perdagangan',
            ]);
        }
    }
}
