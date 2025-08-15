@extends('layouts.app')

@section('title', 'Beranda - BKPSDM Kabupaten Sorong Selatan')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-blue-600 text-white py-20 px-4 md:px-0 overflow-hidden min-h-[500px] md:min-h-[75vh] flex items-center">
        {{-- Area Slideshow Gambar --}}
        <div id="hero-slideshow" class="absolute inset-0 z-0">
            @php
                $heroImages = $settings['hero_background_images'] ?? [];
            @endphp
            @forelse($heroImages as $index => $image)
                <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out" style="background-image: url('{{ asset('storage/' . $image) }}'); opacity: {{ $index == 0 ? 1 : 0 }};"></div>
            @empty
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://placehold.co/1920x1080/2563EB/ffffff');"></div>
            @endforelse
        </div>
        
        {{-- Overlay untuk membuat teks lebih jelas --}}
        <div class="absolute inset-0 bg-black opacity-50 z-10"></div>
        
        {{-- Konten Teks Hero Section --}}
        <div class="relative container mx-auto z-20 flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <span class="bg-white bg-opacity-20 text-sm font-semibold py-2 px-4 rounded-full mb-4 inline-block">Pemerintah Sorong Selatan</span>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4">BKPSDM <span class="text-yellow-300">Kabupaten Sorong Selatan</span></h1>
                <p class="text-lg mb-6 max-w-lg">
                    Bidang Perencanaan Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kabupaten Sorong Selatan berkomitmen memberikan pelayanan terbaik dalam bidang kepegawaian dan pengembangan SDM aparatur.
                </p>
                <div class="flex space-x-4">
                    <a href="{{ route('contact.page') }}" class="bg-white text-blue-600 font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300">Hubungi Kami</a>
                    <a href="{{ route('pengumuman.index') }}" class="bg-transparent border-2 border-white text-white font-bold py-3 px-6 rounded-lg hover:bg-white hover:text-blue-600 transition duration-300">Lihat Pengumuman</a>
                </div>
            </div>
            <div class="md:w-1/2 relative flex justify-center md:justify-end">
                <img src="https://placehold.co/600x400/2563EB/ffffff" alt="Kantor BKPSDM" class="rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-500">
            </div>
        </div>
    </section>

    <!-- Announcements Section -->
    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-4 py-1.5 rounded-full">Terbaru</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-2">Pengumuman & Berita</h2>
                <p class="text-lg text-gray-600">Dapatkan informasi terkini seputar kebijakan, pengumuman, dan kegiatan kepegawaian.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($announcements as $announcement)
                    {{-- Perbaikan: Latar belakang kartu dibuat semi-transparan --}}
                    <div class="bg-white bg-opacity-70 rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition duration-500">
                        <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center space-x-2 mb-3">
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $announcement->status === 'published' ? 'Terbit' : 'Draf' }}</span>
                                <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-0.5 rounded-full">Pengumuman</span>
                            </div>
                            <a href="{{ route('pengumuman.show', $announcement->slug) }}" class="block">
                                <h3 class="text-xl font-bold text-gray-900 hover:text-blue-600 transition duration-300 mb-2">{{ $announcement->title }}</h3>
                            </a>
                            <p class="text-gray-500 text-sm mb-4">{{ \Carbon\Carbon::parse($announcement->publish_date)->translatedFormat('d F Y') }}</p>
                            <p class="text-gray-600 text-base line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 150) }}</p>
                            <div class="mt-4">
                                <a href="{{ route('pengumuman.show', $announcement->slug) }}" class="text-blue-600 font-semibold flex items-center space-x-2 hover:underline transition duration-300">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Perbaikan: Latar belakang div kosong juga dibuat semi-transparan --}}
                    <div class="col-span-full bg-white bg-opacity-70 rounded-lg shadow-md p-6 text-center">
                        <p class="text-gray-500">Belum ada pengumuman yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('pengumuman.index') }}" class="inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-blue-700 transition duration-300">Lihat Semua Pengumuman</a>
            </div>
        </div>
    </section>

    <script>
        // JavaScript untuk slideshow gambar latar belakang
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('#hero-slideshow > div');
            if (slides.length > 1) {
                let currentSlide = 0;
                setInterval(() => {
                    slides[currentSlide].style.opacity = '0';
                    currentSlide = (currentSlide + 1) % slides.length;
                    slides[currentSlide].style.opacity = '1';
                }, 5000); // Ganti gambar setiap 5 detik
            }
        });
    </script>
@endsection
