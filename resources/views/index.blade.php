@extends('layouts.app')

@section('title', 'Beranda - BKPSDM Kabupaten Sorong Selatan')

@section('content')
    <!-- Hero Section with Full Background -->
    <section class="relative text-white pt-0 pb-20 px-4 md:px-0 overflow-hidden min-h-screen flex items-center" style="margin-top: -8rem;">
        {{-- Area Gambar Dinamis dari Database - Full Background --}}
        {{-- Area Slideshow Gambar --}}
        <div id="hero-slideshow" class="absolute inset-0 z-0">
            @php
                $heroImages = $settings['hero_background_images'] ?? [];
            @endphp
            @forelse($heroImages as $index => $image)
                <div class="absolute inset-0 bg-no-repeat bg-center transition-opacity duration-1000 ease-in-out"
                    style="background-image: url('{{ asset('storage/' . $image) }}'); background-size: contain; background-repeat: no-repeat; background-position: center; opacity: {{ $index == 0 ? 1 : 0 }};">
                </div>


            @empty
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://placehold.co/1920x1080/2563EB/ffffff');"></div>
            @endforelse
        </div>

        {{-- Animated Background Elements untuk efek visual --}}
        <div class="fixed inset-0 z-20 opacity-20 pointer-events-none">
            <div class="absolute top-20 left-20 w-32 h-32 bg-white rounded-full animate-pulse"></div>
            <div class="absolute top-40 right-20 w-20 h-20 bg-blue-300 rounded-full animate-bounce" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-40 left-1/4 w-16 h-16 bg-indigo-300 rounded-full animate-ping" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/3 right-1/3 w-24 h-24 bg-yellow-300 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-20 right-20 w-12 h-12 bg-purple-300 rounded-full animate-bounce" style="animation-delay: 1.5s;"></div>
        </div>

        {{-- Overlay tambahan untuk kontras teks yang lebih baik --}}
        <div class="absolute inset-0 bg-black/30 z-30"></div>

        {{-- Konten Teks Hero Section --}}
        <div class="relative container mx-auto z-40 flex flex-col md:flex-row items-center justify-between" style="padding-top: 8rem;">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <div class="mb-6">
                    <span class="bg-white/20 backdrop-blur-sm text-sm font-semibold py-3 px-6 rounded-full mb-4 inline-flex items-center space-x-2 shadow-lg">
                        <i class="fas fa-building text-yellow-300"></i>
                        <span>Pemerintah Sorong Selatan</span>
                    </span>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6 drop-shadow-lg">
                    BKPSDM 
                    <span class="text-yellow-300 animate-pulse">Kabupaten Sorong Selatan</span>
                </h1>
                
                <p class="text-lg md:text-xl mb-8 max-w-lg leading-relaxed text-gray-100 drop-shadow-md">
                    Bidang Perencanaan Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kabupaten Sorong Selatan berkomitmen memberikan pelayanan terbaik dalam bidang kepegawaian dan pengembangan SDM aparatur.
                </p>
                
                <!-- <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('contact.page') }}" class="bg-white text-blue-600 font-bold py-4 px-8 rounded-full shadow-xl hover:bg-gray-100 hover:scale-105 transition-all duration-300 text-center inline-flex items-center justify-center space-x-2">
                        <i class="fas fa-phone"></i>
                        <span>Hubungi Kami</span>
                    </a>
                    <a href="{{ route('pengumuman.index') }}" class="bg-transparent border-2 border-white/80 backdrop-blur-sm text-white font-bold py-4 px-8 rounded-full hover:bg-white hover:text-blue-600 hover:scale-105 transition-all duration-300 text-center inline-flex items-center justify-center space-x-2">
                        <i class="fas fa-bullhorn"></i>
                        <span>Lihat Pengumuman</span>
                    </a>
                </div> -->
                
                <!-- Statistics Section -->
                
            </div>
            
            
        </div>
    </section>

    <!-- Announcements Section dengan background transparan -->
    <section class="py-16 relative z-10 bg-white/95 backdrop-blur-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div class="inline-flex items-center space-x-2 bg-yellow-100 text-yellow-800 text-sm font-medium px-6 py-2 rounded-full mb-4">
                    <i class="fas fa-newspaper"></i>
                    <span>Terbaru</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-4 text-gray-900">Pengumuman & Berita</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 mx-auto rounded-full mb-4"></div>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Dapatkan informasi terkini seputar kebijakan, pengumuman, dan kegiatan kepegawaian.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($announcements as $announcement)
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 hover:-translate-y-2 transition-all duration-500 border border-gray-200/50">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="w-full h-48 object-cover">
                            <div class="absolute top-4 left-4 flex space-x-2">
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-1 rounded-full shadow-sm">
                                    {{ $announcement->status === 'published' ? 'Terbit' : 'Draf' }}
                                </span>
                                <span class="bg-blue-100 text-blue-600 text-xs font-medium px-2.5 py-1 rounded-full shadow-sm">
                                    <i class="fas fa-bullhorn mr-1"></i>Pengumuman
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <a href="{{ route('pengumuman.show', $announcement->slug) }}" class="block group">
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition duration-300 mb-3 line-clamp-2">
                                    {{ $announcement->title }}
                                </h3>
                            </a>
                            
                            <div class="flex items-center space-x-2 mb-4 text-sm text-gray-500">
                                <i class="fas fa-calendar-alt text-blue-600"></i>
                                <span>{{ \Carbon\Carbon::parse($announcement->publish_date)->translatedFormat('d F Y') }}</span>
                            </div>
                            
                            <p class="text-gray-600 text-base line-clamp-3 mb-4">
                                {{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 150) }}
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <a href="{{ route('pengumuman.show', $announcement->slug) }}" class="text-blue-600 font-semibold flex items-center space-x-2 hover:text-blue-800 transition duration-300 group">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-200"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-8 text-center border border-gray-200/50">
                        <div class="text-gray-400 mb-4">
                            <i class="fas fa-inbox text-4xl"></i>
                        </div>
                        <p class="text-gray-500 text-lg font-medium">Belum ada pengumuman yang tersedia.</p>
                        <p class="text-gray-400 text-sm mt-2">Silakan kembali lagi nanti untuk informasi terbaru.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('pengumuman.index') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-4 px-8 rounded-full shadow-xl hover:from-blue-700 hover:to-indigo-700 hover:scale-105 transition-all duration-300">
                    <i class="fas fa-list-ul"></i>
                    <span>Lihat Semua Pengumuman</span>
                </a>
            </div>
        </div>

        
    </section>
    <!-- Back to Top Button -->
            <div class="fixed bottom-8 right-8 z-50">
                <button onclick="scrollToTop()" class="bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 hover:scale-110 transition-all duration-300">
                    <i class="fas fa-chevron-up text-lg"></i>
                </button>
            </div>

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

        // Parallax effect untuk background
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const background = document.querySelector('.fixed.inset-0');
            if (background) {
                background.style.transform = 'translateY(' + (scrolled * 0.3) + 'px)';
            }
        });

        // Scroll to top functionality
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Show/hide back to top button based on scroll
        window.addEventListener('scroll', function() {
            const backToTopBtn = document.querySelector('.fixed.bottom-8.right-8');
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.remove('opacity-0');
                backToTopBtn.classList.add('opacity-100');
            } else {
                backToTopBtn.classList.add('opacity-0');
                backToTopBtn.classList.remove('opacity-100');
            }
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        
    </script>
    
@endsection