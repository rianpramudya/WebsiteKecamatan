@extends('layouts.app')

@section('title', $nama_wilayah . ' - Transparansi Keuangan')

@section('content')
    <div class="container mx-auto px-4 py-10">

        {{-- Judul Halaman --}}
        <div class="mb-10">
            <h1 class="text-4xl font-extrabold text-gray-800 leading-snug">
                Transparansi Keuangan
            </h1>
            <span class="text-lg text-green-600 font-medium">{{ $nama_wilayah }}</span>
        </div>

        {{-- Konten --}}
        @forelse ($laporan_per_tahun as $tahun => $laporans)
            <div class="mb-12">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-semibold text-gray-700 border-b-2 border-green-500 inline-block pb-1">
                        Tahun {{ $tahun }}
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($laporans as $laporan)
                        <div class="bg-white rounded-xl shadow hover:shadow-lg transition-all duration-200 border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                    {{ $laporan->judul }}
                                </h3>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2z" />
                                    </svg>
                                    {{ $laporan->created_at->format('d M Y') }}
                                </div>
                            </div>
                            <div class="bg-gray-50 px-6 py-3 border-t text-right">
                                <a href="{{ $laporan->file_url }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                    Lihat Dokumen
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            {{-- Jika Tidak Ada Data --}}
            <div class="text-center py-20">
                <div class="flex flex-col items-center justify-center space-y-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-300" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 17v-4a1 1 0 011-1h4m0 0V7a2 2 0 00-2-2H5.5a2 2 0 00-2 2v10a2 2 0 002 2h5.379a1 1 0 00.894-.553L14 13h5a2 2 0 012 2v3" />
                    </svg>
                    <p class="text-gray-500 text-lg font-medium">Belum ada data laporan keuangan yang tersedia.</p>
                </div>
            </div>
        @endforelse
    </div>
@endsection
