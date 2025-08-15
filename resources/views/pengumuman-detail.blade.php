@extends('layouts.app')

@section('title', $announcement->title . ' - BKPSDM Sorong Selatan')

@section('content')
    <div class="bg-gray-100 py-10 px-4 md:px-0">
        <div class="container mx-auto">
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <a href="{{ route('homepage') }}" class="hover:text-blue-600">Beranda</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <a href="{{ route('pengumuman.index') }}" class="hover:text-blue-600">Pengumuman</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="font-medium text-gray-800 line-clamp-1">{{ $announcement->title }}</span>
            </div>
            
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 md:p-12 max-w-4xl mx-auto">
                <div class="text-center mb-8">
                    <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-4 py-1.5 rounded-full">{{ $announcement->status === 'published' ? 'Terbit' : 'Draf' }}</span>
                    <h1 class="text-3xl md:text-4xl font-extrabold mt-4 mb-2 text-gray-900">{{ $announcement->title }}</h1>
                    <p class="text-sm text-gray-500 flex items-center justify-center space-x-2">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ \Carbon\Carbon::parse($announcement->publish_date)->translatedFormat('d F Y') }}</span>
                    </p>
                </div>
                
                <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="w-full h-80 object-cover rounded-2xl shadow-md mb-8">
                
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! $announcement->content !!}
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('pengumuman.index') }}" class="inline-flex items-center space-x-2 bg-blue-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-blue-700 transition duration-300">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke daftar pengumuman</span>
                </a>
            </div>
        </div>
    </div>
@endsection
