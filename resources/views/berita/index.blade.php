@extends('layouts.app')

@section('title', 'Berita Kabupaten Subang')

@section('content')
{{-- Hero Section --}}
<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl font-extrabold text-gray-800">Berita Kabupaten Subang</h1>
        <p class="text-gray-500 mt-2">Kumpulan informasi dan berita terkini seputar Kabupaten Subang.</p>

        {{-- Tombol Kelola Berita hanya untuk Admin/Superadmin --}}
        @auth
            @php
                $userRole = auth()->user()->role ?? null;
            @endphp

            @if(in_array($userRole, ['admin', 'superadmin']))
                <div class="mt-6">
                    <a href="{{ route('berita.index') }}" class="inline-block bg-blue-600 text-white font-bold py-2 px-5 rounded-lg text-sm hover:bg-blue-700 transition">
                        Kelola Berita
                    </a>
                </div>
            @endif
        @endauth
    </div>
</div>

{{-- Daftar Berita --}}
<div class="container mx-auto px-6 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($semuaBerita as $berita)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col group">
                {{-- Gambar --}}
                <div class="overflow-hidden">
                    <a href="{{ route('berita.show', $berita->slug) }}">
                        <img src="{{ asset('storage/berita/' . $berita->gambar) }}"
                             alt="Gambar {{ $berita->judul }}"
                             class="w-full h-48 object-cover transform transition-transform duration-500 group-hover:scale-110"
                             onerror="this.onerror=null;this.src='https://placehold.co/600x400/e2e8f0/64748b?text=No+Image';">
                    </a>
                </div>

                {{-- Konten --}}
                <div class="p-6 flex-grow flex flex-col">
                    <div class="flex-grow">
                        <div class="flex justify-between items-center text-xs mb-2">
                            <span class="font-semibold text-green-600 uppercase">{{ $berita->kategori->nama ?? 'Tanpa Kategori' }}</span>
                            <span class="text-gray-500">{{ \Carbon\Carbon::parse($berita->published_at)->isoFormat('D MMMM YYYY') }}</span>
                        </div>

                        <h3 class="font-bold text-lg text-gray-800 mb-2">
                            <a href="{{ route('berita.show', $berita->slug) }}" class="hover:text-green-700 transition-colors">
                                {{ $berita->judul }}
                            </a>
                        </h3>

                        <p class="text-sm text-gray-600 leading-relaxed">
                            {{ $berita->excerpt }}
                        </p>
                    </div>

                    {{-- Aksi Admin --}}
                    @auth
                        @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                            <div class="mt-4 pt-4 border-t border-gray-200 flex items-center space-x-2">
                                <a href="#" class="text-xs bg-yellow-400 text-yellow-800 px-3 py-1 rounded-full hover:bg-yellow-500 transition">Edit</a>
                                <form action="#" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs bg-red-400 text-red-800 px-3 py-1 rounded-full hover:bg-red-500 transition">Hapus</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">Belum ada berita yang dipublikasikan.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-12">
        {{ $semuaBerita->links() }}
    </div>
</div>
@endsection
