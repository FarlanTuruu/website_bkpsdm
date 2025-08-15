@extends('layouts.app')

@section('title', 'Kontak - BKPSDM Sorong Selatan')

@section('content')
    <div class="py-10 px-4 md:px-0">
        <div class="container mx-auto">
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <a href="{{ route('homepage') }}" class="hover:text-blue-600">Beranda</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="font-medium text-gray-800">Kontak</span>
            </div>
            
            <div class="text-center mb-12">
                <span class="bg-green-100 text-green-800 text-sm font-medium px-4 py-1.5 rounded-full">Hubungi Kami</span>
                <h1 class="text-3xl md:text-4xl font-bold mt-4 mb-2">Kontak & Informasi</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Kami siap membantu Anda dengan berbagai pertanyaan dan kebutuhan layanan kepegawaian.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <!-- Contact Info Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-white bg-opacity-70 p-6 rounded-2xl shadow-xl">
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Alamat Kantor</h3>
                            <p class="text-gray-600">{{ $settings['address'] ?? 'Jl. Keyen, Sorong Selatan' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full flex-shrink-0">
                            <i class="fas fa-phone text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Nomor Telepon</h3>
                            <p class="text-gray-600">{{ $settings['phone'] ?? '(0411) 872-123' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full flex-shrink-0">
                            <i class="fas fa-envelope text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Email</h3>
                            <p class="text-gray-600">{{ $settings['email'] ?? 'info@bkpsdm.sorongselatan.go.id' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full flex-shrink-0">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Jam Layanan</h3>
                            <p class="text-gray-600">Senin - Jumat: 08:00 - 16:00 WITA</p>
                        </div>
                    </div>
                </div>
                
                <!-- Map Placeholder -->
                <div class="bg-white bg-opacity-70 rounded-3xl shadow-xl overflow-hidden p-6 flex items-center justify-center min-h-[300px]">
                    <div class="text-center p-8 bg-gray-50 rounded-xl w-full flex flex-col items-center justify-center">
                        <i class="fas fa-map-marked-alt text-5xl text-blue-600 mb-4"></i>
                        <h3 class="font-bold text-xl mb-1">Peta Lokasi</h3>
                        <p class="text-gray-600 mb-4">BKPSDM Kabupaten Sorong Selatan</p>
                        <a href="https://maps.google.com" target="_blank" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-full hover:bg-blue-700 transition duration-300">Buka di Google Maps</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
