@extends('layouts.app')

@section('title', 'Pengumuman - BKPSDM Sorong Selatan')

@section('content')
    <div class="py-10 px-4 md:px-0">
        <div class="container mx-auto">
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <a href="{{ route('homepage') }}" class="hover:text-blue-600">Beranda</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="font-medium text-gray-800">Pengumuman</span>
            </div>

            <div class="text-center mb-12">
                <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-4 py-1.5 rounded-full">Arsip</span>
                <h1 class="text-3xl md:text-4xl font-bold mt-4 mb-2">Pengumuman Terkini</h1>
                <p class="text-lg text-gray-600">Dapatkan informasi terbaru seputar kebijakan, pengumuman, dan kegiatan kepegawaian.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($announcements as $announcement)
                    <div class="bg-white bg-opacity-70 rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition duration-500">
                        <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center space-x-2 mb-3">
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $announcement->status === 'published' ? 'Terbit' : 'Draf' }}</span>
                                <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-0.5 rounded-full">Pengumuman</span>
                            </div>
                            <a href="{{ route('pengumuman.show', $announcement->slug) }}" class="block">
                                <h3 class="text-xl font-bold text-gray-900 hover:text-blue-600 transition duration-300 mb-2">{{ $announcement->title }}</h3>
                            </a>
                            <p class="text-gray-500 text-sm mb-4">{{ \Carbon\Carbon::parse($announcement->publish_date)->translatedFormat('d F Y') }}</p>
                            <p class="text-gray-600 text-base line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 150) }}</p>
                            <div class="mt-4">
                                <a href="{{ route('pengumuman.show', $announcement->slug) }}" class="text-blue-600 font-semibold flex items-center space-x-2 hover:underline transition duration-300">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white bg-opacity-70 rounded-lg shadow-md p-6 text-center">
                        <p class="text-gray-500">Belum ada pengumuman yang tersedia.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-8 flex justify-center">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
@endsection
