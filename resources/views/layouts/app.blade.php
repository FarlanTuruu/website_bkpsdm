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
        :root {
            --primary-gradient: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            --secondary-gradient: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            --accent-gradient: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        /* Enhanced Header Styling */
        .header-enhanced {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .header-enhanced:hover {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Logo Animation */
        .logo-container {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .logo-container:hover {
            transform: scale(1.02);
        }

        .logo-container img {
            transition: all 0.3s ease;
            filter: drop-shadow(0 4px 8px rgba(59, 130, 246, 0.2));
        }

        .logo-container:hover img {
            filter: drop-shadow(0 6px 12px rgba(59, 130, 246, 0.3));
            transform: rotate(5deg);
        }

        /* Enhanced Navigation */
        .nav-link {
            position: relative;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--primary-gradient);
            border-radius: 0.75rem;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: -1;
        }

        .nav-link:hover::before {
            opacity: 0.1;
            transform: scale(1);
        }

        .nav-link:hover {
            color: #1d4ed8 !important;
            transform: translateY(-2px);
        }

        /* Enhanced Dropdown */
        .nav-dropdown-menu {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(-20px);
            opacity: 0;
            visibility: hidden;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .group:hover .nav-dropdown-menu {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }

        .nav-dropdown-menu a {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-dropdown-menu a::before {
            content: '';
            position: absolute;
            left: 8px;
            right: 8px;
            top: 0;
            bottom: 0;
            background: var(--primary-gradient);
            border-radius: 0.5rem;
            opacity: 0;
            transform: scale(0.95);
            transition: all 0.3s ease;
            z-index: -1;
        }

        .nav-dropdown-menu a:hover::before {
            opacity: 0.1;
            transform: scale(1);
        }

        .nav-dropdown-menu a:hover {
            color: #1d4ed8 !important;
            transform: translateX(4px);
        }

        /* Dropdown Chevron Animation */
        .dropdown-chevron {
            transition: all 0.3s ease;
        }

        .group:hover .dropdown-chevron {
            transform: rotate(180deg);
            color: #1d4ed8;
        }

        /* Mobile Menu Button Enhancement */
        .mobile-menu-btn {
            position: relative;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 1px solid rgba(226, 232, 240, 0.6);
            transition: all 0.3s ease;
        }

        .mobile-menu-btn:hover {
            background: var(--primary-gradient);
            color: white;
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.2);
        }

        /* Enhanced Mobile Menu */
        .mobile-menu-enhanced {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-left: 1px solid var(--glass-border);
        }

        .mobile-menu-link {
            position: relative;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        }

        .mobile-menu-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary-gradient);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .mobile-menu-link:hover::before {
            opacity: 1;
        }

        .mobile-menu-link:hover {
            color: #1d4ed8 !important;
            background: rgba(59, 130, 246, 0.05);
            transform: translateX(8px);
        }

        /* Enhanced Footer */
        .footer-enhanced {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            position: relative;
        }

        .footer-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, var(--primary-gradient) 50%, transparent 100%);
        }

        /* Footer Section Hover Effects */
        .footer-section {
            transition: all 0.3s ease;
        }

        .footer-section:hover {
            transform: translateY(-4px);
        }

        .footer-section h3,
        .footer-section h4 {
            position: relative;
        }

        .footer-section h3::after,
        .footer-section h4::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--primary-gradient);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .footer-section:hover h3::after,
        .footer-section:hover h4::after {
            opacity: 1;
            width: 60px;
        }

        /* Enhanced Footer Links */
        .footer-link {
            position: relative;
            transition: all 0.3s ease;
            padding: 0.25rem 0;
        }

        .footer-link::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 50%;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .footer-link:hover::before {
            opacity: 1;
        }

        .footer-link:hover {
            color: white !important;
            transform: translateX(8px);
        }

        /* Enhanced Social Media Icons */
        .social-icon {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .social-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .social-icon:hover::before {
            left: 100%;
        }

        .social-icon:hover {
            background: var(--primary-gradient);
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
        }

        /* Enhanced Form Elements */
        .newsletter-input {
            background: rgba(55, 65, 81, 0.8);
            border: 1px solid rgba(107, 114, 128, 0.6);
            transition: all 0.3s ease;
        }

        .newsletter-input:focus {
            background: rgba(55, 65, 81, 1);
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .newsletter-btn {
            background: var(--primary-gradient);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .newsletter-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .newsletter-btn:hover::before {
            left: 100%;
        }

        .newsletter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
        }

        /* Page Loading Animation */
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

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Contact Info Enhancement */
        .contact-info {
            transition: all 0.3s ease;
        }

        .contact-info:hover {
            color: #3b82f6 !important;
            transform: translateX(4px);
        }

        .contact-info i {
            transition: all 0.3s ease;
        }

        .contact-info:hover i {
            color: #3b82f6 !important;
            transform: scale(1.1);
        }
    </style>
</head>
<body class="text-gray-800 antialiased">
    
    <!-- Header -->
<header id="pageHeader" class="header-enhanced sticky top-0 z-50 transform -translate-y-full opacity-0 invisible pointer-events-none transition-all duration-500">


        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('homepage') }}" class="logo-container flex items-center space-x-4">
                    {{-- Perbaikan: Ganti logo teks dengan gambar --}}
                    <img src="{{ asset('storage/logos/Logo_kabupaten_sorsel-removebg-preview.png') }}" alt="Logo BKPSDM" class="w-12 h-12">
                    <img src="{{ asset('storage/logos/Logo_kabupaten_sorsel-removebg-preview.png') }}" alt="Logo BKPSDM" class="w-12 h-12">
                    <div class="hidden md:block">
                        <h1 class="text-xl font-bold text-gray-900">BKPSDM</h1>
                        <p class="text-sm text-gray-500">Kabupaten Sorong Selatan</p>
                    </div>
                </a>
                
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-2">
                    <a href="{{ route('homepage') }}" class="nav-link text-gray-600 hover:text-blue-600 transition duration-300 font-medium">Beranda</a>
                    <div class="relative group">
                        <button class="nav-link text-gray-600 hover:text-blue-600 transition duration-300 font-medium flex items-center space-x-1">
                            <span>Tentang</span>
                            <i class="fas fa-chevron-down text-xs dropdown-chevron"></i>
                        </button>
                        <div class="nav-dropdown-menu absolute w-48 shadow-lg rounded-xl py-2 z-50 mt-2">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg mx-2 my-1">Profil BKPSDM</a>
                            <a href="{{ route('leaders.page') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg mx-2 my-1">Profil Pimpinan</a>
                        </div>
                    </div>
                    <a href="{{ route('pengumuman.index') }}" class="nav-link text-gray-600 hover:text-blue-600 transition duration-300 font-medium">Pengumuman</a>
                    <a href="{{ route('contact.page') }}" class="nav-link text-gray-600 hover:text-blue-600 transition duration-300 font-medium">Kontak</a>
                </nav>
                
                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="mobile-menu-btn md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <!-- Mobile Menu Sidebar -->
    <div id="mobileMenu" class="mobile-menu-enhanced fixed top-0 right-0 w-64 h-full shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50 p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold">Menu Navigasi</h3>
            <button id="mobileMenuClose" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <nav class="flex flex-col space-y-1">
            <a href="{{ route('homepage') }}" class="mobile-menu-link text-gray-600 hover:text-blue-600 transition duration-300 font-medium pb-2">Beranda</a>
            <a href="{{ route('profile') }}" class="mobile-menu-link text-gray-600 hover:text-blue-600 transition duration-300 font-medium pb-2">Profil BKPSDM</a>
            <a href="{{ route('leaders.page') }}" class="mobile-menu-link text-gray-600 hover:text-blue-600 transition duration-300 font-medium pb-2">Profil Pimpinan</a>
            <a href="{{ route('pengumuman.index') }}" class="mobile-menu-link text-gray-600 hover:text-blue-600 transition duration-300 font-medium pb-2">Pengumuman</a>
            <a href="{{ route('contact.page') }}" class="mobile-menu-link text-gray-600 hover:text-blue-600 transition duration-300 font-medium pb-2">Kontak</a>
        </nav>
    </div>
    
    <main class="min-h-screen animate-fade-in-up">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="footer-enhanced text-gray-300 py-12 mt-16 rounded-t-3xl">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand Section -->
                <div class="footer-section">
                    <div class="flex items-center space-x-4 mb-4">
                        {{-- Perbaikan: Ganti logo teks di footer dengan gambar --}}
                        <img src="{{ asset('storage/logos/Logo_kabupaten_sorsel-removebg-preview.png') }}" alt="Logo BKPSDM" class="w-12 h-12">
                        <img src="{{ asset('storage/logos/Logo_kabupaten_sorsel-removebg-preview.png') }}" alt="Logo BKPSDM" class="w-12 h-12">
                        <div>
                            <h3 class="text-xl font-bold text-white">BKPSDM</h3>
                            <p class="text-sm text-gray-400">Kabupaten Sorong Selatan</p>
                        </div>
                    </div>
                    <p class="text-sm mb-4">Bidang Perencanaan BKPSDM Kabupaten Sorong Selatan berkomitmen memberikan pelayanan terbaik dalam bidang kepegawaian dan pengembangan SDM aparatur.</p>
                    <div class="space-y-2 text-sm">
                        <div class="contact-info flex items-center space-x-2">
                            <i class="fas fa-map-marker-alt text-blue-400"></i>
                            <span>{{ $settings['address'] ?? 'Jl. Keyen, Sorong Selatan' }}</span>
                        </div>
                        <div class="contact-info flex items-center space-x-2">
                            <i class="fas fa-phone text-blue-400"></i>
                            <span>{{ $settings['phone'] ?? '(0411) 872-123' }}</span>
                        </div>
                        <div class="contact-info flex items-center space-x-2">
                            <i class="fas fa-envelope text-blue-400"></i>
                            <span>{{ $settings['email'] ?? 'info@bkpsdm.sorongselatan.go.id' }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Navigasi -->
                <div class="footer-section">
                    <h4 class="text-white font-semibold mb-4">Navigasi</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('homepage') }}" class="footer-link hover:text-white transition duration-300">Beranda</a></li>
                        <li><a href="{{ route('profile') }}" class="footer-link hover:text-white transition duration-300">Profil BKPSDM</a></li>
                        <li><a href="{{ route('leaders.page') }}" class="footer-link hover:text-white transition duration-300">Profil Pimpinan</a></li>
                        <li><a href="{{ route('pengumuman.index') }}" class="footer-link hover:text-white transition duration-300">Pengumuman</a></li>
                        <li><a href="{{ route('contact.page') }}" class="footer-link hover:text-white transition duration-300">Kontak</a></li>
                    </ul>
                </div>
                
                <!-- Layanan & Tautan -->
                <div class="footer-section">
                    <h4 class="text-white font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="footer-link hover:text-white transition duration-300">CPNS & PPPK</a></li>
                        <li><a href="#" class="footer-link hover:text-white transition duration-300">Diklat</a></li>
                        <li><a href="#" class="footer-link hover:text-white transition duration-300">Kenaikan Pangkat</a></li>
                        <li><a href="#" class="footer-link hover:text-white transition duration-300">Mutasi Pegawai</a></li>
                        <li><a href="#" class="footer-link hover:text-white transition duration-300">Pensiun</a></li>
                    </ul>
                    <h4 class="text-white font-semibold mt-6 mb-4">Tautan Penting</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="https://sorongselatankab.go.id/home" class="footer-link hover:text-white transition duration-300">Portal Sorong Selatan</a></li>
                    </ul>
                </div>
                
                <!-- Social & Newsletter -->
                <div class="footer-section">
                    <h4 class="text-white font-semibold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4 mb-6">
                        <a href="#" class="social-icon text-gray-400 p-3 rounded-full hover:bg-blue-600 hover:text-white transition duration-300"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon text-gray-400 p-3 rounded-full hover:bg-blue-600 hover:text-white transition duration-300"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon text-gray-400 p-3 rounded-full hover:bg-blue-600 hover:text-white transition duration-300"><i class="fab fa-youtube"></i></a>
                    </div>
                    <h4 class="text-white font-semibold mb-4">Berlangganan Update</h4>
                    <form class="flex flex-col space-y-2">
                        <input type="email" placeholder="Masukkan email Anda" class="newsletter-input text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <button type="submit" class="newsletter-btn text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Berlangganan</button>
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

        const header = document.getElementById('pageHeader');;

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

        // Add scroll effect to header
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header-enhanced');
            if (window.scrollY > 10) {
                header.style.transform = 'translateY(0)';
                header.style.boxShadow = '0 8px 32px rgba(0, 0, 0, 0.12)';
            } else {
                header.style.boxShadow = '0 4px 24px rgba(0, 0, 0, 0.06)';
            }
        });

        //tambahan
window.addEventListener('scroll', () => {
        if (window.scrollY > 10) {
            header.classList.remove('-translate-y-full', 'opacity-0', 'invisible', 'pointer-events-none');
            header.classList.add('translate-y-0', 'opacity-100');
        } else {
            header.classList.remove('translate-y-0', 'opacity-100');
            header.classList.add('-translate-y-full', 'opacity-0', 'invisible', 'pointer-events-none');
        }
    });
    </script>
</body>
</html>