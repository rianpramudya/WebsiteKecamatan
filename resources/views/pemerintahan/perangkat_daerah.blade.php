@extends('layouts.app')

@section('title', 'Perangkat Daerah - ' . $nama_wilayah)

@section('content')
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Judul Halaman --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 tracking-tight">Perangkat Daerah</h1>
            <p class="mt-2 text-lg md:text-xl text-gray-500">{{ $nama_wilayah }}</p>
        </div>

        {{-- Kontainer Tabel --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            {{-- Wrapper untuk scroll di mobile --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-200 text-gray-700 uppercase text-xs tracking-wider">
                        <tr>
                            <th scope="col" class="px-6 py-4">No</th>
                            <th scope="col" class="px-6 py-4">Nama Desa/Kelurahan</th>
                            <th scope="col" class="px-6 py-4">Kepala Desa/Lurah</th>
                            <th scope="col" class="px-6 py-4">Luas Wilayah</th>
                            <th scope="col" class="px-6 py-4">Jumlah Penduduk</th>
                            <th scope="col" class="px-6 py-4">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($perangkat_daerah as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-semibold text-gray-800">{{ $item->nama_desa }}</td>
                                <td class="px-6 py-4">{{ $item->kepala_desa ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $item->luas_wilayah ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $item->jumlah_penduduk ? number_format($item->jumlah_penduduk, 0, ',', '.') : '-' }}</td>
                                <td class="px-6 py-4">{{ $item->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                    Data perangkat daerah untuk wilayah ini belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
