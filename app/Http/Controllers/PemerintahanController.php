<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use App\Models\Tenant;
use App\Models\Kecamatan;
use App\Models\PeranDanProgram;
use App\Models\PerangkatDaerah;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PemerintahanController extends Controller
{
    /**
     * Menampilkan halaman Struktur Pemerintahan.
     * Logika ini dinamis berdasarkan slug yang diberikan.
     */
    public function struktur(string $slug = null): View
    {
        // Catatan: Metode ini masih menggunakan model Tenant, yang mungkin perlu diseragamkan
        // dengan model Kecamatan di masa depan untuk konsistensi.
        $query = Pejabat::query()->orderBy('urutan', 'asc');
        $nama_wilayah = 'Kabupaten Subang';
        $kecamatan = null;

        if ($slug) {
            $tenant = Tenant::where('slug', $slug)->firstOrFail();
            $query->where('tenant_id', $tenant->id);
            $nama_wilayah = 'Kecamatan ' . $tenant->name;
            $kecamatan = $tenant;
        } else {
            $query->whereNull('tenant_id');
        }

        $pejabats = $query->get();

        $pimpinan = $pejabats->whereIn('jabatan', ['Bupati', 'Camat']);
        $sekretaris = $pejabats->whereIn('jabatan', ['Sekretaris Daerah', 'Sekretaris Kecamatan']);
        $kepala_bagian = $pejabats->whereIn('jabatan', ['Kepala Bagian A', 'Kepala Bagian B']);
        $staf = $pejabats->where('jabatan', 'Staf Ahli');

        return view('pemerintahan.struktur', [
            'nama_wilayah' => $nama_wilayah,
            'kecamatan' => $kecamatan,
            'pimpinan' => $pimpinan,
            'sekretaris' => $sekretaris,
            'kepala_bagian' => $kepala_bagian,
            'staf' => $staf,
            'semua_pejabat' => $pejabats
        ]);
    }

    /**
     * Menampilkan halaman Peran dan Program.
     */
    public function peranDanProgram(Request $request, string $slug = null): View
    {
        if ($slug) {
            $kecamatan = Kecamatan::where('slug', $slug)->firstOrFail();
            $peran_dan_program = PeranDanProgram::where('kecamatan_id', $kecamatan->id)
                ->orderBy('urutan')
                ->get();
            $nama_wilayah = 'Kecamatan ' . $kecamatan->name;
        } else {
            $kecamatan = null;
            $peran_dan_program = PeranDanProgram::whereNull('kecamatan_id')
                ->orderBy('urutan')
                ->get();
            $nama_wilayah = 'Kabupaten Subang';
        }

        return view('pemerintahan.peran_dan_program', compact('peran_dan_program', 'nama_wilayah', 'kecamatan'));
    }

    /**
     * Menampilkan halaman Perangkat Daerah.
     */
    public function perangkatDaerah(Request $request, $slug = null)
    {
        $query = PerangkatDaerah::query();

        if ($slug) {
            $kecamatan = Kecamatan::where('slug', $slug)->firstOrFail();
            $query->where('kecamatan_id', $kecamatan->id);
            $nama_wilayah = 'Kecamatan ' . $kecamatan->name;
        } else {
            $kecamatan = null;
            $query->whereNull('kecamatan_id');
            $nama_wilayah = 'Kabupaten Subang';
        }

        $perangkat_daerah = $query->orderBy('nama_desa')->get();

        return view('pemerintahan.perangkat_daerah', compact('perangkat_daerah', 'nama_wilayah', 'kecamatan'));
    }

    /**
     * Menampilkan halaman Wilayah Administrasi.
     * PERBAIKAN DITERAPKAN DI SINI.
     */
    public function wilayahAdministrasi(Request $request, $slug = null)
    {
        if ($slug) {
            // KONTEKS KECAMATAN: Tampilkan daftar Perangkat Daerah di dalamnya
            $kecamatan = Kecamatan::where('slug', $slug)->firstOrFail();
            // PERBAIKAN: Memanggil nama relasi yang benar (perangkatDaerahs)
            $list_data = $kecamatan->perangkatDaerahs()->orderBy('nama_desa')->get();
            $nama_wilayah = 'Kecamatan ' . $kecamatan->name;
            $is_kabupaten = false;
        } else {
            // KONTEKS KABUPATEN: Tampilkan daftar Kecamatan
            $kecamatan = null;
            // PERBAIKAN: Menggunakan nama relasi yang benar (perangkatDaerahs) di withCount dan withSum
            $list_data = Kecamatan::where('slug', '!=', 'kabupaten-subang')
                                    ->withCount('perangkatDaerahs')
                                    ->withSum('perangkatDaerahs as total_penduduk', 'jumlah_penduduk')
                                    ->orderBy('name')
                                    ->get();
            $nama_wilayah = 'Kabupaten Subang';
            $is_kabupaten = true;
        }

        return view('pemerintahan.wilayah_administrasi', compact(
            'list_data', 
            'nama_wilayah', 
            'kecamatan', 
            'is_kabupaten'
        ));
    }
}
