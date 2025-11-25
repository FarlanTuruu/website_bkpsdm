@extends('admin.layouts.app')

@section('page-title', 'Tambah Pengumuman')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold text-gray-800">Tambah Pengumuman Baru</h3>
        <a href="{{ route('announcements.index') }}" 
           class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ===============================
            FIELD: JUDUL
        ================================ --}}
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">Judul</label>
            <input type="text" name="title" id="title" 
                class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" 
                value="{{ old('title') }}" required>
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- ===============================
            FIELD: GAMBAR
        ================================ --}}
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-medium mb-2">Gambar Thumbnail</label>
            <input type="file" name="image" id="image"
                   class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200">
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- ===============================
            FIELD: KONTEN
        ================================ --}}
        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-medium mb-2">Konten</label>
            <textarea name="content" id="content" rows="10" 
                class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" 
                required>{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- ===============================
            FIELD: TANGGAL & STATUS
        ================================ --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label for="publish_date" class="block text-gray-700 font-medium mb-2">Tanggal Terbit</label>

                {{-- =====================================================
                    ✳️ ORIGINAL CODE DENGAN DATEPICKER (DIKOMENTARI)
                    <input type="date" name="publish_date" id="publish_date"
                        class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200"
                        value="{{ old('publish_date') }}" required>
                ====================================================== --}}

                {{-- =====================================================
                    ✳️ MODIFIKASI:
                    - Type diubah ke text agar user isi manual.
                    - Format D-M-Y.
                    - Default kosong (tidak ada value).
                    - Cocok untuk pengujian input manual.
                ====================================================== --}}
                <input type="text" name="publish_date" id="publish_date"
                    class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200"
                    value="{{ old('publish_date') }}"
                    placeholder="Masukkan tanggal (format: Tanggal-Bulan-Tahun)" required>

                @error('publish_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                <select name="status" id="status"
                        class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200"
                        required>
                    <option value="">-- Pilih Status --</option>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" 
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
            <i class="fas fa-save mr-2"></i> Simpan Pengumuman
        </button>
    </form>
</div>

{{-- ===============================
    SCRIPT: CKEDITOR
=============================== --}}
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const publishInput = document.getElementById('publish_date');

    form.addEventListener('submit', function(e) {
        const val = publishInput.value.trim();
        if (val === '') return; // Boleh kosong

        const regex = /^(\d{1,2})-(\d{1,2})-(\d{4})$/;
        const match = val.match(regex);
        if (!match) {
            alert('Format tanggal tidak valid. Gunakan format DD-MM-YYYY.');
            e.preventDefault();
            return;
        }

        const day = parseInt(match[1]);
        const month = parseInt(match[2]) - 1; // JS months start from 0
        const year = parseInt(match[3]);
        const inputDate = new Date(year, month, day);

        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const maxDate = new Date();
        maxDate.setFullYear(today.getFullYear() + 1);

        if (inputDate < today) {
            alert('Tanggal, bulan, tahun tidak boleh di masa lalu.');
            e.preventDefault();
            return;
        }
        if (inputDate > maxDate) {
            alert('Tanggal tidak boleh lebih dari 1 tahun ke depan.');
            e.preventDefault();
            return;
        }
    });
});
</script>

</script>
@endsection