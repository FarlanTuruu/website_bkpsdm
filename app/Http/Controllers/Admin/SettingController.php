<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // Ambil data pengaturan dari database
        $settings = Setting::pluck('value', 'name')->toArray();
        
        // Tetapkan nilai default jika tidak ada data di database
        $settings = array_merge([
            'website_name' => 'BKPSDM Kabupaten Sorong Selatan',
            'address' => 'Keyen, Kec. Teminabuan, Kabupaten Sorong Selatan, Papua Bar. 98454',
            'phone' => '081247451478',
            'email' => 'bkpsdm.sorsel24@gmail.com',
            'profile_bkpsdm' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia (BKPSDM) Kabupaten Sorong Selatan dibentuk berdasarkan Peraturan Daerah Kabupaten Sorong Selatan Nomor 8 Tahun 2016 tentang Pembentukan dan Susunan Perangkat Daerah Kabupaten Sorong Selatan. Sebelumya, urusan kepegawaian di Kabupaten Sorong Selatan ditangani oleh Badan Kepegawaian Daerah (BKD) yang kemudian berkembang menjadi BKPSDM untuk mengakomodasi kebutuhan pengembangan sumber daya manusia yang semakin kompleks. Transformasi ini sejalan dengan dinamika reformasi birokrasi dan tuntutan pelayanan publik yang semakin berkualitas, dimana pengelolaan SDM aparatur menjadi kunci utama keberhasilan pembangunan daerah.',
            'visi' => 'Terwujudnya Aparatur Sipil Negara yang Profesional, Berintegritas, dan Melayani untuk Makassar yang Maju, Sejahtera, dan Bermartabat',
            'misi' => '[]',
            'org_structure_image' => null,
            'org_structure_text' => 'Struktur organisasi BKPSDM Kabupaten Sorong Selatan dirancang untuk efisiensi dan koordinasi yang optimal dalam menjalankan tugas dan fungsi kepegawaian.',
            'tugas_fungsi' => '[]',
            'profile_image' => null,
            'global_background_image' => null,
            'hero_background_images' => '[]',
        ], $settings);
        
        // Mengonversi JSON menjadi teks multi-baris untuk tampilan di formulir
        $settings['misi'] = implode("\n", json_decode($settings['misi'] ?? '[]', true));
        $settings['tugas_fungsi'] = implode("\n", json_decode($settings['tugas_fungsi'] ?? '[]', true));
        
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'website_name' => 'required|string|max:255',
            'address' => 'required',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_bkpsdm' => 'required',
            'visi' => 'required|string',
            'misi' => 'required',
            'org_structure_text' => 'required',
            'tugas_fungsi' => 'required',
            'org_structure_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'global_background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_hero_images' => 'nullable|array',
            'hero_background_images' => 'nullable|array|max:5',
            'hero_background_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $data = $request->except([
            '_token', '_method', 
            'org_structure_image', 'remove_org_structure_image', 
            'profile_image', 'remove_profile_image',
            'global_background_image', 'remove_global_background_image',
            'hero_background_images', 'remove_hero_images'
        ]);

        // Mengonversi teks multi-baris menjadi JSON array sebelum disimpan
        $data['misi'] = json_encode(explode("\n", $request->input('misi')));
        $data['tugas_fungsi'] = json_encode(explode("\n", $request->input('tugas_fungsi')));

        // Handle file upload for hero images
        $existingImages = json_decode(Setting::where('name', 'hero_background_images')->first()->value ?? '[]', true);
        $removedImages = $request->input('remove_hero_images', []);
        
        $currentImages = array_filter($existingImages, function($image) use ($removedImages) {
            if (in_array($image, $removedImages)) {
                Storage::disk('public')->delete($image);
                return false;
            }
            return true;
        });

        if ($request->hasFile('hero_background_images')) {
            foreach ($request->file('hero_background_images') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('hero_backgrounds', 'public');
                    $currentImages[] = $path;
                }
            }
        }
        $data['hero_background_images'] = json_encode(array_values($currentImages));

        // Handle file upload for global background image
        if ($request->hasFile('global_background_image')) {
            $existingImage = Setting::where('name', 'global_background_image')->first();
            if ($existingImage && $existingImage->value) {
                Storage::disk('public')->delete($existingImage->value);
            }
            $path = $request->file('global_background_image')->store('global_backgrounds', 'public');
            $data['global_background_image'] = $path;
        } else {
            if ($request->input('remove_global_background_image')) {
                $existingImage = Setting::where('name', 'global_background_image')->first();
                if ($existingImage && $existingImage->value) {
                    Storage::disk('public')->delete($existingImage->value);
                    $existingImage->delete();
                }
                unset($data['global_background_image']);
            }
        }

        // Handle file upload for org structure image
        if ($request->hasFile('org_structure_image')) {
            $existingImage = Setting::where('name', 'org_structure_image')->first();
            if ($existingImage && $existingImage->value) {
                Storage::disk('public')->delete($existingImage->value);
            }
            $path = $request->file('org_structure_image')->store('settings', 'public');
            $data['org_structure_image'] = $path;
        } else {
            if ($request->input('remove_org_structure_image')) {
                $existingImage = Setting::where('name', 'org_structure_image')->first();
                if ($existingImage && $existingImage->value) {
                    Storage::disk('public')->delete($existingImage->value);
                    $existingImage->delete();
                }
                unset($data['org_structure_image']);
            }
        }

        // Handle file upload for profile image
        if ($request->hasFile('profile_image')) {
            $existingImage = Setting::where('name', 'profile_image')->first();
            if ($existingImage && $existingImage->value) {
                Storage::disk('public')->delete($existingImage->value);
            }
            $path = $request->file('profile_image')->store('settings', 'public');
            $data['profile_image'] = $path;
        } else {
            if ($request->input('remove_profile_image')) {
                $existingImage = Setting::where('name', 'profile_image')->first();
                if ($existingImage && $existingImage->value) {
                    Storage::disk('public')->delete($existingImage->value);
                    $existingImage->delete();
                }
                unset($data['profile_image']);
            }
        }
        
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['name' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
