<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

// Kontroler untuk mengelola Pengumuman (CRUD)
class AnnouncementController extends Controller
{
    // Menampilkan daftar pengumuman
    public function index()
    {
        $announcements = Announcement::orderBy('publish_date', 'desc')->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    // Menampilkan form untuk membuat pengumuman baru
    public function create()
    {
        return view('admin.announcements.create');
    }

    // Menyimpan pengumuman baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish_date' => 'required|date',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/announcements');
            $data['image'] = str_replace('public/', '', $path);
        }

        Announcement::create($data);

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    // Menampilkan halaman detail pengumuman (admin)
    // Metode ini ditambahkan untuk mengatasi error
    public function show(Announcement $announcement)
    {
        // Di halaman admin, tidak ada halaman "view" terpisah.
        // Maka, kita akan mengarahkan pengguna langsung ke halaman edit.
        return redirect()->route('announcements.edit', $announcement->id);
    }

    // Menampilkan form untuk mengedit pengumuman
    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    // Memperbarui pengumuman di database
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish_date' => 'required|date',
            'status' => 'required|in:draft,published',
        ]);
        
        $data = $request->all();
        
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($announcement->image) {
                Storage::delete('public/' . $announcement->image);
            }
            $path = $request->file('image')->store('public/announcements');
            $data['image'] = str_replace('public/', '', $path);
        }

        $announcement->update($data);

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    // Menghapus pengumuman dari database
    public function destroy(Announcement $announcement)
    {
        if ($announcement->image) {
            Storage::delete('public/' . $announcement->image);
        }
        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
