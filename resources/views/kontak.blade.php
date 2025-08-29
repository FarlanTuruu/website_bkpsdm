@extends('layouts.app')

@section('title', 'Kontak - BKPSDM Sorong Selatan')

@section('content')
    <div class="relative min-h-screen overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
            <div class="absolute inset-0 opacity-30">
                <div class="absolute top-10 left-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
                <div class="absolute top-40 right-10 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-2000"></div>
                <div class="absolute -bottom-8 left-1/3 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-4000"></div>
            </div>
        </div>

        <div class="relative py-10 px-4 md:px-0">
            <div class="container mx-auto">
                <!-- Enhanced Breadcrumb -->
                <div class="flex items-center text-sm text-gray-500 mb-6 backdrop-blur-sm bg-white/20 rounded-full px-4 py-2 w-fit shadow-lg border border-white/30">
                    <a href="{{ route('homepage') }}" class="hover:text-blue-600 transition-colors duration-300 flex items-center">
                        <i class="fas fa-home mr-1"></i>
                        Beranda
                    </a>
                    <i class="fas fa-chevron-right mx-3 text-xs"></i>
                    <span class="font-medium text-gray-800">Kontak</span>
                </div>
                
                <!-- Enhanced Header with Floating Elements -->
                <div class="text-center mb-16 relative">
                    <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full opacity-20 animate-bounce"></div>
                    </div>
                    <span class="inline-block bg-gradient-to-r from-green-400 to-green-600 text-white text-sm font-semibold px-6 py-2 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-phone-alt mr-2"></i>
                        Hubungi Kami
                    </span>
                    <h1 class="text-4xl md:text-5xl font-bold mt-6 mb-4 bg-gradient-to-r from-gray-800 via-blue-800 to-purple-800 bg-clip-text text-transparent animate-fade-in">
                        Kontak & Informasi
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Kami siap membantu Anda dengan berbagai pertanyaan dan kebutuhan layanan kepegawaian.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
                    <!-- Enhanced Contact Info Cards -->
                    <div class="space-y-6">
                        <div class="backdrop-blur-md bg-white/60 p-8 rounded-3xl shadow-2xl border border-white/50 hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2">
                            <h2 class="text-2xl font-bold mb-8 text-center text-gray-800">
                                <i class="fas fa-address-book mr-3 text-blue-600"></i>
                                Informasi Kontak
                            </h2>
                            
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Address Card -->
                                <div class="group flex items-start space-x-6 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 text-white flex items-center justify-center rounded-2xl flex-shrink-0 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:rotate-6">
                                        <i class="fas fa-map-marker-alt text-2xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-xl mb-2 text-gray-800">Alamat Kantor</h3>
                                        <p class="text-gray-600 text-lg leading-relaxed">{{ $settings['address'] ?? 'Jl. Keyen, Sorong Selatan' }}</p>
                                    </div>
                                </div>
                                
                                <!-- Phone Card -->
                                <div class="group flex items-start space-x-6 p-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl hover:from-green-100 hover:to-emerald-100 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 text-white flex items-center justify-center rounded-2xl flex-shrink-0 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:rotate-6">
                                        <i class="fas fa-phone text-2xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-xl mb-2 text-gray-800">Nomor Telepon</h3>
                                        <p class="text-gray-600 text-lg">
                                            <a href="tel:{{ $settings['phone'] ?? '(0411) 872-123' }}" class="hover:text-green-600 transition-colors duration-300">
                                                {{ $settings['phone'] ?? '(0411) 872-123' }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Email Card -->
                                <div class="group flex items-start space-x-6 p-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl hover:from-purple-100 hover:to-pink-100 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 text-white flex items-center justify-center rounded-2xl flex-shrink-0 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:rotate-6">
                                        <i class="fas fa-envelope text-2xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-xl mb-2 text-gray-800">Email</h3>
                                        <p class="text-gray-600 text-lg">
                                            <a href="mailto:{{ $settings['email'] ?? 'info@bkpsdm.sorongselatan.go.id' }}" class="hover:text-purple-600 transition-colors duration-300">
                                                {{ $settings['email'] ?? 'info@bkpsdm.sorongselatan.go.id' }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Working Hours Card -->
                                <div class="group flex items-start space-x-6 p-6 bg-gradient-to-r from-orange-50 to-red-50 rounded-2xl hover:from-orange-100 hover:to-red-100 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 text-white flex items-center justify-center rounded-2xl flex-shrink-0 shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:rotate-6">
                                        <i class="fas fa-clock text-2xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-xl mb-2 text-gray-800">Jam Layanan</h3>
                                        <p class="text-gray-600 text-lg">Senin - Jumat: 08:00 - 16:00 WITA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Enhanced Map Section -->
                    <div class="backdrop-blur-md bg-white/60 rounded-3xl shadow-2xl border border-white/50 overflow-hidden hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="p-8">
                            <h2 class="text-2xl font-bold mb-8 text-center text-gray-800">
                                <i class="fas fa-map-marked-alt mr-3 text-indigo-600"></i>
                                Lokasi Kantor
                            </h2>
                            
                            <div class="relative group">
                                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-2xl p-12 text-center min-h-[400px] flex flex-col items-center justify-center border-2 border-dashed border-indigo-200 hover:border-indigo-300 transition-all duration-300">
                                    <div class="relative mb-8">
                                        <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-full flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-all duration-300 group-hover:rotate-12">
                                            <i class="fas fa-map-marked-alt text-4xl text-white"></i>
                                        </div>
                                        <div class="absolute -inset-4 bg-indigo-200 rounded-full opacity-30 animate-ping"></div>
                                    </div>
                                    
                                    <h3 class="font-bold text-2xl mb-3 text-gray-800">Peta Lokasi</h3>
                                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">BKPSDM Kabupaten Sorong Selatan</p>
                                    
                                    <a href="https://maps.app.goo.gl/ecmQpeNumq8n1KnJ9" target="_blank" class="inline-flex items-center bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-bold py-4 px-8 rounded-full hover:from-indigo-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl shadow-lg group">
                                        <i class="fas fa-external-link-alt mr-3 group-hover:animate-bounce"></i>
                                        Buka di Google Maps
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Info Section -->
                <div class="mt-16 backdrop-blur-md bg-white/40 rounded-3xl p-8 shadow-xl border border-white/50">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">
                            <i class="fas fa-info-circle mr-3 text-blue-600"></i>
                            Informasi Tambahan
                        </h3>
                        <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">
                            Untuk pelayanan yang lebih optimal, silakan hubungi kami terlebih dahulu sebelum berkunjung. 
                            Tim kami akan dengan senang hati membantu Anda dalam berbagai kebutuhan administrasi kepegawaian.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }
        
        .shadow-3xl {
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
        }
        
        /* Glassmorphism effect */
        .backdrop-blur-md {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
    </style>
@endsection