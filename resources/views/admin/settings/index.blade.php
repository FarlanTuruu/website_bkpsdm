@extends('admin.layouts.app')

@section('page-title', 'Pengaturan Website')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-xl p-8 mb-8 text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-4 left-4 w-16 h-16 bg-white rounded-full animate-pulse"></div>
            <div class="absolute top-12 right-8 w-8 h-8 bg-blue-300 rounded-full animate-bounce"></div>
            <div class="absolute bottom-4 left-1/3 w-12 h-12 bg-indigo-300 rounded-full animate-ping"></div>
        </div>
        
        <div class="relative flex items-center space-x-4">
            <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                <i class="fas fa-cogs text-3xl"></i>
            </div>
            <div>
                <h3 class="text-3xl font-bold mb-2">Manajemen Pengaturan</h3>
                <p class="text-blue-100">Kelola semua pengaturan website BKPSDM dengan mudah dan efisien</p>
            </div>
        </div>
    </div>

    <!-- Main Form Container -->
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
        <!-- Form Header -->
        <div class="bg-gray-50 border-b border-gray-200 px-8 py-6">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-600 p-2 rounded-lg">
                    <i class="fas fa-edit text-white"></i>
                </div>
                <h4 class="text-xl font-semibold text-gray-800">Form Pengaturan</h4>
            </div>
        </div>

        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')
            
            <!-- Background Halaman Section -->
            <div class="mb-12">
                <!-- Section Header -->
                <div class="flex items-center space-x-3 mb-6 pb-4 border-b-2 border-blue-100">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 p-3 rounded-xl text-white">
                        <i class="fas fa-image text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-gray-800">Background Halaman</h4>
                        <p class="text-gray-600">Atur gambar latar belakang untuk website</p>
                    </div>
                </div>

                <!-- Hero Background Images -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 mb-6 border border-purple-200">
                    <label for="hero_background_images" class="block text-gray-700 font-semibold mb-4 flex items-center space-x-2">
                        <i class="fas fa-images text-purple-600"></i>
                        <span>Gambar Latar Belakang Hero (Maks. 5)</span>
                    </label>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6">
                        @php
                            $heroImages = json_decode($settings['hero_background_images'] ?? '[]', true);
                        @endphp
                        @forelse($heroImages as $image)
                            <div class="relative group">
                                <div class="relative overflow-hidden rounded-xl shadow-lg">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Hero Background" class="w-full h-40 object-contain mx-auto group-hover:scale-105 transition duration-300 bg-white">

                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                        <i class="fas fa-eye text-white text-2xl"></i>
                                    </div>
                                </div>
                                <div class="absolute -top-2 -right-2">
                                    <label class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold cursor-pointer hover:bg-red-600 transition duration-200 flex items-center space-x-1 shadow-lg has-[:checked]:bg-red-700 has-[:checked]:scale-110">
                                        <input type="checkbox" name="remove_hero_images[]" value="{{ $image }}" class="hidden peer">
                                        <i class="fas fa-trash peer-checked:hidden"></i>
                                        <i class="fas fa-check hidden peer-checked:block"></i>
                                        <span class="peer-checked:hidden">Hapus</span>
                                        <span class="hidden peer-checked:block">Terpilih</span>
                                    </label>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white/80 rounded-xl p-8 text-center border-2 border-dashed border-purple-300">
                                <i class="fas fa-images text-4xl text-purple-400 mb-4"></i>
                                <p class="text-gray-500 font-medium">Belum ada gambar latar belakang diunggah.</p>
                                <p class="text-gray-400 text-sm mt-2">Upload gambar pertama Anda di bawah ini</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="relative">
                        <input type="file" name="hero_background_images[]" id="hero_background_images" multiple class="w-full border-2 border-dashed border-purple-300 p-6 rounded-xl focus:outline-none focus:border-purple-500 transition duration-200 bg-white/50 hover:bg-white/80">
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="text-center">
                                <i class="fas fa-cloud-upload-alt text-3xl text-purple-400 mb-2"></i>
                                <p class="text-purple-600 font-medium">Klik atau drag file ke sini</p>
                            </div>
                        </div>
                    </div>
                    <p class="text-purple-600 text-sm mt-3 flex items-center space-x-2">
                        <i class="fas fa-info-circle"></i>
                        <span>Anda bisa mengunggah hingga 5 gambar sekaligus.</span>
                    </p>
                </div>

                <!-- Global Background Image -->
                <!-- <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
                    <label for="global_background_image" class="block text-gray-700 font-semibold mb-4 flex items-center space-x-2">
                        <i class="fas fa-globe text-blue-600"></i>
                        <span>Gambar Latar Belakang Global</span>
                    </label>
                    
                    @if(isset($settings['global_background_image']))
                        <div class="relative group mb-4 inline-block">
                            <div class="relative overflow-hidden rounded-xl shadow-lg">
                                <img src="{{ asset('storage/' . $settings['global_background_image']) }}" alt="Latar Belakang Global" class="w-auto h-48 rounded-xl shadow-lg group-hover:scale-105 transition duration-300">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                    <i class="fas fa-search-plus text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="relative">
                        <input type="file" name="global_background_image" id="global_background_image" class="w-full border-2 border-dashed border-blue-300 p-6 rounded-xl focus:outline-none focus:border-blue-500 transition duration-200 bg-white/50 hover:bg-white/80">
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="text-center">
                                <i class="fas fa-image text-3xl text-blue-400 mb-2"></i>
                                <p class="text-blue-600 font-medium">Upload gambar background global</p>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-blue-600 text-sm mt-3 flex items-center space-x-2">
                        <i class="fas fa-info-circle"></i>
                        <span>Unggah file gambar baru untuk latar belakang di semua halaman frontend.</span>
                    </p>
                    
                    @if(isset($settings['global_background_image']))
                        <div class="mt-4 bg-red-50 border border-red-200 rounded-lg p-3">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="remove_global_background_image" id="remove_global_background_image" value="1" class="rounded text-red-500 focus:ring-red-500">
                                <span class="text-red-600 font-medium">Hapus gambar ini</span>
                                <i class="fas fa-trash text-red-500"></i>
                            </label>
                        </div>
                    @endif
                </div> -->
            </div>

            <!-- Informasi Kontak Section -->
            <div class="mb-12">
                <div class="flex items-center space-x-3 mb-6 pb-4 border-b-2 border-green-100">
                    <div class="bg-gradient-to-r from-green-500 to-teal-500 p-3 rounded-xl text-white">
                        <i class="fas fa-address-book text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-gray-800">Informasi Kontak</h4>
                        <p class="text-gray-600">Kelola informasi kontak organisasi</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Website Name -->
                    <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-xl p-6 border border-green-200">
                        <label for="website_name" class="block text-gray-700 font-semibold mb-3 flex items-center space-x-2">
                            <i class="fas fa-globe-asia text-green-600"></i>
                            <span>Nama Website</span>
                        </label>
                        <input type="text" name="website_name" id="website_name" class="w-full border-2 border-green-200 p-4 rounded-xl focus:outline-none focus:border-green-500 transition duration-200 bg-white/70 hover:bg-white" value="{{ old('website_name', $settings['website_name'] ?? '') }}" required>
                    </div>

                    <!-- Phone -->
                    <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-xl p-6 border border-green-200">
                        <label for="phone" class="block text-gray-700 font-semibold mb-3 flex items-center space-x-2">
                            <i class="fas fa-phone text-green-600"></i>
                            <span>Nomor Telepon</span>
                        </label>
                        <input type="text" name="phone" id="phone" class="w-full border-2 border-green-200 p-4 rounded-xl focus:outline-none focus:border-green-500 transition duration-200 bg-white/70 hover:bg-white" value="{{ old('phone', $settings['phone'] ?? '') }}" required>
                    </div>

                    <!-- Email -->
                    <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-xl p-6 border border-green-200">
                        <label for="email" class="block text-gray-700 font-semibold mb-3 flex items-center space-x-2">
                            <i class="fas fa-envelope text-green-600"></i>
                            <span>Email</span>
                        </label>
                        <input type="email" name="email" id="email" class="w-full border-2 border-green-200 p-4 rounded-xl focus:outline-none focus:border-green-500 transition duration-200 bg-white/70 hover:bg-white" value="{{ old('email', $settings['email'] ?? '') }}" required>
                    </div>

                    <!-- Address -->
                    <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-xl p-6 border border-green-200">
                        <label for="address" class="block text-gray-700 font-semibold mb-3 flex items-center space-x-2">
                            <i class="fas fa-map-marker-alt text-green-600"></i>
                            <span>Alamat</span>
                        </label>
                        <textarea name="address" id="address" rows="3" class="w-full border-2 border-green-200 p-4 rounded-xl focus:outline-none focus:border-green-500 transition duration-200 bg-white/70 hover:bg-white resize-none" required>{{ old('address', $settings['address'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            
            <!-- Profil BKPSDM Section -->
            <div class="mb-12">
                <div class="flex items-center space-x-3 mb-6 pb-4 border-b-2 border-orange-100">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 p-3 rounded-xl text-white">
                        <i class="fas fa-building text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-gray-800">Profil BKPSDM</h4>
                        <p class="text-gray-600">Kelola informasi profil organisasi</p>
                    </div>
                </div>

                <!-- Profile Image -->
                <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-6 mb-6 border border-orange-200">
                    <label for="profile_image" class="block text-gray-700 font-semibold mb-4 flex items-center space-x-2">
                        <i class="fas fa-camera text-orange-600"></i>
                        <span>Gambar Profil BKPSDM</span>
                    </label>
                    
                    @if(isset($settings['profile_image']))
                        <div class="relative group mb-4 inline-block">
                            <div class="relative overflow-hidden rounded-xl shadow-lg">
                                <img src="{{ asset('storage/' . $settings['profile_image']) }}" alt="Gambar Profil BKPSDM" class="w-auto h-48 rounded-xl shadow-lg group-hover:scale-105 transition duration-300">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                    <i class="fas fa-search-plus text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="relative">
                        <input type="file" name="profile_image" id="profile_image" class="w-full border-2 border-dashed border-orange-300 p-6 rounded-xl focus:outline-none focus:border-orange-500 transition duration-200 bg-white/50 hover:bg-white/80">
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="text-center">
                                <i class="fas fa-user-tie text-3xl text-orange-400 mb-2"></i>
                                <p class="text-orange-600 font-medium">Upload gambar profil</p>
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($settings['profile_image']))
                        <div class="mt-4 bg-red-50 border border-red-200 rounded-lg p-3">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="remove_profile_image" id="remove_profile_image" value="1" class="rounded text-red-500 focus:ring-red-500">
                                <span class="text-red-600 font-medium">Hapus gambar ini</span>
                                <i class="fas fa-trash text-red-500"></i>
                            </label>
                        </div>
                    @endif
                </div>

                <!-- Profile Text Fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Profile BKPSDM -->
                    <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl p-6 border border-orange-200">
                        <label for="profile_bkpsdm" class="block text-gray-700 font-semibold mb-3 flex items-center space-x-2">
                            <i class="fas fa-info-circle text-orange-600"></i>
                            <span>Profil Organisasi</span>
                        </label>
                        <textarea name="profile_bkpsdm" id="profile_bkpsdm" rows="5" class="w-full border-2 border-orange-200 p-4 rounded-xl focus:outline-none focus:border-orange-500 transition duration-200 bg-white/70 hover:bg-white resize-none" required>{{ old('profile_bkpsdm', $settings['profile_bkpsdm'] ?? '') }}</textarea>
                    </div>

                    <!-- Visi -->
                    <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl p-6 border border-orange-200">
                        <label for="visi" class="block text-gray-700 font-semibold mb-3 flex items-center space-x-2">
                            <i class="fas fa-eye text-orange-600"></i>
                            <span>Visi</span>
                        </label>
                        <input type="text" name="visi" id="visi" class="w-full border-2 border-orange-200 p-4 rounded-xl focus:outline-none focus:border-orange-500 transition duration-200 bg-white/70 hover:bg-white" value="{{ old('visi', $settings['visi'] ?? '') }}" required>
                    </div>
                </div>

                <!-- Misi, Struktur Org, Tugas Fungsi -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                    <!-- Misi -->
                    <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl p-6 border border-orange-200">
                        <label for="misi" class="block text-gray-700 font-semibold mb-3 flex items-center space-x-2">
                            <i class="fas fa-list-ul text-orange-600"></i>
                            <span>Misi</span>
                        </label>
                        <textarea name="misi" id="misi" rows="5" class="w-full border-2 border-orange-200 p-4 rounded-xl focus:outline-none focus:border-orange-500 transition duration-200 bg-white/70 hover:bg-white resize-none" required>{{ old('misi', $settings['misi'] ?? '') }}</textarea>
                        <p class="text-orange-600 text-sm mt-2 flex items-center space-x-2">
                            <i class="fas fa-lightbulb"></i>
                            <span>Tulis setiap misi dalam baris baru.</span>
                        </p>
                    </div>

                    <!-- Org Structure Text -->
                    <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl p-6 border border-orange-200">
                        <label for="org_structure_text" class="block text-gray-700 font-semibold mb-3 flex items-center space-x-2">
                            <i class="fas fa-sitemap text-orange-600"></i>
                            <span>Penjelasan Struktur Organisasi</span>
                        </label>
                        <textarea name="org_structure_text" id="org_structure_text" rows="5" class="w-full border-2 border-orange-200 p-4 rounded-xl focus:outline-none focus:border-orange-500 transition duration-200 bg-white/70 hover:bg-white resize-none" required>{{ old('org_structure_text', $settings['org_structure_text'] ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Org Structure Image -->
                <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-6 mt-6 border border-orange-200">
                    <label for="org_structure_image" class="block text-gray-700 font-semibold mb-4 flex items-center space-x-2">
                        <i class="fas fa-project-diagram text-orange-600"></i>
                        <span>Gambar Struktur Organisasi</span>
                    </label>
                    
                    @if(isset($settings['org_structure_image']))
                        <div class="relative group mb-4 inline-block">
                            <div class="relative overflow-hidden rounded-xl shadow-lg">
                                <img src="{{ asset('storage/' . $settings['org_structure_image']) }}" alt="Struktur Organisasi" class="w-auto h-48 rounded-xl shadow-lg group-hover:scale-105 transition duration-300">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                    <i class="fas fa-search-plus text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="relative">
                        <input type="file" name="org_structure_image" id="org_structure_image" class="w-full border-2 border-dashed border-orange-300 p-6 rounded-xl focus:outline-none focus:border-orange-500 transition duration-200 bg-white/50 hover:bg-white/80">
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="text-center">
                                <i class="fas fa-sitemap text-3xl text-orange-400 mb-2"></i>
                                <p class="text-orange-600 font-medium">Upload bagan organisasi</p>
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($settings['org_structure_image']))
                        <div class="mt-4 bg-red-50 border border-red-200 rounded-lg p-3">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="remove_org_structure_image" id="remove_org_structure_image" value="1" class="rounded text-red-500 focus:ring-red-500">
                                <span class="text-red-600 font-medium">Hapus gambar ini</span>
                                <i class="fas fa-trash text-red-500"></i>
                            </label>
                        </div>
                    @endif
                </div>

                <!-- Tugas Fungsi -->
                <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl p-6 mt-6 border border-orange-200">
                    <label for="tugas_fungsi" class="block text-gray-700 font-semibold mb-3 flex items-center space-x-2">
                        <i class="fas fa-tasks text-orange-600"></i>
                        <span>Tugas dan Fungsi</span>
                    </label>
                    <textarea name="tugas_fungsi" id="tugas_fungsi" rows="5" class="w-full border-2 border-orange-200 p-4 rounded-xl focus:outline-none focus:border-orange-500 transition duration-200 bg-white/70 hover:bg-white resize-none" required>{{ old('tugas_fungsi', $settings['tugas_fungsi'] ?? '') }}</textarea>
                    <p class="text-orange-600 text-sm mt-2 flex items-center space-x-2">
                        <i class="fas fa-lightbulb"></i>
                        <span>Tulis setiap tugas dan fungsi dalam baris baru.</span>
                    </p>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold px-8 py-4 rounded-xl shadow-xl hover:from-blue-700 hover:to-indigo-700 hover:scale-105 transition-all duration-300 flex items-center space-x-3">
                    <i class="fas fa-save text-lg"></i>
                    <span>Perbarui Pengaturan</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Custom Styles -->
    <style>
        /* File input custom styling */
        input[type="file"] {
            position: relative;
        }
        
        input[type="file"]::-webkit-file-upload-button {
            visibility: hidden;
        }
        
        input[type="file"]::before {
            content: 'Pilih File';
            display: inline-block;
            background: linear-gradient(45deg, #3B82F6, #8B5CF6);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            outline: none;
            white-space: nowrap;
            cursor: pointer;
            font-weight: 600;
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
        }

        input[type="file"]:hover::before {
            background: linear-gradient(45deg, #2563EB, #7C3AED);
        }

        /* Smooth transitions */
        * {
            transition: all 0.2s ease-in-out;
        }

        /* Custom scrollbar */
        textarea::-webkit-scrollbar {
            width: 8px;
        }

        textarea::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        textarea::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        textarea::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
@endsection