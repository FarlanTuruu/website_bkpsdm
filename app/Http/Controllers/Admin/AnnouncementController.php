<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use App\Models\Setting;
use App\Services\WhatsAppGatewayService;

// Kontroler untuk mengelola Pengumuman (CRUD)
class AnnouncementController extends Controller
{
    protected function sendAnnouncementWhatsAppNotification(Announcement $announcement): ?string
    {
        $service = app(WhatsAppGatewayService::class);

        if (!$service->isConfiguredAndEnabled()) {
            return null;
        }

        $targetsSetting = (string) (Setting::where('name', 'whatsapp_default_targets')->value('value') ?? '');
        $targets = $service->parseTargets($targetsSetting);

        if (empty($targets)) {
            return 'Notifikasi WhatsApp tidak dikirim karena nomor tujuan default belum diisi.';
        }

        $publishDate = $announcement->publish_date
            ? Carbon::parse($announcement->publish_date)->format('d-m-Y')
            : '-';
        $preview = Str::limit(trim(strip_tags((string) $announcement->content)), 180);

        $publicUrl = route('pengumuman.show', $announcement->slug);
        $template = (string) (Setting::where('name', 'whatsapp_announcement_template')->value('value') ?? '');

        if ($template === '') {
            $template = "*Pengumuman Baru Dipublikasikan*\nJudul: {title}\nPreview: {preview}\nTanggal Terbit: {publish_date}\nLihat detail: {url}\nStatus: {status}";
        }

        $message = $service->renderTemplate($template, [
            'title' => $announcement->title,
            'preview' => $preview,
            'publish_date' => $publishDate,
            'url' => $publicUrl,
            'status' => $announcement->status,
        ]);

        $result = $service->sendBulk($targets, $message);

        if ($result['ok']) {
            return null;
        }

        return $result['message'];
    }

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
            'attachment' => 'nullable|mimes:pdf|max:10240',
            'publish_date' => 'nullable|string',
        ]);

        // File uploads (image/attachment) tidak boleh langsung masuk ke mass assignment.
        // Path akan diisi setelah file dipindahkan ke disk public.
        unset($validated['image']);
        unset($validated['attachment']);

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

        // Jika ada gambar yang diunggah, simpan ke storage publik
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/announcements');
            $validated['image'] = str_replace('public/', '', $path);
        }

        // Jika ada file PDF yang diunggah, simpan ke storage publik
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('public/announcements');
            $validated['attachment'] = str_replace('public/', '', $path);
        }

        $announcement = Announcement::create($validated);

        $warning = null;
        if (($validated['status'] ?? null) === 'published') {
            $warning = $this->sendAnnouncementWhatsAppNotification($announcement);
        }

        return redirect()->route('announcements.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.')
            ->with('warning', $warning);
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
            'attachment' => 'nullable|mimes:pdf|max:10240',
            'publish_date' => 'nullable|string',
        ]);

        // Hindari menyimpan UploadedFile temporary path ke database.
        unset($validated['image']);
        unset($validated['attachment']);

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

        // Jika ada attachment baru (PDF)
        if ($request->hasFile('attachment')) {
            if ($announcement->attachment) {
                Storage::delete('public/' . $announcement->attachment);
            }
            $path = $request->file('attachment')->store('public/announcements');
            $validated['attachment'] = str_replace('public/', '', $path);
        }

        $wasPublished = $announcement->status === 'published';

        // Update data pengumuman
        $announcement->update($validated);

        $warning = null;
        if (($validated['status'] ?? null) === 'published' && !$wasPublished) {
            $warning = $this->sendAnnouncementWhatsAppNotification($announcement);
        }

        return redirect()->route('announcements.index')
            ->with('success', 'Pengumuman berhasil diperbarui.')
            ->with('warning', $warning);
    }


    // Menghapus pengumuman dari database
    public function destroy(Announcement $announcement)
    {
        if ($announcement->image) {
            Storage::delete('public/' . $announcement->image);
        }
        if ($announcement->attachment) {
            Storage::delete('public/' . $announcement->attachment);
        }
        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
