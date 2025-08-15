@extends('admin.layouts.app')

@section('page-title', 'Daftar Pengumuman')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Manajemen Pengumuman</h3>
            <a href="{{ route('announcements.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="fas fa-plus mr-2"></i> Tambah Pengumuman
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Judul</th>
                        <th class="py-3 px-6 text-left">Tanggal Terbit</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($announcements as $announcement)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    {{-- PERBAIKAN: Mengubah tautan agar mengarah ke halaman edit --}}
                                    <a href="{{ route('announcements.edit', $announcement->id) }}" class="font-medium hover:text-blue-600">
                                        {{ \Illuminate\Support\Str::limit($announcement->title, 50) }}
                                    </a>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ \Carbon\Carbon::parse($announcement->publish_date)->format('d M Y') }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span class="py-1 px-3 rounded-full text-xs font-semibold
                                    @if($announcement->status === 'published') bg-green-200 text-green-600 @else bg-yellow-200 text-yellow-600 @endif">
                                    {{ ucfirst($announcement->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center space-x-2">
                                    <a href="{{ route('announcements.edit', $announcement->id) }}" class="w-8 h-8 rounded-full bg-yellow-200 text-yellow-600 hover:bg-yellow-300 flex items-center justify-center transition duration-200">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?');">
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
        <div class="mt-4">
            {{ $announcements->links() }}
        </div>
    </div>
@endsection
