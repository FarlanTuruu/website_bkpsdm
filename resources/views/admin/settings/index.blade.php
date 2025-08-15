@extends('admin.layouts.app')

@section('page-title', 'Pengaturan Website')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Manajemen Pengaturan</h3>
        </div>

        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h4 class="text-xl font-semibold text-gray-800 mb-4">Background Halaman</h4>
            <div class="mb-6">
                <label for="hero_background_images" class="block text-gray-700 font-medium mb-2">Gambar Latar Belakang Hero (Maks. 5)</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                    @php
                        $heroImages = json_decode($settings['hero_background_images'] ?? '[]', true);
                    @endphp
                    @forelse($heroImages as $image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $image) }}" alt="Hero Background" class="w-full h-32 object-cover rounded-lg shadow-md">
                            <div class="absolute top-2 right-2">
                                <input type="checkbox" name="remove_hero_images[]" value="{{ $image }}" class="rounded text-red-500 focus:ring-red-500">
                                <label class="ml-1 text-white bg-red-500 px-2 py-1 rounded-full text-xs font-bold cursor-pointer">Hapus</label>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-full">Belum ada gambar latar belakang diunggah.</p>
                    @endforelse
                </div>
                <input type="file" name="hero_background_images[]" id="hero_background_images" multiple class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200">
                <p class="text-gray-500 text-xs mt-1">Anda bisa mengunggah hingga 5 gambar sekaligus.</p>
            </div>


            <h4 class="text-xl font-semibold text-gray-800 mb-4 mt-8">Informasi Kontak</h4>
            <div class="mb-4">
                <label for="website_name" class="block text-gray-700 font-medium mb-2">Nama Website</label>
                <input type="text" name="website_name" id="website_name" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" value="{{ old('website_name', $settings['website_name'] ?? '') }}" required>
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-medium mb-2">Alamat</label>
                <textarea name="address" id="address" rows="3" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" required>{{ old('address', $settings['address'] ?? '') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-medium mb-2">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" value="{{ old('phone', $settings['phone'] ?? '') }}" required>
            </div>
            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" id="email" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" value="{{ old('email', $settings['email'] ?? '') }}" required>
            </div>
            
            <h4 class="text-xl font-semibold text-gray-800 mb-4 mt-8">Profil BKPSDM</h4>
            <div class="mb-4">
                <label for="profile_image" class="block text-gray-700 font-medium mb-2">Gambar Profil BKPSDM</label>
                @if(isset($settings['profile_image']))
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $settings['profile_image']) }}" alt="Gambar Profil BKPSDM" class="w-auto h-40 rounded-lg shadow-md">
                    </div>
                @endif
                <input type="file" name="profile_image" id="profile_image" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200">
                <p class="text-gray-500 text-xs mt-1">Unggah file gambar baru untuk menggantikan yang lama.</p>
                @if(isset($settings['profile_image']))
                    <div class="mt-2 flex items-center space-x-2">
                        <input type="checkbox" name="remove_profile_image" id="remove_profile_image" value="1" class="rounded text-red-500 focus:ring-red-500">
                        <label for="remove_profile_image" class="text-red-500">Hapus gambar ini</label>
                    </div>
                @endif
            </div>
            <div class="mb-4">
                <label for="profile_bkpsdm" class="block text-gray-700 font-medium mb-2">Profil BKPSDM</label>
                <textarea name="profile_bkpsdm" id="profile_bkpsdm" rows="5" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" required>{{ old('profile_bkpsdm', $settings['profile_bkpsdm'] ?? '') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="visi" class="block text-gray-700 font-medium mb-2">Visi</label>
                <input type="text" name="visi" id="visi" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" value="{{ old('visi', $settings['visi'] ?? '') }}" required>
            </div>
            <div class="mb-4">
                <label for="misi" class="block text-gray-700 font-medium mb-2">Misi</label>
                <textarea name="misi" id="misi" rows="5" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" required>{{ old('misi', $settings['misi'] ?? '') }}</textarea>
                <p class="text-gray-500 text-xs mt-1">Tulis setiap misi dalam baris baru.</p>
            </div>
            <div class="mb-4">
                <label for="org_structure_text" class="block text-gray-700 font-medium mb-2">Penjelasan Struktur Organisasi</label>
                <textarea name="org_structure_text" id="org_structure_text" rows="3" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" required>{{ old('org_structure_text', $settings['org_structure_text'] ?? '') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="org_structure_image" class="block text-gray-700 font-medium mb-2">Gambar Struktur Organisasi</label>
                @if(isset($settings['org_structure_image']))
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $settings['org_structure_image']) }}" alt="Struktur Organisasi" class="w-auto h-40 rounded-lg shadow-md">
                    </div>
                @endif
                <input type="file" name="org_structure_image" id="org_structure_image" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200">
                <p class="text-gray-500 text-xs mt-1">Unggah file gambar baru untuk menggantikan yang lama.</p>
                @if(isset($settings['org_structure_image']))
                    <div class="mt-2 flex items-center space-x-2">
                        <input type="checkbox" name="remove_org_structure_image" id="remove_org_structure_image" value="1" class="rounded text-red-500 focus:ring-red-500">
                        <label for="remove_org_structure_image" class="text-red-500">Hapus gambar ini</label>
                    </div>
                @endif
            </div>
            <div class="mb-6">
                <label for="tugas_fungsi" class="block text-gray-700 font-medium mb-2">Tugas dan Fungsi</label>
                <textarea name="tugas_fungsi" id="tugas_fungsi" rows="5" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" required>{{ old('tugas_fungsi', $settings['tugas_fungsi'] ?? '') }}</textarea>
                <p class="text-gray-500 text-xs mt-1">Tulis setiap tugas dan fungsi dalam baris baru.</p>
            </div>
            
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="fas fa-save mr-2"></i> Perbarui Pengaturan
            </button>
        </form>
    </div>
@endsection
