@extends('layouts.app')

@section('title', 'Visi & Misi - ' . $nama_wilayah)

@section('content')

{{-- Latar belakang utama halaman --}}
<div class="bg-gray-50 py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        
        {{-- ====================================================================== --}}
        {{-- =             JUDUL HALAMAN DENGAN DESAIN BARU & ELEGAN            = --}}
        {{-- ====================================================================== --}}
        <div class="bg-white rounded-xl shadow-md p-6 text-left mb-12 border-l-8 border-green-500">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 tracking-tight">Visi & Misi</h1>
            <p class="mt-1 text-lg text-gray-500">{{ $nama_wilayah }}</p>
        </div>

        <div class="space-y-12">
            {{-- ====================================================================== --}}
            {{-- =                        BAGIAN VISI (DIREVISI)                        = --}}
            {{-- ====================================================================== --}}
            <div class="transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 bg-white p-8 rounded-xl border border-gray-200">
                <h2 class="text-2xl font-bold text-sky-800 mb-4 pb-2 border-b-2 border-sky-100">VISI</h2>
                <div class="text-gray-700 leading-relaxed">
                    <p class="italic text-xl">
                        "{{ $visi ?? 'Visi belum tersedia.' }}"
                    </p>
                </div>
            </div>

            {{-- ====================================================================== --}}
            {{-- =                        BAGIAN MISI (DIREVISI)                        = --}}
            {{-- ====================================================================== --}}
            <div class="transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 bg-white p-8 rounded-xl border border-gray-200">
                <h2 class="text-2xl font-bold text-sky-800 mb-4 pb-2 border-b-2 border-sky-100">MISI</h2>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! $misi ?? 'Misi belum tersedia.' !!}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
