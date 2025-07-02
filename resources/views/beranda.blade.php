@extends('layouts.app')

@section('title', 'Beranda - Portal Resmi Kabupaten Subang')

@section('content')

{{-- ========== BAGIAN HERO / BANNER UTAMA ========== --}}
<div class="relative bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1588392382834-a891154bca4d?q=80&w=2070&auto=format&fit=crop');">
    <div class="absolute inset-0 bg-gray-900 bg-opacity-60"></div>
    <div class="relative container mx-auto px-6 pt-24 pb-48 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Portal Digital Kabupaten Subang</h1>
        <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto">
            Temukan informasi dan layanan terintegrasi dari 30 kecamatan di bawah satu atap untuk mewujudkan Subang Jawara.
        </p>
        <a href="#main-content" class="mt-8 inline-block bg-green-600 text-white font-bold py-3 px-8 rounded-full text-sm uppercase transition-all duration-300 ease-in-out hover:bg-green-700 hover:shadow-lg hover:-translate-y-1 active:scale-95">
            Jelajahi Sekarang
        </a>
    </div>
</div>

{{-- ========== BAGIAN UTAMA KONTEN ========== --}}
<div class="container mx-auto px-6" id="main-content">
    <div class="-mt-32 relative z-10">

        {{-- ========== BAGIAN BERITA TERKINI ========== --}}
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 px-2">Berita Terkini</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($beritaTerkini as $berita)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden group transform transition-transform duration-500 ease-in-out hover:shadow-2xl hover:-translate-y-2">
                        <a href="{{ route('berita.show', $berita->slug) }}" class="block">
                            <div class="overflow-hidden">
                                <img 
                                    src="{{ $berita->gambar ? asset('storage/berita/' . $berita->gambar) : 'https://placehold.co/600x400/cccccc/ffffff?text=Gambar+Berita' }}" 
                                    alt="Gambar {{ $berita->judul }}" 
                                    class="w-full h-40 object-cover transform transition-transform duration-500 group-hover:scale-110"
                                    onerror="this.onerror=null;this.src='https://placehold.co/600x400/e2e8f0/64748b?text=No+Image';"
                                >
                            </div>
                            <div class="p-5">
                                <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">
                                    {{ $berita->kategori->nama ?? 'Tanpa Kategori' }}
                                </span>
                                <h3 class="mt-3 mb-2 font-bold text-lg text-gray-900 group-hover:text-green-700 transition-colors">
                                    {{ $berita->judul }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ $berita->excerpt }}
                                </p>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Belum ada berita yang dipublikasikan.</p>
                @endforelse
            </div>

            {{-- Tombol ke semua berita --}}
            <div class="text-center mt-8 mb-16">
              <a href="{{ route('berita.index') }}" 
                 class="inline-block bg-blue-600 text-white font-semibold px-6 py-3 rounded-full shadow-md transition-all duration-300 ease-in-out 
                 hover:bg-blue-700 hover:shadow-lg hover:-translate-y-1 hover:scale-105">
                  Lihat Semua Berita
               </a>
            </div>

           {{-- ========== DAFTAR KECAMATAN ========== --}}
            <div class="relative bg-cover bg-center rounded-2xl overflow-hidden shadow-xl" style="background-image: url('https://images.unsplash.com/photo-1588392382834-a891154bca4d?q=80&w=2070&auto=format&fit=crop');">
    <div class="absolute inset-0 bg-gray-900 bg-opacity-60 rounded-2xl"></div>
    <div class="relative container mx-auto px-6 py-16">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-10 text-center">Jelajahi Wilayah Kecamatan</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
            @forelse ($kecamatans as $kecamatan)
                <a href="{{ url('/kecamatan/' . $kecamatan->slug) }}" class="block group kecamatan-item" title="Lihat detail Kecamatan {{ $kecamatan->name }}">
                    <div class="border border-gray-200 rounded-xl p-2 flex items-center justify-center text-center aspect-square bg-white/90 transition-all duration-300 hover:shadow-xl hover:border-green-500 hover:-translate-y-1.5">
                        <span class="text-gray-800 font-semibold text-sm md:text-base group-hover:text-green-600 transition-colors nama-kecamatan">
                            {{ $kecamatan->name }}
                        </span>
                    </div>
                </a>
            @empty
                <p class="col-span-full text-center text-gray-200">
                    Data kecamatan tidak ditemukan. Pastikan Anda sudah menjalankan <code>php artisan migrate:fresh --seed</code>.
                </p>
            @endforelse
        </div>
    </div>
</div>



    </div>
</div>

@endsection
