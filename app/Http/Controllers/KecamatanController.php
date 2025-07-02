<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KecamatanController extends Controller
{
    /**
     * Menampilkan halaman detail untuk sebuah kecamatan.
     * Metode ini sekarang menjadi entry point utama untuk setiap halaman kecamatan.
     *
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        // 1. Cari data kecamatan berdasarkan slug.
        $kecamatan = Kecamatan::where('slug', $slug)->firstOrFail();

        // 2. Ambil konten spesifik untuk kecamatan ini (misal: 3 berita terbaru)
        $beritaTerkini = Berita::where('kecamatan_id', $kecamatan->id)
                                ->latest()
                                ->take(3)
                                ->get();

        // 3. Kirim semua data yang dibutuhkan ke view 'kecamatan.show'.
        return view('kecamatan.show', [
            'kecamatan' => $kecamatan,
            'beritaTerkini' => $beritaTerkini,
        ]);
    }
}
