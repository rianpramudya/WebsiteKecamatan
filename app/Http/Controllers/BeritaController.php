<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BeritaController extends Controller
{
    /**
     * Menampilkan halaman daftar semua berita (sudah ada).
     */
    public function index(): View
    {
        $semuaBerita = Berita::with('kategori')
                            ->latest('published_at')
                            ->paginate(9);

        return view('berita.index', [
            'semuaBerita' => $semuaBerita
        ]);
    }

    /**
     * REVISI: Menampilkan halaman detail untuk satu berita.
     * Metode ini akan dipanggil saat URL /berita/{slug} diakses.
     *
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        // 1. Cari berita di database berdasarkan slug-nya.
        //    firstOrFail() akan otomatis menampilkan halaman 404 jika tidak ditemukan.
        $berita = Berita::where('slug', $slug)->firstOrFail();

        // 2. Kirim data berita yang ditemukan ke file view 'berita.show'
        return view('berita.show', [
            'berita' => $berita
        ]);
    }
}
