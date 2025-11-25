<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

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
    // Validasi awal
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'required|in:draft,published',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'publish_date' => 'nullable|string',
    ]);

    // Jika tanggal diisi, lakukan validasi manual
    if ($request->filled('publish_date')) {
        try {
            $date = Carbon::createFromFormat('d-m-Y', $request->publish_date);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'publish_date' => 'Format tanggal tidak valid. Gunakan format DD-MM-YYYY.',
            ]);
        }

        $today = Carbon::today();
        $maxDate = $today->copy()->addYear();

        if ($date->lessThan($today)) {
            throw ValidationException::withMessages([
                'publish_date' => 'Tanggal, Bulan, Tahun tidak boleh di masa lalu.',
            ]);
        }

        if ($date->greaterThan($maxDate)) {
            throw ValidationException::withMessages([
                'publish_date' => 'Tanggal, Bulan, Tahun tidak boleh lebih dari 1 tahun ke depan.',
            ]);
        }

        // Simpan tanggal dalam format database (Y-m-d)
        $validated['publish_date'] = $date->format('Y-m-d');
    }

    Announcement::create($validated);

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
    // Memperbarui pengumuman di database
public function update(Request $request, Announcement $announcement)
{
    // Validasi awal
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'required|in:draft,published',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'publish_date' => 'nullable|string',
    ]);

    // Jika tanggal diisi, lakukan validasi format dan batasan waktu
    if ($request->filled('publish_date')) {
        try {
            // Konversi dari format D-M-Y ke Carbon
            $date = Carbon::createFromFormat('d-m-Y', $request->publish_date);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'publish_date' => 'Format tanggal tidak valid. Gunakan format DD-MM-YYYY.',
            ]);
        }

        $today = Carbon::today();
        $maxDate = $today->copy()->addYear();

        // Validasi batas bawah (tidak boleh masa lalu)
        if ($date->lessThan($today)) {
            throw ValidationException::withMessages([
                'publish_date' => 'Tanggal, Bulan, Tahun tidak boleh di masa lalu.',
            ]);
        }

        // Validasi batas atas (tidak boleh lebih dari 1 tahun ke depan)
        if ($date->greaterThan($maxDate)) {
            throw ValidationException::withMessages([
                'publish_date' => 'Tanggal, Bulan, Tahun tidak boleh lebih dari 1 tahun ke depan.',
            ]);
        }

        // Simpan ke format database (Y-m-d)
        $validated['publish_date'] = $date->format('Y-m-d');
    }

    // Jika ada gambar baru
    if ($request->hasFile('image')) {
        if ($announcement->image) {
            Storage::delete('public/' . $announcement->image);
        }
        $path = $request->file('image')->store('public/announcements');
        $validated['image'] = str_replace('public/', '', $path);
    }

    // Update data pengumuman
    $announcement->update($validated);

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
