@extends('layouts.app')

@section('title', 'Profil Pimpinan - BKPSDM Sorong Selatan')

@section('content')
    <div class="bg-gray-100 py-10 px-4 md:px-0">
        <div class="container mx-auto">
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <a href="{{ route('homepage') }}" class="hover:text-blue-600">Beranda</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <a href="#" class="hover:text-blue-600">Tentang</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="font-medium text-gray-800">Profil Pimpinan</span>
            </div>
            
            <div class="text-center mb-12">
                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-4 py-1.5 rounded-full">Pimpinan</span>
                <h1 class="text-3xl md:text-4xl font-bold mt-4 mb-2">Profil Pimpinan BKPSDM</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Mengenal para pemimpin yang mengarahkan visi dan misi BKPSDM Kabupaten Sorong Selatan dalam memberikan pelayanan kepegawaian dan pengembangan SDM aparatur yang berkualitas.</p>
            </div>
            
            <!-- Main Leader Profile -->
            @php
                $mainLeader = $leaders->firstWhere('position', 'Kepala BKPSDM Kabupaten Sorong Selatan');
            @endphp
            @if($mainLeader)
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 md:p-12 mb-16 flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-12">
                    <div class="md:w-1/3 flex-shrink-0">
                        <img src="{{ asset('storage/' . $mainLeader->photo) }}" alt="{{ $mainLeader->name }}" class="w-full h-80 object-cover rounded-2xl shadow-md">
                        <div class="mt-4 text-center">
                            <span class="bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-full inline-flex items-center space-x-2">
                                <i class="fas fa-crown"></i>
                                <span>{{ $mainLeader->position }}</span>
                            </span>
                        </div>
                    </div>
                    <div class="md:w-2/3">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $mainLeader->name }}</h2>
                        <p class="text-blue-600 font-semibold mb-4">{{ $mainLeader->position }}</p>
                        
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-bold mb-2 border-b border-gray-200 pb-2">Biodata</h3>
                                <ul class="space-y-2 text-gray-700">
                                    <li><span class="font-semibold">Tempat, Tanggal Lahir:</span> {{ $mainLeader->birth_place }}, {{ optional($mainLeader->birth_date)->translatedFormat('d F Y') }}</li>
                                    <li><span class="font-semibold">Jabatan:</span> {{ $mainLeader->position }}</li>
                                </ul>
                            </div>
                            
                            <!-- Menambahkan Riwayat Pendidikan -->
                            <!-- <div>
                                <h3 class="text-lg font-bold mb-2 border-b border-gray-200 pb-2">Riwayat Pendidikan</h3>
                                <ul class="list-disc pl-5 text-gray-700 space-y-1">
                                    @foreach(json_decode($mainLeader->education, true) ?? [] as $edu)
                                        <li>{{ $edu }}</li>
                                    @endforeach
                                </ul>
                            </div> -->
                            
                            <!-- Menambahkan Riwayat Karir -->
                            <!-- <div>
                                <h3 class="text-lg font-bold mb-2 border-b border-gray-200 pb-2">Riwayat Karir</h3>
                                <ul class="list-disc pl-5 text-gray-700 space-y-1">
                                    @foreach(json_decode($mainLeader->career, true) ?? [] as $career)
                                        <li>{{ $career }}</li>
                                    @endforeach
                                </ul>
                            </div> -->

                             <!-- Menambahkan Prestasi -->
                             <!-- <div>
                                <h3 class="text-lg font-bold mb-2 border-b border-gray-200 pb-2">Prestasi</h3>
                                <ul class="list-disc pl-5 text-gray-700 space-y-1">
                                    @foreach(json_decode($mainLeader->achievements, true) ?? [] as $achievement)
                                        <li>{{ $achievement }}</li>
                                    @endforeach
                                </ul> -->
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endif

            <!-- Other Leaders -->
            <!-- <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-2">Pimpinan Bidang</h2>
            </div> -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($leaders as $leader)
                    @if($leader->position !== 'Kepala BKPSDM Kabupaten Sorong Selatan')
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden text-center transform hover:scale-105 transition duration-500">
                            <img src="{{ asset('storage/' . $leader->photo) }}" alt="{{ $leader->name }}" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $leader->name }}</h3>
                                <p class="text-blue-600 font-semibold mb-2">{{ $leader->position }}</p>
                                <div class="mt-4 text-sm text-gray-500">
                                    @if(isset(json_decode($leader->education, true)[0]))
                                        <p>{{ json_decode($leader->education, true)[0] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
