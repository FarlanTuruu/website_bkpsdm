@extends('admin.layouts.app')

@section('page-title', 'Daftar Pimpinan')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Manajemen Pimpinan</h3>
            <a href="{{ route('leaders.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="fas fa-plus mr-2"></i> Tambah Pimpinan
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Foto</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Jabatan</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($leaders as $leader)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <img src="{{ asset('storage/' . $leader->photo) }}" alt="{{ $leader->name }}" class="w-12 h-12 object-cover rounded-full">
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span class="font-medium">{{ $leader->name }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $leader->position }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center space-x-2">
                                    <a href="{{ route('leaders.edit', $leader->id) }}" class="w-8 h-8 rounded-full bg-yellow-200 text-yellow-600 hover:bg-yellow-300 flex items-center justify-center transition duration-200">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('leaders.destroy', $leader->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil pimpinan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-full bg-red-200 text-red-600 hover:bg-red-300 flex items-center justify-center transition duration-200">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection