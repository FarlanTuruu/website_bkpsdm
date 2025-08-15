@extends('admin.layouts.app')

@section('page-title', 'Edit Pimpinan')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Edit Pimpinan: {{ $leader->name }}</h3>
            <a href="{{ route('leaders.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <form action="{{ route('leaders.update', $leader->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" value="{{ old('name', $leader->name) }}" required>
                </div>
                <div class="mb-4">
                    <label for="position" class="block text-gray-700 font-medium mb-2">Jabatan</label>
                    <input type="text" name="position" id="position" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" value="{{ old('position', $leader->position) }}" required>
                </div>
                <div class="mb-4">
                    <label for="birth_place" class="block text-gray-700 font-medium mb-2">Tempat Lahir</label>
                    <input type="text" name="birth_place" id="birth_place" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" value="{{ old('birth_place', $leader->birth_place) }}">
                </div>
                <div class="mb-4">
                    <label for="birth_date" class="block text-gray-700 font-medium mb-2">Tanggal Lahir</label>
                    <input type="date" name="birth_date" id="birth_date" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" value="{{ old('birth_date', optional($leader->birth_date)->format('Y-m-d')) }}">
                </div>
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-gray-700 font-medium mb-2">Foto Pimpinan</label>
                @if($leader->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $leader->photo) }}" alt="Foto {{ $leader->name }}" class="w-40 h-40 object-cover rounded-lg">
                    </div>
                @endif
                <input type="file" name="photo" id="photo" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200">
                <p class="text-gray-500 text-xs mt-1">Biarkan kosong jika tidak ingin mengubah foto.</p>
            </div>

            <div class="mb-4">
                <label for="education" class="block text-gray-700 font-medium mb-2">Riwayat Pendidikan</label>
                <textarea name="education" id="education" rows="5" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200">{{ old('education', $leader->education) }}</textarea>
                <p class="text-gray-500 text-xs mt-1">Tulis setiap riwayat pendidikan dalam baris baru.</p>
            </div>

            <div class="mb-4">
                <label for="career" class="block text-gray-700 font-medium mb-2">Riwayat Karir</label>
                <textarea name="career" id="career" rows="5" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200">{{ old('career', $leader->career) }}</textarea>
                <p class="text-gray-500 text-xs mt-1">Tulis setiap riwayat karir dalam baris baru.</p>
            </div>
            
            <div class="mb-6">
                <label for="achievements" class="block text-gray-700 font-medium mb-2">Prestasi</label>
                <textarea name="achievements" id="achievements" rows="5" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200">{{ old('achievements', $leader->achievements) }}</textarea>
                <p class="text-gray-500 text-xs mt-1">Tulis setiap prestasi dalam baris baru.</p>
            </div>
            
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="fas fa-save mr-2"></i> Perbarui Pimpinan
            </button>
        </form>
    </div>
@endsection
