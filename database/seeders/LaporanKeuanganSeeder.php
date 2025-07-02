<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanKeuanganSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('laporan_keuangans')->insert([
            [
                'tenant_id' => null, // null untuk Kabupaten
                'tahun' => 2025,
                'judul_laporan' => 'Laporan Realisasi APBD Semester I',
                'jenis_laporan' => 'Realisasi Anggaran',
                'deskripsi_singkat' => 'Dokumen realisasi semester I tahun anggaran 2025.',
                'file_url' => '/storage/laporan/apbd_semester1_2025.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id' => null,
                'tahun' => 2025,
                'judul_laporan' => 'Laporan Realisasi APBD Semester II',
                'jenis_laporan' => 'Realisasi Anggaran',
                'deskripsi_singkat' => 'Dokumen realisasi semester II tahun anggaran 2025.',
                'file_url' => '/storage/laporan/apbd_semester2_2025.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
