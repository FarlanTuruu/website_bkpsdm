@extends('admin.layouts.app')

@section('page-title', 'Edit Pengumuman')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold text-gray-800">
            Edit Pengumuman: {{ $announcement->title }}
        </h3>
        <a href="{{ route('announcements.index') }}" 
           class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-200">
           <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <form id="editForm" action="{{ route('announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">Judul</label>
            <input type="text" name="title" id="title"
                class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200"
                value="{{ old('title', $announcement->title) }}" required>
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-medium mb-2">Gambar Thumbnail</label>
            @if($announcement->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $announcement->image) }}" 
                         alt="Gambar saat ini" class="w-40 h-auto rounded-lg">
                </div>
            @endif
            <input type="file" name="image" id="image"
                class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200">
            <p class="text-gray-500 text-xs mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror

            {{-- Preview gambar baru --}}
            <div id="previewContainer" class="mt-2 hidden">
                <p class="text-gray-600 text-sm mb-1">Preview Gambar Baru:</p>
                <img id="imagePreview" class="w-40 h-auto rounded-lg border">
            </div>
        </div>

        {{-- Konten --}}
        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-medium mb-2">Konten</label>
            <textarea name="content" id="content" rows="10"
                class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200"
                required>{{ old('content', $announcement->content) }}</textarea>
            @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- ==============================
                FIELD: TANGGAL & STATUS
            =============================== --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="publish_date" class="block text-gray-700 font-medium mb-2">Tanggal Terbit</label>

                    {{-- =====================================================
                        ✳️ ORIGINAL CODE DENGAN DATEPICKER (DIKOMENTARI)
                        <input type="date" name="publish_date" id="publish_date"
                            class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200"
                            value="{{ old('publish_date', \Carbon\Carbon::parse($announcement->publish_date)->format('Y-m-d')) }}" required>
                    ====================================================== --}}

                    {{-- =====================================================
                        ✳️ MODIFIKASI: INPUT MANUAL FORMAT D-M-Y
                        - Gunakan type="text" agar tanggal bisa diketik manual.
                        - Placeholder membantu user tahu format yang benar.
                        - Cocok untuk pengujian Equivalence Partition & Boundary Value.
                        - Contoh valid: "21-10-2025"
                        - Contoh invalid: "2025-10-21"
                    ====================================================== --}}
                    <input type="text" name="publish_date" id="publish_date"
                        class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200"
                        value="{{ old('publish_date', \Carbon\Carbon::parse($announcement->publish_date)->format('d-m-Y')) }}" 
                        placeholder="Masukkan tanggal (format: Tanggal-Bulan-Tahun)" required>

                    @error('publish_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ==============================
                    FIELD: STATUS
                =============================== --}}
                <div>
                    <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                    <select name="status" id="status" 
                            class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" 
                            required>
                        <option value="draft" {{ old('status', $announcement->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $announcement->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        <button type="submit" 
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
            <i class="fas fa-save mr-2"></i> Perbarui Pengumuman
        </button>
    </form>
</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>

{{-- Script untuk Preview Gambar & Deteksi Perubahan --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('editForm');
        const originalData = {};
        const changedFields = new Set();

        // Simpan data awal
        form.querySelectorAll('input, textarea, select').forEach(field => {
            if (field.type !== 'file') {
                originalData[field.name] = field.value;
            }
        });

        // CKEditor change event
        CKEDITOR.instances.content.on('change', function () {
            const val = CKEDITOR.instances.content.getData();
            if (val !== originalData['content']) {
                changedFields.add('content');
            } else {
                changedFields.delete('content');
            }
            showChangeNotification();
        });

        // Event perubahan field biasa
        form.querySelectorAll('input, select').forEach(field => {
            field.addEventListener('change', function () {
                if (field.type !== 'file') {
                    if (field.value !== originalData[field.name]) {
                        changedFields.add(field.name);
                    } else {
                        changedFields.delete(field.name);
                    }
                } else {
                    changedFields.add(field.name);
                }
                showChangeNotification();
            });
        });

        // Preview gambar baru
        document.getElementById('image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('previewContainer');
            const previewImg = document.getElementById('imagePreview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    previewImg.src = event.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        });

        // Notifikasi perubahan
        function showChangeNotification() {
            let notifBar = document.getElementById('changeNotif');
            if (!notifBar) {
                notifBar = document.createElement('div');
                notifBar.id = 'changeNotif';
                notifBar.className = 'fixed bottom-5 right-5 z-50 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 px-4 py-3 rounded shadow-lg text-sm';
                document.body.appendChild(notifBar);
            }

            if (changedFields.size > 0) {
                notifBar.innerHTML = `
                    <strong>Perubahan terdeteksi:</strong><br>
                    ${Array.from(changedFields).join(', ')}
                `;
                notifBar.style.display = 'block';
            } else {
                notifBar.style.display = 'none';
            }
        }

        // Konfirmasi sebelum submit
        form.addEventListener('submit', function (e) {
            const contentVal = CKEDITOR.instances.content.getData();
            if (contentVal !== originalData['content']) {
                changedFields.add('content');
            }

            if (changedFields.size > 0) {
                const confirmMsg = `Apakah Anda yakin ingin memperbarui kolom berikut?\n\n- ${Array.from(changedFields).join('\n- ')}`;
                if (!confirm(confirmMsg)) {
                    e.preventDefault();
                }
            } else {
                if (!confirm("Tidak ada perubahan terdeteksi. Lanjutkan menyimpan?")) {
                    e.preventDefault();
                }
            }
        });
    });

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
@endsection
