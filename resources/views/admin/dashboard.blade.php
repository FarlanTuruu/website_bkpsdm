@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card Pengumuman -->
        <div class="bg-white rounded-xl shadow-lg p-6 flex items-center space-x-4">
            <div class="bg-blue-100 text-blue-600 rounded-full p-3">
                <i class="fas fa-bullhorn text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Pengumuman</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $announcementCount }}</h3>
            </div>
        </div>

        <!-- Card Pimpinan -->
        <div class="bg-white rounded-xl shadow-lg p-6 flex items-center space-x-4">
            <div class="bg-yellow-100 text-yellow-600 rounded-full p-3">
                <i class="fas fa-user-tie text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Pimpinan</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $leaderCount }}</h3>
            </div>
        </div>

        <!-- Card Pengumuman Terbit -->
        <div class="bg-white rounded-xl shadow-lg p-6 flex items-center space-x-4">
            <div class="bg-green-100 text-green-600 rounded-full p-3">
                <i class="fas fa-check-circle text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Pengumuman Terbit</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $publishedCount }}</h3>
            </div>
        </div>
    </div>
@endsection
