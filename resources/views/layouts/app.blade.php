<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BKPSDM Kabupaten Sorong Selatan')</title>
    <!-- Memuat Tailwind CSS melalui CDN untuk kemudahan styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk ikon-ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Menggunakan font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F3F4F6;
        }
        /* Custom styling for the dropdown to fix the hover issue */
        .nav-dropdown-menu {
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
            transform: translateY(-10px);
            opacity: 0;
            visibility: hidden;
        }
        .group:hover .nav-dropdown-menu {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body class="text-gray-800 antialiased">
    
    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('homepage') }}" class="flex items-center space-x-4">
                    {{-- Perbaikan: Ganti logo teks dengan gambar --}}
                    <img src="{{ asset('storage/logos/Logo_kabupaten_sorsel-removebg-preview.png') }}" alt="Logo BKPSDM" class="w-12 h-12">
                    <div class="hidden md:block">
                        <h1 class="text-xl font-bold text-gray-900">BKPSDM</h1>
                        <p class="text-sm text-gray-500">Kabupaten Sorong Selatan</p>
                    </div>
                </a>
                
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('homepage') }}" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium">Beranda</a>
                    <div class="relative group">
                        <button class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium flex items-center space-x-1 py-4">
                            <span>Tentang</span>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                        </button>
                        <div class="nav-dropdown-menu absolute w-48 bg-white shadow-lg rounded-xl py-2 z-50">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg mx-2 my-1">Profil BKPSDM</a>
                            <a href="{{ route('leaders.page') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg mx-2 my-1">Profil Pimpinan</a>
                        </div>
                    </div>
                    <a href="{{ route('pengumuman.index') }}" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium">Pengumuman</a>
                    <a href="{{ route('contact.page') }}" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium">Kontak</a>
                </nav>
                
                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <!-- Mobile Menu Sidebar -->
    <div id="mobileMenu" class="fixed top-0 right-0 w-64 bg-white h-full shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50 p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold">Menu Navigasi</h3>
            <button id="mobileMenuClose" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <nav class="flex flex-col space-y-4">
            <a href="{{ route('homepage') }}" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium border-b border-gray-200 pb-2">Beranda</a>
            <a href="{{ route('profile') }}" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium border-b border-gray-200 pb-2">Profil BKPSDM</a>
            <a href="{{ route('leaders.page') }}" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium border-b border-gray-200 pb-2">Profil Pimpinan</a>
            <a href="{{ route('pengumuman.index') }}" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium border-b border-gray-200 pb-2">Pengumuman</a>
            <a href="{{ route('contact.page') }}" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium border-b border-gray-200 pb-2">Kontak</a>
        </nav>
    </div>
    
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 mt-16 rounded-t-3xl">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand Section -->
                <div>
                    <div class="flex items-center space-x-4 mb-4">
                        {{-- Perbaikan: Ganti logo teks di footer dengan gambar --}}
                        <img src="{{ asset('storage/logos/Logo_kabupaten_sorsel-removebg-preview.png') }}" alt="Logo BKPSDM" class="w-12 h-12">
                        <div>
                            <h3 class="text-xl font-bold text-white">BKPSDM</h3>
                            <p class="text-sm text-gray-400">Kabupaten Sorong Selatan</p>
                        </div>
                    </div>
                    <p class="text-sm mb-4">Bidang Perencanaan BKPSDM Kabupaten Sorong Selatan berkomitmen memberikan pelayanan terbaik dalam bidang kepegawaian dan pengembangan SDM aparatur.</p>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-map-marker-alt text-blue-400"></i>
                            <span>{{ $settings['address'] ?? 'Jl. Keyen, Sorong Selatan' }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-phone text-blue-400"></i>
                            <span>{{ $settings['phone'] ?? '(0411) 872-123' }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope text-blue-400"></i>
                            <span>{{ $settings['email'] ?? 'info@bkpsdm.sorongselatan.go.id' }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Navigasi -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Navigasi</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('homepage') }}" class="hover:text-white transition duration-300">Beranda</a></li>
                        <li><a href="{{ route('profile') }}" class="hover:text-white transition duration-300">Profil BKPSDM</a></li>
                        <li><a href="{{ route('leaders.page') }}" class="hover:text-white transition duration-300">Profil Pimpinan</a></li>
                        <li><a href="{{ route('pengumuman.index') }}" class="hover:text-white transition duration-300">Pengumuman</a></li>
                        <li><a href="{{ route('contact.page') }}" class="hover:text-white transition duration-300">Kontak</a></li>
                    </ul>
                </div>
                
                <!-- Layanan & Tautan -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition duration-300">CPNS & PPPK</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Diklat</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Kenaikan Pangkat</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Mutasi Pegawai</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Pensiun</a></li>
                    </ul>
                    <h4 class="text-white font-semibold mt-6 mb-4">Tautan Penting</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="https://sorongselatankab.go.id/home" class="hover:text-white transition duration-300">Portal Sorong Selatan</a></li>
                    </ul>
                </div>
                
                <!-- Social & Newsletter -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4 mb-6">
                        <a href="#" class="bg-gray-800 text-gray-400 p-3 rounded-full hover:bg-blue-600 hover:text-white transition duration-300"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="bg-gray-800 text-gray-400 p-3 rounded-full hover:bg-blue-600 hover:text-white transition duration-300"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="bg-gray-800 text-gray-400 p-3 rounded-full hover:bg-blue-600 hover:text-white transition duration-300"><i class="fab fa-youtube"></i></a>
                    </div>
                    <h4 class="text-white font-semibold mb-4">Berlangganan Update</h4>
                    <form class="flex flex-col space-y-2">
                        <input type="email" placeholder="Masukkan email Anda" class="bg-gray-800 text-white rounded-lg px-4 py-2 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Berlangganan</button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-sm text-center md:text-left">
                <p>&copy; 2025 BKPSDM Kabupaten Sorong Selatan. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript untuk mobile menu -->
    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenuClose = document.getElementById('mobileMenuClose');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.remove('translate-x-full');
            mobileMenuOverlay.classList.remove('hidden');
        });

        mobileMenuClose.addEventListener('click', () => {
            mobileMenu.classList.add('translate-x-full');
            mobileMenuOverlay.classList.add('hidden');
        });

        mobileMenuOverlay.addEventListener('click', () => {
            mobileMenu.classList.add('translate-x-full');
            mobileMenuOverlay.classList.add('hidden');
        });
    </script>
</body>
</html>
