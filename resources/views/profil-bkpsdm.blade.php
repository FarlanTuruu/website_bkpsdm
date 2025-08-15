@extends('layouts.app')

@section('title', 'Profil BKPSDM - BKPSDM Kabupaten Sorong Selatan')

@section('content')
    <div class="bg-gray-100 py-10 px-4 md:px-0">
        <div class="container mx-auto">
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <a href="{{ route('homepage') }}" class="hover:text-blue-600">Beranda</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <a href="#" class="hover:text-blue-600">Tentang</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="font-medium text-gray-800">Profil BKPSDM</span>
            </div>
            
            <div class="text-center mb-12">
                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-4 py-1.5 rounded-full">Tentang Kami</span>
                <h1 class="text-3xl md:text-4xl font-bold mt-4 mb-2">Profil BKPSDM Kabupaten Sorong Selatan</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kabupaten Sorong Selatan adalah institusi yang bertanggung jawab dalam pengelolaan kepegawaian dan pengembangan SDM aparatur sipil negara di lingkungan Pemerintah Kabupaten Sorong Selatan.</p>
            </div>
            
            <div class="flex flex-col gap-8">
                <!-- Profil BKPSDM dengan gambar -->
                <div class="bg-white rounded-3xl shadow-xl p-6 md:p-8 flex flex-col items-start space-y-6">
                    <div class="w-full flex justify-center">
                        @if(isset($settings['profile_image']))
                            {{-- Perbaikan: Mengubah ukuran gambar menjadi lebih besar --}}
                            <img src="{{ asset('storage/' . $settings['profile_image']) }}" alt="Gambar Profil BKPSDM" class="rounded-2xl shadow-md w-full h-auto object-cover max-h-[500px]">
                        @else
                            <img src="https://placehold.co/800x400/D1D5DB/1F2937?text=Gambar+Profil+BKPSDM" alt="Gambar Profil BKPSDM" class="rounded-2xl shadow-md w-full h-auto object-cover max-h-[500px]">
                        @endif
                    </div>
                    <div class="flex items-start space-x-6 w-full">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full flex-shrink-0 mt-2">
                            <i class="fas fa-building text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold mb-4">Profil BKPSDM</h2>
                            <p class="text-gray-600 leading-relaxed">{{ $settings['profile_bkpsdm'] ?? 'Profil tidak ditemukan.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Visi -->
                <div class="bg-white rounded-3xl shadow-xl p-6 md:p-8 flex flex-col items-start space-y-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full">
                        <i class="fas fa-eye text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold">Visi</h2>
                    <p class="text-gray-600 leading-relaxed italic">"{{ $settings['visi'] ?? 'Visi tidak ditemukan.' }}"</p>
                </div>

                <!-- Misi -->
                <div class="bg-white rounded-3xl shadow-xl p-6 md:p-8 flex flex-col items-start space-y-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full">
                        <i class="fas fa-bullseye text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold">Misi</h2>
                    <ul class="list-disc pl-8 text-gray-600 leading-relaxed">
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

                <!-- Struktur Organisasi -->
                <div class="bg-white rounded-3xl shadow-xl p-6 md:p-8 flex flex-col items-start space-y-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full">
                        <i class="fas fa-sitemap text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold">Struktur Organisasi</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $settings['org_structure_text'] ?? 'Penjelasan struktur tidak ditemukan.' }}</p>
                    @if(isset($settings['org_structure_image']))
                        <img src="{{ asset('storage/' . $settings['org_structure_image']) }}" alt="Struktur Organisasi" class="w-full h-auto rounded-xl shadow-md mt-4">
                    @else
                        <img src="https://placehold.co/800x400/D1D5DB/1F2937?text=Struktur+Organisasi" alt="Struktur Organisasi" class="w-full h-auto rounded-xl shadow-md mt-4">
                    @endif
                </div>

                <!-- Tugas dan Fungsi -->
                <div class="bg-white rounded-3xl shadow-xl p-6 md:p-8 flex flex-col items-start space-y-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full">
                        <i class="fas fa-tasks text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold">Tugas dan Fungsi</h2>
                    <ul class="list-decimal pl-8 text-gray-600 leading-relaxed">
                        @php
                            $tfItems = json_decode($settings['tugas_fungsi'] ?? '[]', true);
                        @endphp
                        @forelse($tfItems as $tf)
                            <li>{{ $tf }}</li>
                        @empty
                            <li>Tugas dan fungsi tidak ditemukan.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
