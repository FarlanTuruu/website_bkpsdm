<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Leader;
use App\Models\Setting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // Mengambil data pengaturan dengan nilai default
    private function getSettings()
    {
        $settings = Setting::pluck('value', 'name')->toArray();
        
        // Memberikan nilai default jika database kosong
        return array_merge([
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
            'hero_background_images' => '[]',
        ], $settings);
    }
    
    // Menampilkan halaman beranda
    public function index()
    {
        // Mengambil 3 pengumuman terbaru untuk halaman beranda
        $announcements = Announcement::where('status', 'published')->orderBy('publish_date', 'desc')->take(3)->get();
        $settings = $this->getSettings();
        $settings['hero_background_images'] = json_decode($settings['hero_background_images'], true);
        return view('index', compact('announcements', 'settings'));
    }

    // Menampilkan halaman profil BKPSDM
    public function profile()
    {
        $settings = $this->getSettings();
        return view('profil-bkpsdm', compact('settings'));
    }

    // Menampilkan halaman daftar pimpinan
    public function leaders()
    {
        $leaders = Leader::all();
        $settings = $this->getSettings();
        return view('profil-pimpinan', compact('leaders', 'settings'));
    }

    // Menampilkan halaman kontak
    public function contact()
    {
        $settings = $this->getSettings();
        return view('kontak', compact('settings'));
    }
}
