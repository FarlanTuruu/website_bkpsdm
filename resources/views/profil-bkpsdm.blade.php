@extends('layouts.app')

@section('title', 'Profil BKPSDM - BKPSDM Kabupaten Sorong Selatan')

@section('content')
<style>
    /* Page Background Enhancement */
    .profile-page {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        position: relative;
        min-height: 100vh;
    }

    .profile-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 400px;
        background: radial-gradient(ellipse at top, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
        pointer-events: none;
        z-index: 1;
    }

    .profile-container {
        position: relative;
        z-index: 10;
    }

    /* Enhanced Breadcrumb */
    .breadcrumb {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(226, 232, 240, 0.5);
        border-radius: 16px;
        padding: 16px 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 24px;
        transition: all 0.3s ease;
    }

    .breadcrumb:hover {
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .breadcrumb-item {
        position: relative;
        transition: all 0.3s ease;
    }

    .breadcrumb-item:hover {
        color: #3b82f6 !important;
        transform: translateX(2px);
    }

    .breadcrumb-separator {
        color: #cbd5e1;
        transition: color 0.3s ease;
    }

    .breadcrumb:hover .breadcrumb-separator {
        color: #3b82f6;
    }

    /* Enhanced Page Header */
    .page-header {
        text-align: center;
        margin-bottom: 48px;
        position: relative;
    }

    .page-badge {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
        border: 1px solid rgba(59, 130, 246, 0.3);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        transition: all 0.3s ease;
        display: inline-block;
        padding: 8px 24px;
        border-radius: 9999px;
        font-weight: 500;
    }

    .page-badge:hover {
        background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 100%);
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
    }

    .page-title {
        background: linear-gradient(135deg, #1f2937 0%, #3b82f6 50%, #1f2937 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
        margin: 24px 0 16px 0;
        animation: titleSlideIn 0.8s ease-out;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        border-radius: 2px;
        animation: underlineExpand 1s ease-out 0.5s both;
    }

    @keyframes titleSlideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes underlineExpand {
        from {
            width: 0;
        }
        to {
            width: 100px;
        }
    }

    .page-description {
        color: #64748b;
        line-height: 1.7;
        max-width: 48rem;
        margin: 0 auto;
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Enhanced Content Cards */
    .content-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.5);
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        margin-bottom: 32px;
        opacity: 0;
        transform: translateY(30px);
        animation: cardSlideIn 0.6s ease-out forwards;
    }

    .content-card:nth-child(1) { animation-delay: 0.1s; }
    .content-card:nth-child(2) { animation-delay: 0.2s; }
    .content-card:nth-child(3) { animation-delay: 0.3s; }
    .content-card:nth-child(4) { animation-delay: 0.4s; }
    .content-card:nth-child(5) { animation-delay: 0.5s; }

    @keyframes cardSlideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .content-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .content-card:hover::before {
        opacity: 1;
    }

    .content-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.05) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .content-card:hover::after {
        opacity: 1;
    }

    .content-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        background: rgba(255, 255, 255, 0.95);
        border-color: rgba(59, 130, 246, 0.3);
    }

    /* Enhanced Icon Containers */
    .icon-container {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        font-size: 24px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        border: 2px solid rgba(59, 130, 246, 0.2);
        margin-bottom: 20px;
    }

    .icon-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }

    .content-card:hover .icon-container {
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        color: white;
        transform: scale(1.1) rotate(5deg);
        border-color: rgba(139, 92, 246, 0.5);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    .content-card:hover .icon-container::before {
        left: 100%;
    }

    /* Enhanced Typography */
    .card-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 16px 0;
        position: relative;
        transition: color 0.3s ease;
    }

    .content-card:hover .card-title {
        color: #2563eb;
    }

    .card-content {
        color: #4b5563;
        line-height: 1.7;
        transition: color 0.3s ease;
    }

    .content-card:hover .card-content {
        color: #374151;
    }

    /* Enhanced Profile Image */
    .profile-image-container {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 24px;
    }

    .profile-image-container:hover {
        transform: scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .profile-image {
        width: 100%;
        height: auto;
        object-fit: cover;
        max-height: 500px;
        transition: all 0.3s ease;
    }

    .profile-image-container:hover .profile-image {
        filter: brightness(1.05) saturate(1.1);
    }

    .profile-image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.3));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .profile-image-container:hover .profile-image-overlay {
        opacity: 1;
    }

    /* Enhanced Lists */
    .enhanced-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .enhanced-list li {
        position: relative;
        padding: 12px 0 12px 32px;
        margin: 8px 0;
        transition: all 0.3s ease;
        border-radius: 8px;
    }

    .enhanced-list li::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 50%;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .enhanced-list.decimal li::before {
        content: counter(item);
        counter-increment: item;
        width: 24px;
        height: 24px;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #2563eb;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
        border: 2px solid rgba(59, 130, 246, 0.3);
    }

    .enhanced-list.decimal {
        counter-reset: item;
    }

    .enhanced-list li:hover {
        background: rgba(59, 130, 246, 0.05);
        color: #2563eb;
        transform: translateX(4px);
    }

    .enhanced-list li:hover::before {
        transform: translateY(-50%) scale(1.2);
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
    }

    .enhanced-list.decimal li:hover::before {
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        color: white;
        border-color: rgba(139, 92, 246, 0.5);
    }

    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .content-card {
            padding: 24px 20px;
            border-radius: 20px;
        }

        .icon-container {
            width: 48px;
            height: 48px;
            font-size: 20px;
            border-radius: 16px;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .page-title {
            font-size: 2rem;
        }
    }

    /* Scroll Animation Trigger */
    .scroll-reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease-out;
    }

    .scroll-reveal.revealed {
        opacity: 1;
        transform: translateY(0);
    }
