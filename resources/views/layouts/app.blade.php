<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', isset($kecamatan) ? 'Portal Kecamatan ' . $kecamatan->name . ' - Kabupaten Subang' : 'Portal Resmi Kabupaten Subang')
    </title>

    {{-- Memuat CSS dan JS dari Vite. Ini adalah satu-satunya tempat @vite harus ada. --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f5f7;
            /* Warna latar belakang abu-abu terang */
        }

        /* Style untuk animasi transisi search bar */
        #search-input {
            transition: width 0.3s ease-in-out;
        }
    </style>
    {{-- Logic kontekstual multi-kecamatan --}}
    @php
    $isKecamatan = request()->routeIs('kecamatan.*') && isset($kecamatan);
    $slugKec = $isKecamatan ? ['slug' => $kecamatan->slug] : [];
    @endphp
</head>

{{-- ====================================================================== --}}
{{-- =                    KODE GOOGLE ANALYTICS DIMASUKKAN DI SINI        = --}}
{{-- ====================================================================== --}}
@if(config('app.env') == 'production') {{-- Hanya aktif jika website sudah online --}}
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GA_MEASUREMENT_ID') }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', "{{ env('GA_MEASUREMENT_ID') }}");
</script>
@endif
{{-- ====================================================================== --}}

</head>

