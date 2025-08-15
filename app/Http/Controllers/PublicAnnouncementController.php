<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class PublicAnnouncementController extends Controller
{
    /**
     * Menampilkan daftar semua pengumuman yang sudah terbit.
     */
    public function index()
    {
        // Mengambil pengumuman dengan status 'published' dan mengurutkannya
        $announcements = Announcement::where('status', 'published')->orderBy('publish_date', 'desc')->paginate(10);
        return view('pengumuman', compact('announcements'));
    }

    /**
     * Menampilkan satu pengumuman secara detail berdasarkan slug.
     */
    public function show($slug)
    {
        // Mencari pengumuman berdasarkan slug dan memastikan statusnya 'published'
        $announcement = Announcement::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('pengumuman-detail', compact('announcement'));
    }
}
