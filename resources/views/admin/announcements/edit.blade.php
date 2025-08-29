@extends('admin.layouts.app')

@section('page-title', 'Edit Pengumuman')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Edit Pengumuman: {{ $announcement->title }}</h3>
            <a href="{{ route('announcements.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Judul</label>
                <input type="text" name="title" id="title" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" value="{{ old('title', $announcement->title) }}" required>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-medium mb-2">Gambar Thumbnail</label>
                @if($announcement->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $announcement->image) }}" alt="Gambar saat ini" class="w-40 h-auto rounded-lg">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200">
                <p class="text-gray-500 text-xs mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-medium mb-2">Konten</label>
                <!-- Anda bisa mengganti ini dengan editor WYSIWYG seperti Trix atau TinyMCE -->
                <textarea name="content" id="content" rows="10" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" required>{{ old('content', $announcement->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="publish_date" class="block text-gray-700 font-medium mb-2">Tanggal Terbit</label>
                    <input type="date" name="publish_date" id="publish_date" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" value="{{ old('publish_date', $announcement->publish_date->format('Y-m-d')) }}" required>
                    @error('publish_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                    <select name="status" id="status" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" required>
                        <option value="draft" {{ old('status', $announcement->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $announcement->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="fas fa-save mr-2"></i> Perbarui Pengumuman
            </button>
        </form>
    </div>

    {{-- Script TinyMCE --}}
    {{-- Perbaikan: Menggunakan skrip TinyMCE versi 4.0 yang tidak memerlukan kunci API atau validasi domain --}}
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
