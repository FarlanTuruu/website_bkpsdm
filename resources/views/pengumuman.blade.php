@extends('layouts.app')
@section('title', 'Pengumuman - BKPSDM Sorong Selatan')
@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full animate-pulse"></div>
            <div class="absolute top-40 right-20 w-20 h-20 bg-blue-300 rounded-full animate-bounce"></div>
            <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-indigo-300 rounded-full animate-ping"></div>
            <div class="absolute top-1/3 right-1/3 w-24 h-24 bg-yellow-300 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
        </div>
        
        <div class="relative py-16 px-4 md:px-0">
            <div class="container mx-auto text-white">
                <!-- Breadcrumb -->
                <div class="flex items-center text-sm text-blue-200 mb-8">
                    <a href="{{ route('homepage') }}" class="hover:text-white transition-colors duration-200 flex items-center space-x-1">
                        <i class="fas fa-home"></i>
                        <span>Beranda</span>
                    </a>
                    <i class="fas fa-chevron-right mx-3 text-xs"></i>
                    <span class="font-medium text-white flex items-center space-x-1">
                        <i class="fas fa-bullhorn"></i>
                        <span>Pengumuman</span>
                    </span>
                </div>
                
                <div class="text-center">
                    <div class="inline-flex items-center space-x-2 bg-yellow-500/20 backdrop-blur-sm text-yellow-300 text-sm font-semibold px-6 py-3 rounded-full mb-6 border border-yellow-300/30">
                        <i class="fas fa-archive"></i>
                        <span>Arsip</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                        Pengumuman <span class="text-yellow-300">Terkini</span>
                    </h1>
                    <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                        Dapatkan informasi terbaru seputar kebijakan, pengumuman, dan kegiatan kepegawaian.
                    </p>
                    
                    <!-- Statistics -->
                    <div class="flex justify-center mt-8 space-x-8">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-yellow-300">{{ $announcements->total() }}</div>
                            <div class="text-sm text-blue-200">Total Pengumuman</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Wave separator -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden">
            <svg class="relative block w-full h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="fill-gray-50"></path>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-gray-50 py-16 px-4 md:px-0">
        <div class="container mx-auto">            
            <!-- Announcements Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($announcements as $announcement)
                    <article class="group bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 hover:-translate-y-2 transition-all duration-500 border border-gray-200">
                        <!-- Image Container -->
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                            
                            <!-- Status Badges -->
                            <div class="absolute top-4 left-4 flex flex-col space-y-2">
                                <span class="inline-flex items-center space-x-1 bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                                    <i class="fas fa-{{ $announcement->status === 'published' ? 'check-circle' : 'clock' }}"></i>
                                    <span>{{ $announcement->status === 'published' ? 'Terbit' : 'Draf' }}</span>
                                </span>
                                <span class="inline-flex items-center space-x-1 bg-blue-100 text-blue-600 text-xs font-medium px-3 py-1 rounded-full shadow-sm">
                                    <i class="fas fa-bullhorn"></i>
                                    <span>Pengumuman</span>
                                </span>
                            </div>

                            <!-- Quick Action Button -->
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition duration-300">
                                <a href="{{ route('pengumuman.show', $announcement->slug) }}" class="bg-white/20 backdrop-blur-sm p-2 rounded-full text-white hover:bg-white/30 transition duration-200">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6">
                            <a href="{{ route('pengumuman.show', $announcement->slug) }}" class="block group-hover:text-blue-600 transition duration-300">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight">
                                    {{ $announcement->title }}
                                </h3>
                            </a>
                            
                            <!-- Date and Meta Info -->
                            <div class="flex items-center space-x-4 mb-4 text-sm text-gray-500">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-calendar-alt text-blue-600"></i>
                                    <span>{{ \Carbon\Carbon::parse($announcement->publish_date)->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                            
                            <!-- Content Preview -->
                            <p class="text-gray-600 text-base line-clamp-3 mb-6 leading-relaxed">
                                {{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 150) }}
                            </p>
                            
                            <!-- Action Button -->
                            <div class="flex items-center justify-between">
                                <a href="{{ route('pengumuman.show', $announcement->slug) }}" class="inline-flex items-center space-x-2 text-blue-600 font-semibold hover:text-blue-800 transition duration-300 group">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-200"></i>
                                </a>
                                
                                <!-- Share Button -->
                                <button class="text-gray-400 hover:text-blue-600 transition duration-200" onclick="shareAnnouncement('{{ $announcement->title }}', '{{ route('pengumuman.show', $announcement->slug) }}')">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Bottom accent -->
                        <div class="h-1 bg-gradient-to-r from-blue-600 to-indigo-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                    </article>
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full">
                        <div class="bg-white rounded-2xl shadow-lg p-12 text-center border-2 border-dashed border-gray-200">
                            <div class="text-gray-400 mb-6">
                                <i class="fas fa-inbox text-6xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Pengumuman</h3>
                            <p class="text-gray-600 text-lg mb-8">Pengumuman terbaru akan muncul di sini. Silakan kembali lagi nanti untuk informasi terkini.</p>
                            <a href="{{ route('homepage') }}" class="inline-flex items-center space-x-2 bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-200">
                                <i class="fas fa-home"></i>
                                <span>Kembali ke Beranda</span>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if($announcements->hasPages())
                <div class="mt-12">
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-center justify-center">
                            {{ $announcements->links() }}
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Back to Top Button -->
            <div class="fixed bottom-8 right-8 z-50">
                <button onclick="scrollToTop()" class="bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 hover:scale-110 transition-all duration-300">
                    <i class="fas fa-chevron-up text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        /* Line clamp for text truncation */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Custom pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            space-x: 2;
        }

        .pagination a, .pagination span {
            padding: 0.75rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.75rem;
            transition: all 0.2s;
            font-weight: 500;
        }

        .pagination a {
            background: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .pagination a:hover {
            background: #3b82f6;
            color: white;
            transform: scale(1.05);
        }

        .pagination .active span {
            background: #3b82f6;
            color: white;
            border: 1px solid #3b82f6;
        }

        /* Smooth animations */
        * {
            scroll-behavior: smooth;
        }
    </style>

    <!-- JavaScript -->
    <script>
        // Share functionality
        function shareAnnouncement(title, url) {
            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                });
            } else {
                // Fallback - copy to clipboard
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link berhasil disalin!');
                });
            }
        }

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

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp');
                }
            });
        }, observerOptions);

        // Observe all announcement cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('article');
            cards.forEach(card => {
                observer.observe(card);
            });
        });
    </script>

    <!-- Add fadeInUp animation -->
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
@endsection