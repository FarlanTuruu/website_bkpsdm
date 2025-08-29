@extends('layouts.app')
@section('title', $announcement->title . ' - BKPSDM Sorong Selatan')
@section('content')
    <!-- Hero Section with Background -->
    <div class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full animate-pulse"></div>
            <div class="absolute top-40 right-20 w-20 h-20 bg-blue-300 rounded-full animate-bounce"></div>
            <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-indigo-300 rounded-full animate-ping"></div>
        </div>
        
        <div class="relative py-12 px-4 md:px-0">
            <div class="container mx-auto">
                <!-- Breadcrumb -->
                <div class="flex items-center text-sm text-blue-200 mb-8">
                    <a href="{{ route('homepage') }}" class="hover:text-white transition-colors duration-200 flex items-center space-x-1">
                        <i class="fas fa-home"></i>
                        <span>Beranda</span>
                    </a>
                    <i class="fas fa-chevron-right mx-3 text-xs"></i>
                    <a href="{{ route('pengumuman.index') }}" class="hover:text-white transition-colors duration-200 flex items-center space-x-1">
                        <i class="fas fa-bullhorn"></i>
                        <span>Pengumuman</span>
                    </a>
                    <i class="fas fa-chevron-right mx-3 text-xs"></i>
                    <span class="font-medium text-white line-clamp-1 flex items-center space-x-1">
                        <i class="fas fa-file-alt"></i>
                        <span>{{ $announcement->title }}</span>
                    </span>
                </div>
                
                <!-- Article Header -->
                <div class="text-center text-white">
                    <div class="inline-flex items-center space-x-2 bg-yellow-500/20 backdrop-blur-sm text-yellow-300 text-sm font-semibold px-6 py-2 rounded-full mb-6 border border-yellow-300/30">
                        <i class="fas fa-{{ $announcement->status === 'published' ? 'check-circle' : 'clock' }}"></i>
                        <span>{{ $announcement->status === 'published' ? 'Terbit' : 'Draf' }}</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight">
                        {{ $announcement->title }}
                    </h1>
                    
                    <div class="flex items-center justify-center space-x-6 text-blue-200">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar-alt text-yellow-300"></i>
                            <span>{{ \Carbon\Carbon::parse($announcement->publish_date)->translatedFormat('d F Y') }}</span>
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
            <!-- Main Article Card -->
            <article class="relative max-w-4xl mx-auto">
                <!-- Background decoration -->
                <div class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl opacity-10 blur-xl"></div>
                
                <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden">
                    <!-- Article Header Inside Card -->
                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-8 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-600 p-3 rounded-xl text-white">
                                    <i class="fas fa-newspaper text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">BKPSDM Kabupaten Sorong Selatan</h2>
                                </div>
                            </div>
                            
                            <!-- Share Button -->
                            <button onclick="shareArticle()" class="bg-white border border-gray-200 text-gray-600 px-4 py-2 rounded-full hover:bg-gray-50 hover:border-blue-300 hover:text-blue-600 transition duration-200 flex items-center space-x-2">
                                <i class="fas fa-share-alt"></i>
                                <span>Bagikan</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Featured Image -->
                    <div class="relative p-8 pb-0">
                        <div class="relative group overflow-hidden rounded-2xl shadow-lg">
                            <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="w-full h-80 object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                            <div class="absolute bottom-4 left-4 opacity-0 group-hover:opacity-100 transition duration-300">
                                <button onclick="openImageModal()" class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full hover:bg-white/30 transition duration-200 flex items-center space-x-2">
                                    <i class="fas fa-expand-alt"></i>
                                    <span>Lihat Gambar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Article Content -->
                    <div class="p-8">
                        <!-- Content with enhanced typography -->
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            <div class="content-wrapper">
                                {!! $announcement->content !!}
                            </div>
                        </div>
                        
                        <!-- Article Footer -->
                        <div class="mt-12 pt-8 border-t border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-blue-100 p-3 rounded-full">
                                        <i class="fas fa-building text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">BKPSDM Kabupaten Sorong Selatan</p>
                                    </div>
                                </div>
                                
                                <!-- Tags -->
                                <div class="flex items-center space-x-2">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">Pengumuman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            
            <!-- Action Buttons -->
            <div class="mt-12 flex flex-col sm:flex-row gap-4 justify-center max-w-4xl mx-auto">
                <a href="{{ route('pengumuman.index') }}" class="inline-flex items-center justify-center space-x-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-4 px-8 rounded-full shadow-xl hover:from-blue-700 hover:to-indigo-700 hover:scale-105 transition-all duration-300">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Daftar Pengumuman</span>
                </a>
            </div>
            
            <!-- Back to Top Button -->
            <div class="fixed bottom-8 right-8 z-50">
                <button onclick="scrollToTop()" class="bg-blue-600 text-white p-4 rounded-full shadow-xl hover:bg-blue-700 hover:scale-110 transition-all duration-300 opacity-0" id="backToTop">
                    <i class="fas fa-chevron-up text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="w-full h-auto rounded-2xl shadow-2xl">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white p-3 rounded-full hover:bg-white/30 transition duration-200">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Enhanced Styles -->
    <style>
        /* Enhanced prose styling */
        .content-wrapper h1, .content-wrapper h2, .content-wrapper h3 {
            color: #1f2937;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        
        .content-wrapper h1 {
            font-size: 2.25rem;
            line-height: 2.5rem;
        }
        
        .content-wrapper h2 {
            font-size: 1.875rem;
            line-height: 2.25rem;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 0.5rem;
        }
        
        .content-wrapper h3 {
            font-size: 1.5rem;
            line-height: 2rem;
            color: #3b82f6;
        }
        
        .content-wrapper p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
            text-align: justify;
        }
        
        .content-wrapper ul, .content-wrapper ol {
            margin: 1.5rem 0;
            padding-left: 2rem;
        }
        
        .content-wrapper li {
            margin-bottom: 0.5rem;
            line-height: 1.7;
        }
        
        .content-wrapper blockquote {
            border-left: 4px solid #3b82f6;
            background: #f8fafc;
            padding: 1rem 1.5rem;
            margin: 2rem 0;
            border-radius: 0 0.5rem 0.5rem 0;
            font-style: italic;
        }
        
        .content-wrapper table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
            background: white;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .content-wrapper th, .content-wrapper td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .content-wrapper th {
            background: #f9fafb;
            font-weight: 600;
            color: #374151;
        }

        /* Line clamp utility */
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Print styles */
        @media print {
            .no-print {
                display: none !important;
            }
            
            body {
                background: white !important;
            }
            
            .bg-gradient-to-br,
            .bg-gray-50 {
                background: white !important;
            }
        }
    </style>

    <!-- JavaScript -->
    <script>
        // Share functionality
        function shareArticle() {
            const title = "{{ $announcement->title }}";
            const url = window.location.href;
            
            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                });
            } else {
                // Fallback - copy to clipboard
                navigator.clipboard.writeText(url).then(() => {
                    showNotification('Link berhasil disalin!', 'success');
                });
            }
        }



        // Image modal functionality
        function openImageModal() {
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('imageModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Close modal on outside click
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        // Scroll to top functionality
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Show/hide back to top button
        window.addEventListener('scroll', function() {
            const backToTopBtn = document.getElementById('backToTop');
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.remove('opacity-0');
                backToTopBtn.classList.add('opacity-100');
            } else {
                backToTopBtn.classList.add('opacity-0');
                backToTopBtn.classList.remove('opacity-100');
            }
        });

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white font-medium transition-all duration-300 transform translate-x-full`;
            
            if (type === 'success') {
                notification.classList.add('bg-green-500');
            } else if (type === 'error') {
                notification.classList.add('bg-red-500');
            } else {
                notification.classList.add('bg-blue-500');
            }
            
            notification.innerHTML = `
                <div class="flex items-center space-x-2">
                    <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'}-circle"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Auto remove
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Reading progress indicator
        window.addEventListener('scroll', function() {
            const article = document.querySelector('article');
            const articleTop = article.offsetTop;
            const articleHeight = article.offsetHeight;
            const windowHeight = window.innerHeight;
            const scrollTop = window.pageYOffset;
            
            const progress = Math.min(
                Math.max((scrollTop - articleTop + windowHeight/2) / articleHeight, 0),
                1
            ) * 100;
            
            // You can use this progress value to show reading progress if needed
        });
    </script>
@endsection