</style>

    <div class="profile-page py-10 px-4 md:px-0">
        <div class="profile-container container mx-auto">
            <!-- Enhanced Breadcrumb -->
            <div class="breadcrumb flex items-center text-sm text-gray-500">
                <a href="{{ route('homepage') }}" class="breadcrumb-item hover:text-blue-600">Beranda</a>
                <i class="breadcrumb-separator fas fa-chevron-right mx-3 text-xs"></i>
                <a href="#" class="breadcrumb-item hover:text-blue-600">Tentang</a>
                <i class="breadcrumb-separator fas fa-chevron-right mx-3 text-xs"></i>
                <span class="font-medium text-gray-800">Profil BKPSDM</span>
            </div>
            
            <!-- Enhanced Page Header -->
            <div class="page-header">
                <span class="page-badge text-sm font-medium">Tentang Kami</span>
                <h1 class="page-title text-3xl md:text-4xl font-bold">Profil BKPSDM Kabupaten Sorong Selatan</h1>
                <p class="page-description text-lg">Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kabupaten Sorong Selatan adalah institusi yang bertanggung jawab dalam pengelolaan kepegawaian dan pengembangan SDM aparatur sipil negara di lingkungan Pemerintah Kabupaten Sorong Selatan.</p>
            </div>
            
            <div class="flex flex-col gap-8">
                <!-- Enhanced Profil BKPSDM dengan gambar -->
                <div class="content-card flex flex-col items-start space-y-6">
                    <div class="w-full flex justify-center">
                        <div class="profile-image-container">
                            @if(isset($settings['profile_image']))
                                {{-- Perbaikan: Mengubah ukuran gambar menjadi lebih besar --}}
                                <img src="{{ asset('storage/' . $settings['profile_image']) }}" alt="Gambar Profil BKPSDM" class="profile-image">
                            @else
                                <img src="https://placehold.co/800x400/D1D5DB/1F2937?text=Gambar+Profil+BKPSDM" alt="Gambar Profil BKPSDM" class="profile-image">
                            @endif
                            <div class="profile-image-overlay"></div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-6 w-full">
                        <div class="icon-container flex-shrink-0 mt-2">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="flex-1">
                            <h2 class="card-title">Profil BKPSDM</h2>
                            <p class="card-content">{{ $settings['profile_bkpsdm'] ?? 'Profil tidak ditemukan.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Visi -->
                <div class="content-card flex flex-col items-start space-y-4">
                    <div class="icon-container">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h2 class="card-title">Visi</h2>
                    <p class="card-content italic">"{{ $settings['visi'] ?? 'Visi tidak ditemukan.' }}"</p>
                </div>

                <!-- Enhanced Misi -->
                <div class="content-card flex flex-col items-start space-y-4">
                    <div class="icon-container">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h2 class="card-title">Misi</h2>
                    <ul class="enhanced-list card-content">
                        @php
                            $misiItems = json_decode($settings['misi'] ?? '[]', true);
                        @endphp
                        @forelse($misiItems as $misi)
                            <li>{{ $misi }}</li>
                        @empty
                            <li>Misi tidak ditemukan.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Enhanced Struktur Organisasi -->
                <div class="content-card flex flex-col items-start space-y-4">
                    <div class="icon-container">
                        <i class="fas fa-sitemap"></i>
                    </div>
                    <h2 class="card-title">Struktur Organisasi</h2>
                    <p class="card-content">{{ $settings['org_structure_text'] ?? 'Penjelasan struktur tidak ditemukan.' }}</p>
                    <div class="w-full">
                        @if(isset($settings['org_structure_image']))
                            <img src="{{ asset('storage/' . $settings['org_structure_image']) }}" alt="Struktur Organisasi" class="w-full h-auto rounded-xl shadow-md mt-4 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                        @else
                            <img src="https://placehold.co/800x400/D1D5DB/1F2937?text=Struktur+Organisasi" alt="Struktur Organisasi" class="w-full h-auto rounded-xl shadow-md mt-4 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                        @endif
                    </div>
                </div>

                <!-- Enhanced Tugas dan Fungsi -->
                <div class="content-card flex flex-col items-start space-y-4">
                    <div class="icon-container">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h2 class="card-title">Tugas dan Fungsi</h2>
                    <ol class="enhanced-list decimal card-content">
                        @php
                            $tfItems = json_decode($settings['tugas_fungsi'] ?? '[]', true);
                        @endphp
                        @forelse($tfItems as $tf)
                            <li>{{ $tf }}</li>
                        @empty
                            <li>Tugas dan fungsi tidak ditemukan.</li>
                        @endforelse
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced scroll reveal animation
        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer for scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, observerOptions);

            // Observe scroll reveal elements
            document.querySelectorAll('.scroll-reveal').forEach(el => {
                observer.observe(el);
            });

            // Add smooth hover effects for list items
            document.querySelectorAll('.enhanced-list li').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(8px)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });

            // Enhanced image loading animation
            const images = document.querySelectorAll('.profile-image, .content-card img');
            images.forEach(img => {
                if (img.complete) {
                    img.classList.add('loaded');
                } else {
                    img.addEventListener('load', () => {
                        img.classList.add('loaded');
                    });
                }
            });
        });
    </script>
@endsection