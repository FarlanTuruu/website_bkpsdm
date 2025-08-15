<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeaderController extends Controller
{
    // Menampilkan daftar pimpinan
    public function index()
    {
        $leaders = Leader::all();
        return view('admin.leaders.index', compact('leaders'));
    }

    // Menampilkan form untuk membuat profil pimpinan baru
    public function create()
    {
        return view('admin.leaders.create');
    }

    // Menyimpan profil pimpinan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birth_place' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'education' => 'nullable', // Validasi diubah
            'career' => 'nullable', // Validasi diubah
            'achievements' => 'nullable', // Validasi diubah
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/leaders');
            $data['photo'] = str_replace('public/', '', $path);
        }
        
        // Mengonversi teks multi-baris menjadi JSON array sebelum disimpan
        $data['education'] = json_encode(explode("\n", $request->input('education')));
        $data['career'] = json_encode(explode("\n", $request->input('career')));
        $data['achievements'] = json_encode(explode("\n", $request->input('achievements')));
        
        Leader::create($data);

        return redirect()->route('leaders.index')->with('success', 'Profil pimpinan berhasil ditambahkan.');
    }

    // Menampilkan halaman detail pengumuman (admin)
    public function show(Leader $leader)
    {
        return redirect()->route('leaders.edit', $leader->id);
    }

    // Menampilkan form untuk mengedit profil pimpinan
    public function edit(Leader $leader)
    {
        // Mengonversi JSON menjadi teks multi-baris untuk tampilan di formulir
        $leader->education = implode("\n", json_decode($leader->education, true));
        $leader->career = implode("\n", json_decode($leader->career, true));
        $leader->achievements = implode("\n", json_decode($leader->achievements, true));
        
        return view('admin.leaders.edit', compact('leader'));
    }

    // Memperbarui profil pimpinan di database
    public function update(Request $request, Leader $leader)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birth_place' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'education' => 'nullable', // Validasi diubah
            'career' => 'nullable', // Validasi diubah
            'achievements' => 'nullable', // Validasi diubah
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            if ($leader->photo) {
                Storage::delete('public/' . $leader->photo);
            }
            $path = $request->file('photo')->store('public/leaders');
            $data['photo'] = str_replace('public/', '', $path);
        }
        
        // Mengonversi teks multi-baris menjadi JSON array sebelum disimpan
        $data['education'] = json_encode(explode("\n", $request->input('education')));
        $data['career'] = json_encode(explode("\n", $request->input('career')));
        $data['achievements'] = json_encode(explode("\n", $request->input('achievements')));
        
        $leader->update($data);

        return redirect()->route('leaders.index')->with('success', 'Profil pimpinan berhasil diperbarui.');
    }

    // Menghapus profil pimpinan dari database
    public function destroy(Leader $leader)
    {
        if ($leader->photo) {
            Storage::delete('public/' . $leader->photo);
        }
        $leader->delete();

        return redirect()->route('leaders.index')->with('success', 'Profil pimpinan berhasil dihapus.');
    }
}
