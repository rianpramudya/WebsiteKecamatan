@extends('layouts.app')

@section('title', 'Sejarah - ' . $nama_wilayah)

@push('styles')
{{-- Style tidak berubah, tetap diperlukan untuk animasi --}}
<style>
    .timeline-item {
        opacity: 0;
        transform: translateY(50px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    .timeline-item.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    .timeline-line {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 0;
        bottom: 0;
        width: 4px;
        background-color: #e5e7eb; /* gray-200 */
    }
    .timeline-dot {
        position: absolute;
        left: 50%;
        top: 1rem;
        transform: translateX(-50%);
        width: 1.5rem;
        height: 1.5rem;
        border-radius: 9999px;
        background-color: white;
        border: 4px solid #10b981; /* green-500 */
        z-index: 10;
    }
    @media (max-width: 1023px) {
        .timeline-line {
            left: 1.25rem;
            transform: translateX(-50%);
        }
        .timeline-dot {
            left: 1.25rem;
        }
        .timeline-content {
            width: 100%;
            padding-left: 3.5rem;
        }
    }
</style>
@endpush

@section('content')

<div class="bg-gray-100">

    {{-- Banner Judul Halaman (tidak berubah) --}}
    <div class="bg-gray-800 text-white py-16 text-center bg-cover bg-center" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1524186380902-4715f6353246?q=80&w=2070&auto=format&fit=crop');">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight">Sejarah</h1>
            <p class="text-gray-300 mt-2 text-xl">{{ $nama_wilayah }}</p>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- Kolom Kiri: Timeline Sejarah Interaktif --}}
            <div class="lg:col-span-2">
                <div class="relative">
                    <div class="timeline-line hidden lg:block"></div>
                    
                    {{-- Konten Sejarah Utama (Dinamis dari database) --}}
                    <div class="timeline-item space-y-4">
                        <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-green-500">
                            <h2 class="text-3xl font-bold text-gray-800 mb-4">Awal Mula</h2>
                            <div class="prose max-w-none text-gray-700 leading-relaxed">
                                {!! $sejarah !!}
                            </div>
                        </div>
                    </div>

                    {{-- ====================================================== --}}
                    {{-- =      PERULANGAN DINAMIS UNTUK TIMELINE SEJARAH     = --}}
                    {{-- ====================================================== --}}
                    @foreach ($sejarah_items as $item)
                    <div class="relative mt-12 timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                            {{-- Menggunakan $loop->odd untuk selang-seling posisi kiri dan kanan --}}
                            @if($loop->odd)
                                <div class="timeline-content lg:order-last">
                                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                                        <p class="text-gray-600">{{ $item->deskripsi }}</p>
                                    </div>
                                </div>
                                <div class="lg:pl-8 mb-4 lg:mb-0">
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $item->tahun }}</h3>
                                    <p class="text-gray-500">{{ $item->judul }}</p>
                                </div>
                            @else
                                <div class="lg:text-right lg:pr-8 mb-4 lg:mb-0">
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $item->tahun }}</h3>
                                    <p class="text-gray-500">{{ $item->judul }}</p>
                                </div>
                                <div class="timeline-content">
                                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                                        <p class="text-gray-600">{{ $item->deskripsi }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    {{-- ====================================================== --}}

                </div>
            </div>

            {{-- Kolom Kanan: Arti Lambang (tidak berubah) --}}
            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-2xl shadow-lg sticky top-24 timeline-item">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-3">Arti Lambang</h2>
                    <div class="w-full flex justify-center my-6">
                        <img src="{{ $logo_url ?? 'https://upload.wikimedia.org/wikipedia/commons/e/ea/Logo_Kabupaten_Subang.png' }}" alt="Lambang {{ $nama_wilayah }}" class="h-48 transition-transform duration-300 hover:scale-110">
                    </div>
                    <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                        {!! $arti_lambang !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Script animasi tidak berubah --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const timelineItems = document.querySelectorAll('.timeline-item');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });
    timelineItems.forEach(item => observer.observe(item));
});
</script>
@endpush
