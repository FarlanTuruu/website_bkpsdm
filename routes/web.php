<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\LeaderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PublicAnnouncementController;

// ===================================
// Rute untuk Frontend (Website Publik) - DITEMPATKAN DI ATAS RUTE ADMIN
// ===================================
Route::get('/', [FrontendController::class, 'index'])->name('homepage');
Route::get('/profil-bkpsdm', [FrontendController::class, 'profile'])->name('profile');
Route::get('/profil-pimpinan', [FrontendController::class, 'leaders'])->name('leaders.page');

// Rute Pengumuman Publik yang terpisah
// Nama rute diubah menjadi pengumuman.index dan pengumuman.show
Route::get('/pengumuman', [PublicAnnouncementController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{slug}', [PublicAnnouncementController::class, 'show'])->name('pengumuman.show');

Route::get('/kontak', [FrontendController::class, 'contact'])->name('contact.page');

// Rute Otentikasi Laravel
Auth::routes();

// ===================================
// Rute untuk Backend (CMS Admin)
// ===================================
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('announcements', AdminAnnouncementController::class);
    Route::resource('leaders', LeaderController::class);
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});
