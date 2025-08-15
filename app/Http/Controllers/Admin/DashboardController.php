<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Leader;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

// Kontroler untuk Dashboard Admin
class DashboardController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan data ringkasan di dashboard
        $announcementCount = Announcement::count();
        $leaderCount = Leader::count();
        $publishedCount = Announcement::where('status', 'published')->count();

        return view('admin.dashboard', compact('announcementCount', 'leaderCount', 'publishedCount'));
    }
}