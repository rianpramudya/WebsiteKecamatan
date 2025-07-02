<?php

use Illuminate\Support\Facades\Route;

// Mengimpor semua Controller yang dibutuhkan
use App\Http\Controllers\PortalController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TransparansiController;
use App\Http\Controllers\PemerintahanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rute-rute utama aplikasi website kecamatan.
| Setiap rute akan diarahkan ke controller yang sesuai.
|
*/

// Halaman Utama (Portal Kabupaten)
Route::get('/', [PortalController::class, 'index'])->name('portal.index');

// Halaman Detail Kecamatan (dengan slug dinamis)
Route::get('/kecamatan/{slug}', [KecamatanController::class, 'show'])->name('kecamatan.show');

// Halaman Daftar Semua Berita (berita umum & bisa difilter di controller)
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');

// Halaman Detail Berita (berdasarkan slug)
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Rute untuk sejarah Kabupaten
Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('sejarah.kabupaten');

// Rute untuk sejarah spesifik per Kecamatan
Route::get('/kecamatan/{slug}/sejarah', [ProfilController::class, 'sejarah'])->name('sejarah.kecamatan');

// Rute untuk wilayah Kabupaten
Route::get('/profil/wilayah', [ProfilController::class, 'wilayah'])->name('wilayah.kabupaten');

// Rute untuk wilayah spesifik per Kecamatan
Route::get('/kecamatan/{slug}/profil/wilayah', [ProfilController::class, 'wilayah'])->name('wilayah.kecamatan');

// Rute untuk Visi & Misi Kabupaten
Route::get('/profil/visi-misi', [ProfilController::class, 'visiMisi'])->name('visimisi.kabupaten');

// Rute untuk Visi & Misi spesifik per Kecamatan
Route::get('/kecamatan/{slug}/profil/visi-misi', [ProfilController::class, 'visiMisi'])->name('visimisi.kecamatan');

// Rute untuk penghargaan Kabupaten
Route::get('/profil/penghargaan', [ProfilController::class, 'penghargaan'])->name('penghargaan.kabupaten');

// Rute untuk penghargaan spesifik per Kecamatan
Route::get('/kecamatan/{slug}/profil/penghargaan', [ProfilController::class, 'penghargaan'])->name('penghargaan.kecamatan');

// Transparansi Keuangan Kabupaten (tanpa slug)
Route::get('/transparansi', [TransparansiController::class, 'index'])->name('transparansi.kabupaten');

// Transparansi Keuangan per Kecamatan (dengan slug)
Route::get('/kecamatan/{slug}/transparansi', [TransparansiController::class, 'index'])->name('transparansi.kecamatan');

// Rute untuk struktur Kabupaten
Route::get('/pemerintahan/struktur', [PemerintahanController::class, 'struktur'])->name('struktur.kabupaten');

// Rute untuk struktur spesifik per Kecamatan
Route::get('/kecamatan/{slug}/pemerintahan/struktur', [PemerintahanController::class, 'struktur'])->name('struktur.kecamatan');

// Peran dan Program - Kabupaten
Route::get('/pemerintahan/peran-dan-program', [PemerintahanController::class, 'peranDanProgram'])->name('peran_program.kabupaten');

// Peran dan Program - Kecamatan
Route::get('/kecamatan/{slug}/pemerintahan/peran-dan-program', [PemerintahanController::class, 'peranDanProgram'])->name('peran_program.kecamatan');

// Perangkat Daerah - Kecamatan
Route::get('/pemerintahan/perangkat-daerah', [PemerintahanController::class, 'perangkatDaerah'])->name('perangkat_daerah.kabupaten');

// Perangkat Daerah - Kecamatan
Route::get('/kecamatan/{slug}/pemerintahan/perangkat-daerah', [PemerintahanController::class, 'perangkatDaerah'])->name('perangkat_daerah.kecamatan');

/// Rute untuk Wilayah Administrasi Kabupaten
Route::get('/pemerintahan/wilayah-administrasi', [PemerintahanController::class, 'wilayahAdministrasi'])->name('wilayah_administrasi.kabupaten');

// Rute untuk Wilayah Administrasi per Kecamatan
Route::get('/kecamatan/{slug}/pemerintahan/wilayah-administrasi', [PemerintahanController::class, 'wilayahAdministrasi'])->name('wilayah_administrasi.kecamatan');