<body class="antialiased flex flex-col min-h-screen">

    {{-- ====================================================================== --}}
    {{-- =                            BAGIAN HEADER                           = --}}
    {{-- ====================================================================== --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        {{-- Baris Atas untuk Tanggal & Waktu Realtime --}}
        <div class="bg-gray-800 text-white text-xs">
            <div class="container mx-auto px-6 py-1.5 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span id="realtime-clock">Memuat waktu...</span>
            </div>
        </div>

        {{-- Baris Bawah untuk Logo, Menu, dan Pencarian --}}
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center py-4">
                {{-- Logo dan Teks --}}
                <a href="/" class="flex items-center space-x-4">
                    <img src="https://3.bp.blogspot.com/-ZWU-FSwZ4bc/VFZZ0UDcJZI/AAAAAAAAEns/0NNAGSfyoxA/s1600/logo-Pemerintah-Kabupaten-Subang.png" class="h-20" alt="Logo Kabupaten Subang"
                        onerror="this.onerror=null;this.src='https://placehold.co/80x80/e2e8f0/e2e8f0?text=Logo';">
                    <div class="font-bold text-gray-800 leading-tight">
                        <div class="text-xl">Pemerintah Daerah</div>
                        <div class="text-2xl">Kabupaten Subang</div>
                    </div>
                </a>

                {{-- ====================================================================== --}}
                {{-- =           MENU NAVIGASI (DIREVISI DENGAN ANIMASI HOVER)          = --}}
                {{-- ====================================================================== --}}
                <nav class="hidden lg:flex items-center space-x-6 text-sm font-medium text-gray-500">
                    {{-- Link Beranda dinamis --}}
                    @if (request()->routeIs('kecamatan.*') && isset($kecamatan))
                    <a href="{{ route('kecamatan.show', ['slug' => $kecamatan->slug]) }}"
                        class="text-green-600 font-bold transform transition-transform duration-200 hover:scale-105">
                        Beranda
                    </a>
                    @else
                    <a href="{{ route('portal.index') }}"
                        class="hover:text-green-600 transform transition-transform duration-200 hover:scale-105">
                        Beranda
                    </a>
                    @endif
                    {{-- Dropdown untuk Profil --}}
                    <div class="relative" data-dropdown>
                        <button class="dropdown-toggle flex items-center hover:text-green-600 transform transition-transform duration-200 hover:scale-105">
                            <span>Profil</span>
                            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div class="dropdown-menu hidden absolute mt-2 w-48 bg-white rounded-md shadow-xl z-20 py-1 border">
                            {{-- Link Sejarah --}}
                            @if (request()->routeIs('kecamatan.*') && isset($kecamatan))
                            <a href="{{ route('sejarah.kecamatan', ['slug' => $kecamatan->slug]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">Sejarah</a>
                            @else
                            <a href="{{ route('sejarah.kabupaten') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">Sejarah</a>
                            @endif

                            {{-- Link Wilayah --}}
                            @if (request()->routeIs('kecamatan.*') && isset($kecamatan))
                            <a href="{{ route('wilayah.kecamatan', ['slug' => $kecamatan->slug]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">Wilayah</a>
                            @else
                            <a href="{{ route('wilayah.kabupaten') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">Wilayah</a>
                            @endif

                            {{-- Link Visi dan Misi --}}
                            @if (request()->routeIs('kecamatan.*') && isset($kecamatan))
                            <a href="{{ route('visimisi.kecamatan', ['slug' => $kecamatan->slug]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">Visi dan Misi</a>
                            @else
                            <a href="{{ route('visimisi.kabupaten') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">Visi dan Misi</a>
                            @endif

                            {{-- Link Penghargaan (DINAMIS) --}}
                            @if (request()->routeIs('kecamatan.*') && isset($kecamatan))
                            <a href="{{ route('penghargaan.kecamatan', ['slug' => $kecamatan->slug]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">Penghargaan</a>
                            @else
                            <a href="{{ route('penghargaan.kabupaten') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">Penghargaan</a>
                            @endif
                        </div>
                    </div>


                    {{-- Dropdown untuk Pemerintahan --}}
                    @php
                    $isKecamatan = request()->routeIs('kecamatan.*') && isset($kecamatan);
                    $slugKec = $isKecamatan ? ['slug' => $kecamatan->slug] : [];
                    @endphp

                    <div class="relative" data-dropdown>
                        <button class="dropdown-toggle flex items-center hover:text-green-600 transform transition-transform duration-200 hover:scale-105">
                            <span>Pemerintahan</span>
                            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <div class="dropdown-menu hidden absolute mt-2 w-48 bg-white rounded-md shadow-xl z-20 py-1 border">
                            {{-- Struktur Pemerintahan --}}
                            <a href="{{ $isKecamatan ? route('struktur.kecamatan', $slugKec) : route('struktur.kabupaten') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">
                                Struktur Pemerintahan
                            </a>

                            {{-- Peran dan Program --}}
                            <a href="{{ $isKecamatan ? route('peran_program.kecamatan', $slugKec) : route('peran_program.kabupaten') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">
                                Peran dan Program
                            </a>

                            {{-- Perangkat Daerah --}}
                            <a href="{{ $isKecamatan ? route('perangkat_daerah.kecamatan', $slugKec) : route('perangkat_daerah.kabupaten') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">
                                Perangkat Daerah
                            </a>

                            {{-- Placeholder: Wilayah Administrasi --}}
                            @if (request()->routeIs('kecamatan.*') && isset($kecamatan))
        <a href="{{ route('wilayah_administrasi.kecamatan', ['slug' => $kecamatan->slug]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">
            Wilayah Administrasi
        </a>
        @else
        <a href="{{ route('wilayah_administrasi.kabupaten') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">
            Wilayah Administrasi
        </a>
        @endif
                        </div>
                    </div>



                    {{-- Dropdown untuk Wisata --}}
                    <div class="relative" data-dropdown>
                        <button class="dropdown-toggle flex items-center hover:text-green-600 transform transition-transform duration-200 hover:scale-105">
                            <span>Wisata</span>
                            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div class="dropdown-menu hidden absolute mt-2 w-48 bg-white rounded-md shadow-xl z-20 py-1 border">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Seni dan Budaya</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Objek Wisata</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Hotel</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Rumah Makan</a>
                        </div>
                    </div>

                    {{-- Menu Biasa (Tanpa Dropdown) --}}
                    {{-- Link Transparansi Keuangan --}}
                    @if (request()->routeIs('kecamatan.*') && isset($kecamatan))
                    <a href="{{ route('transparansi.kecamatan', ['slug' => $kecamatan->slug]) }}" class="hover:text-green-600 transform transition-transform duration-200 hover:scale-105">
                        Transparansi Keuangan
                    </a>
                    @else
                    <a href="{{ route('transparansi.kabupaten') }}" class="hover:text-green-600 transform transition-transform duration-200 hover:scale-105">
                        Transparansi Keuangan
                    </a>
                    @endif



                    <a href="#" class="hover:text-green-600 transform transition-transform duration-200 hover:scale-105">PPID</a>
                    <a href="#" class="hover:text-green-600 transform transition-transform duration-200 hover:scale-105">JDIH</a>

                    <!-- PERBAIKAN SEMENTARA: Menggunakan url() bukan route() -->
                    <a href="{{ url('/berita') }}" class="hover:text-green-600 transform transition-transform duration-200 hover:scale-105">Info Grafis</a>
                </nav>

                {{-- Bagian Pencarian Interaktif --}}
                <div id="search-container" class="relative flex items-center">
                    <input type="text" id="search-input" placeholder="Cari kecamatan..." class="hidden w-0 md:w-48 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                    {{-- Tombol search sudah memiliki animasi --}}
                    <button id="search-toggle" class="bg-gray-100 p-3 rounded-md ml-2 transform transition-transform duration-300 hover:bg-gray-200 hover:scale-110 hover:rotate-6">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer Anda yang sudah ada --}}
    <footer class="bg-white">
        <div class="bg-gray-100 py-12">
            <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10 text-gray-800">
                <div class="flex flex-col items-center text-center md:items-start md:text-left">
                    <h3 class="font-bold text-lg mb-4">Hubungi Kami</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>(0260) 411318</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>diskominfo@subang.go.id</span>
                        </li>
                    </ul>
                    <div class="mt-4 flex items-center space-x-1 border-2 border-gray-900 rounded-md p-1 w-fit font-mono text-sm">
                        <a href="#" class="bg-gray-900 text-white px-2 py-0.5 rounded-sm hover:opacity-80">F</a>
                        <a href="#" class="bg-gray-900 text-white px-2 py-0.5 rounded-sm hover:opacity-80">X</a>
                        <a href="#" class="bg-gray-900 text-white px-2 py-0.5 rounded-sm hover:opacity-80">▶</a>
                        <a href="#" class="bg-gray-900 text-white px-2 py-0.5 rounded-sm hover:opacity-80">O</a>
                    </div>
                </div>
                <div class="flex flex-col items-center text-center md:items-start md:text-left">
                    <h3 class="font-bold text-lg mb-4">Link Terkait</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center"><span class="w-2 h-2 rounded-full border border-gray-800 mr-3 flex-shrink-0"></span><a href="#" class="hover:underline">Kontak kami</a></li>
                        <li class="flex items-center"><span class="w-2 h-2 rounded-full border border-gray-800 mr-3 flex-shrink-0"></span><a href="#" class="hover:underline">Agenda</a></li>
                        <!-- PERBAIKAN SEMENTARA: Menggunakan url() bukan route() -->
                        <li class="flex items-center"><span class="w-2 h-2 rounded-full border border-gray-800 mr-3 flex-shrink-0"></span><a href="{{ url('/berita') }}" class="hover:underline">Berita</a></li>
                        <li class="flex items-center"><span class="w-2 h-2 rounded-full border border-gray-800 mr-3 flex-shrink-0"></span><a href="#" class="hover:underline">Pengumuman</a></li>
                    </ul>
                </div>
                <div class="flex flex-col items-center text-center md:items-start md:text-left">
                    <h3 class="font-bold text-lg mb-4">Statistik</h3>
                    {{-- ====================================================================== --}}
                    {{-- =    BAGIAN STATISTIK DIPERBARUI UNTUK MENERIMA DATA DINAMIS     = --}}
                    {{-- ====================================================================== --}}
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{-- Data akan diisi oleh View Composer nanti --}}
                            <span>Pengguna Online: {{ $visitorStats['online'] ?? '...' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9V3m0 18a9 9 0 009-9m-9 9a9 9 0 00-9-9"></path>
                            </svg>
                            <span>Pengunjung Hari Ini: {{ $visitorStats['today'] ?? '...' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>Total Pengunjung: {{ $visitorStats['total'] ?? '...' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bg-gray-900 text-gray-300 py-4">
            <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-xs">
                <span>Diskominfo Kabupaten Subang © {{ date('Y') }}</span>
                <span class="flex items-center mt-2 md:mt-0">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Jl. Mayjen Sutoyo No.46, Karanganyar, Kec. Subang, Kab. Subang, Jawa Barat 41211</span>
                </span>
            </div>
        </div>
    </footer>


    {{-- Script untuk Jam Realtime, Pencarian, dan Dropdown --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Fungsi Jam Realtime ---
            const clockElement = document.getElementById('realtime-clock');
            if (clockElement) {
                function updateClock() {
                    const options = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false
                    };
                    const formattedTime = new Date().toLocaleString('id-ID', options).replace(/\./g, ':');
                    clockElement.textContent = formattedTime;
                }
                setInterval(updateClock, 1000);
                updateClock();
            }

            // --- Fungsi Pencarian Interaktif ---
            const searchToggle = document.getElementById('search-toggle');
            const searchInput = document.getElementById('search-input');

            if (searchToggle && searchInput) {
                searchToggle.addEventListener('click', function(event) {
                    event.stopPropagation();
                    searchInput.classList.toggle('hidden');
                    searchInput.classList.toggle('w-0');
                    if (!searchInput.classList.contains('hidden')) {
                        searchInput.focus();
                    }
                });

                searchInput.addEventListener('input', function() {
                    const filter = searchInput.value.toLowerCase();
                    const kecamatanItems = document.querySelectorAll('.kecamatan-item');

                    kecamatanItems.forEach(function(item) {
                        const namaKecamatan = item.querySelector('.nama-kecamatan').textContent.toLowerCase();
                        if (namaKecamatan.includes(filter)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });

                document.addEventListener('click', function(event) {
                    const isClickInside = document.getElementById('search-container').contains(event.target);
                    if (!isClickInside && !searchInput.classList.contains('hidden')) {
                        searchInput.classList.add('hidden');
                        searchInput.classList.add('w-0');
                    }
                });
            }

            // --- Fungsi Dropdown Menu ---
            const dropdowns = document.querySelectorAll('[data-dropdown]');

            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');

                toggle.addEventListener('click', function(event) {
                    event.stopPropagation();

                    document.querySelectorAll('[data-dropdown]').forEach(otherDropdown => {
                        if (otherDropdown !== dropdown) {
                            otherDropdown.querySelector('.dropdown-menu').classList.add('hidden');
                        }
                    }); 

                    menu.classList.toggle('hidden');
                });
            });

            window.addEventListener('click', function() {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
            });
        });
    </script>

    @stack('scripts')

</body>

</html>