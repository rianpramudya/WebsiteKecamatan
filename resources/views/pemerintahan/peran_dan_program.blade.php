@extends('layouts.app')

@section('title', 'Peran dan Program - ' . $nama_wilayah)

@section('content')
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Judul Halaman --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-10 text-center border-l-8 border-green-600">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 tracking-tight">Peran dan Program</h1>
            <p class="mt-2 text-lg md:text-xl text-gray-500">{{ $nama_wilayah }}</p>
        </div>

        {{-- Daftar Peran dan Program --}}
        <div class="space-y-6">
            @forelse ($peran_dan_program as $item)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="p-6 md:p-8">
                        <h2 class="text-2xl font-bold text-green-700">{{ $item->judul }}</h2>
                        <p class="mt-4 text-gray-600 leading-relaxed">
                            {{ $item->deskripsi }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl shadow-md p-10 text-center">
                    <p class="text-gray-500 text-lg">Informasi mengenai peran dan program untuk wilayah ini belum tersedia.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
