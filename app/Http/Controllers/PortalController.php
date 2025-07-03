<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Berita;
use Illuminate\Contracts\View\View;

class PortalController extends Controller
{
    /**
     * Menampilkan halaman utama (portal) yang berisi daftar kecamatan dan berita terkini.
     */
    public function index(): View
    {
        // Ambil semua tenant aktif (30 kecamatan)
        $kecamatans = Tenant::where('status', 'active')
            ->orderBy('name')
            ->get();

        // Ambil 3 berita terbaru yang sudah dipublikasikan
        $beritaTerkini = Berita::with('kategori') // Eager load kategori
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('beranda', [
            'kecamatans' => $kecamatans,
            'beritaTerkini' => $beritaTerkini,
            // Tidak mengirim 'kecamatan' => null, ini sudah benar.
        ]);
    }
}
