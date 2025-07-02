<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sejarah; // Menggunakan model Sejarah
use App\Models\Kecamatan; // Diperlukan untuk mencari ID kecamatan

class SejarahSeeder extends Seeder
{
    public function run(): void
    {
        // Data untuk Kabupaten
        Sejarah::updateOrCreate(
            [
                'kecamatan_id' => null,
                'tahun' => '1968'
            ],
            [
                'judul' => 'Pembentukan Kabupaten',
                'deskripsi' => 'Kabupaten Subang secara resmi dibentuk sebagai daerah otonom terpisah dari Kabupaten Karawang berdasarkan Undang-Undang No. 4 Tahun 1968.',
                'urutan' => 1,
            ]
        );
        Sejarah::updateOrCreate(
            [
                'kecamatan_id' => null,
                'tahun' => 'Era 1980-an'
            ],
            [
                'judul' => 'Pembangunan Infrastruktur',
                'deskripsi' => 'Pembangunan infrastruktur besar-besaran dimulai, termasuk jalan utama dan fasilitas publik untuk mendukung pertumbuhan ekonomi daerah.',
                'urutan' => 2,
            ]
        );

        // --- DATA BARU UNTUK KECAMATAN BINONG ---
        // 1. Cari dulu data Kecamatan Binong untuk mendapatkan ID-nya
        $kecamatanBinong = Kecamatan::where('slug', 'binong')->first();

        // 2. Jika data Kecamatan Binong ditemukan, buat data sejarah yang berelasi dengannya
        if ($kecamatanBinong) {
            Sejarah::updateOrCreate(
                [
                    'kecamatan_id' => $kecamatanBinong->id,
                    'tahun' => '1990-an'
                ],
                [
                    'judul' => 'Pusat Pertanian Regional',
                    'deskripsi' => 'Kecamatan Binong berkembang menjadi salah satu lumbung padi utama di Kabupaten Subang, dengan modernisasi sistem irigasi yang meningkatkan hasil panen secara signifikan.',
                    'urutan' => 1,
                ]
            );
            Sejarah::updateOrCreate(
                [
                    'kecamatan_id' => $kecamatanBinong->id,
                    'tahun' => '2010'
                ],
                [
                    'judul' => 'Revitalisasi Pasar Tradisional',
                    'deskripsi' => 'Pasar Binong direvitalisasi menjadi pasar semi-modern untuk meningkatkan kenyamanan dan kebersihan, serta mendorong perekonomian lokal.',
                    'urutan' => 2,
                ]
            );
        }
    }
}
