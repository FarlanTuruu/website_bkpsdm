@extends('layouts.app')

@section('title', 'Profil Pimpinan - BKPSDM Sorong Selatan')

@section('content')
    <!-- Hero Section with Gradient Background -->
    <div class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full animate-pulse"></div>
            <div class="absolute top-40 right-20 w-20 h-20 bg-blue-300 rounded-full animate-bounce"></div>
            <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-indigo-300 rounded-full animate-ping"></div>
        </div>
        
        <div class="relative py-20 px-4 md:px-0">
            <div class="container mx-auto">
                <!-- Breadcrumb -->
                <div class="flex items-center text-sm text-blue-200 mb-8">
                    <a href="{{ route('homepage') }}" class="hover:text-white transition-colors duration-200">Beranda</a>
                    <i class="fas fa-chevron-right mx-2 text-xs"></i>
                    <a href="#" class="hover:text-white transition-colors duration-200">Tentang</a>
                    <i class="fas fa-chevron-right mx-2 text-xs"></i>
                    <span class="font-medium text-white">Profil Pimpinan</span>
                </div>
                
                <div class="text-center">
                    <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm text-white text-sm font-medium px-6 py-2 rounded-full mb-6">
                        <i class="fas fa-users"></i>
                        <span>Pimpinan</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                        Profil <span class="text-blue-300">Pimpinan</span> BKPSDM
                    </h1>
                    <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                        Mengenal para pemimpin yang mengarahkan visi dan misi BKPSDM Kabupaten Sorong Selatan dalam memberikan pelayanan kepegawaian dan pengembangan SDM aparatur yang berkualitas.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-gray-50 py-20 px-4 md:px-0">
        <div class="container mx-auto">
            <!-- Main Leader Profile -->
            @php
                $mainLeader = $leaders->firstWhere('position', 'Kepala BKPSDM Kabupaten Sorong Selatan');
            @endphp
            @if($mainLeader)
                <div class="relative mb-20">
                    <!-- Background Decoration -->
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl transform rotate-1 opacity-10"></div>
                    
                    <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden">
                        <!-- Header Section with Gradient -->
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-white">
                            <div class="flex items-center space-x-4">
                                <div class="bg-white/20 p-3 rounded-full">
                                    <i class="fas fa-crown text-2xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold">Kepala Dinas</h2>
                                    <p class="text-blue-100">Pemimpin Utama BKPSDM</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Profile Content -->
                        <div class="p-8 md:p-12 flex flex-col md:flex-row items-center md:items-start space-y-8 md:space-y-0 md:space-x-12">
                            <div class="md:w-1/3 flex-shrink-0">
                                <div class="relative group">
                                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl opacity-75 group-hover:opacity-100 transition duration-300 blur"></div>
                                    <img src="{{ asset('storage/' . $mainLeader->photo) }}" alt="{{ $mainLeader->name }}" class="relative w-full h-80 object-cover rounded-2xl shadow-xl transform group-hover:scale-105 transition duration-300">
                                </div>
                                <div class="mt-6 text-center">
                                    <div class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold px-6 py-3 rounded-full shadow-lg">
                                        <i class="fas fa-star"></i>
                                        <span>{{ $mainLeader->position }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="md:w-2/3">
                                <div class="mb-6">
                                    <h3 class="text-4xl font-bold text-gray-900 mb-2">{{ $mainLeader->name }}</h3>
                                    <p class="text-xl text-blue-600 font-semibold">{{ $mainLeader->position }}</p>
                                </div>
                                
                                <div class="space-y-8">
                                    <!-- Biodata Card -->
                                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-6 border border-gray-200">
                                        <div class="flex items-center mb-4">
                                            <div class="bg-blue-600 p-2 rounded-lg mr-3">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                            <h4 class="text-xl font-bold text-gray-900">Biodata</h4>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="flex items-center space-x-3">
                                                <i class="fas fa-map-marker-alt text-blue-600"></i>
                                                <div>
                                                    <p class="text-sm text-gray-500">Tempat, Tanggal Lahir</p>
                                                    <p class="font-semibold text-gray-900">{{ $mainLeader->birth_place }}, {{ optional($mainLeader->birth_date)->translatedFormat('d F Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <i class="fas fa-briefcase text-blue-600"></i>
                                                <div>
                                                    <p class="text-sm text-gray-500">Jabatan</p>
                                                    <p class="font-semibold text-gray-900">{{ $mainLeader->position }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Stats Cards -->
                                    <div class="grid grid-cols-3 gap-4">
                                        <div class="bg-blue-600 text-white p-4 rounded-xl text-center">
                                            <i class="fas fa-calendar-alt text-2xl mb-2"></i>
                                            <p class="text-xs opacity-90">Pengalaman</p>
                                            <p class="font-bold">15+ Tahun</p>
                                        </div>
                                        <div class="bg-indigo-600 text-white p-4 rounded-xl text-center">
                                            <i class="fas fa-users text-2xl mb-2"></i>
                                            <p class="text-xs opacity-90">Tim</p>
                                            <p class="font-bold">200+ Staff</p>
                                        </div>
                                        <div class="bg-purple-600 text-white p-4 rounded-xl text-center">
                                            <i class="fas fa-trophy text-2xl mb-2"></i>
                                            <p class="text-xs opacity-90">Prestasi</p>
                                            <p class="font-bold">10+ Award</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Other Leaders Section -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center space-x-2 bg-blue-100 text-blue-800 text-sm font-medium px-6 py-2 rounded-full mb-6">
                    <i class="fas fa-sitemap"></i>
                    <span>Tim Pimpinan</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pimpinan Bidang</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($leaders as $leader)
                    @if($leader->position !== 'Kepala BKPSDM Kabupaten Sorong Selatan')
                        <div class="group bg-white rounded-2xl shadow-xl overflow-hidden text-center transform hover:scale-105 hover:-translate-y-2 transition-all duration-500">
                            <!-- Image with Overlay -->
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/' . $leader->photo) }}" alt="{{ $leader->name }}" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                                <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm p-2 rounded-full opacity-0 group-hover:opacity-100 transition duration-300">
                                    <i class="fas fa-eye text-white"></i>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition duration-200">{{ $leader->name }}</h3>
                                <div class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold px-4 py-1 rounded-full mb-3">
                                    {{ $leader->position }}
                                </div>
                                
                                @if(isset(json_decode($leader->education, true)[0]))
                                    <div class="flex items-center justify-center space-x-2 text-sm text-gray-500 mt-4">
                                        <i class="fas fa-graduation-cap text-blue-600"></i>
                                        <p>{{ json_decode($leader->education, true)[0] }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            
            <!-- Call to Action Section -->
            <div class="mt-20 text-center">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-12 text-white relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="1"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                    </div>
                    
                    <div class="relative">
                        <h3 class="text-3xl font-bold mb-4">Ingin Mengetahui Lebih Lanjut?</h3>
                        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">Hubungi kami untuk informasi lebih detail mengenai layanan dan program BKPSDM Kabupaten Sorong Selatan</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('contact.page') }}" class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition duration-200 inline-flex items-center justify-center">
                                <i class="fas fa-phone mr-2"></i>Hubungi Kami
                            </a>
                            <!-- <a href="#" class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600 transition duration-200 inline-flex items-center justify-center">
                                <i class="fas fa-info-circle mr-2"></i>Info Selengkapnya
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection