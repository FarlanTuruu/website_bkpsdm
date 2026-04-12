@extends('admin.layouts.app')

@section('page-title', 'WhatsApp Gateway')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Konfigurasi WhatsApp API/Gateway</h3>
        <p class="text-sm text-gray-500 mb-6">
            Konfigurasi default menggunakan format API Fonnte.
            Jika Anda memakai provider lain, sesuaikan URL API dan token sesuai dokumentasi provider.
        </p>

        <form action="{{ route('whatsapp.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-3">
                <input type="checkbox" name="whatsapp_enabled" id="whatsapp_enabled" value="1"
                    {{ old('whatsapp_enabled', $settings['whatsapp_enabled']) == '1' ? 'checked' : '' }}
                    class="h-4 w-4 text-green-600 border-gray-300 rounded">
                <label for="whatsapp_enabled" class="text-gray-700 font-medium">Aktifkan Notifikasi WhatsApp</label>
            </div>

            <div>
                <label for="whatsapp_api_url" class="block text-gray-700 font-medium mb-2">URL API Gateway</label>
                <input type="url" name="whatsapp_api_url" id="whatsapp_api_url"
                    value="{{ old('whatsapp_api_url', $settings['whatsapp_api_url']) }}"
                    class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" required>
                @error('whatsapp_api_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="whatsapp_api_token" class="block text-gray-700 font-medium mb-2">Token API</label>
                <input type="text" name="whatsapp_api_token" id="whatsapp_api_token"
                    value="{{ old('whatsapp_api_token', $settings['whatsapp_api_token']) }}"
                    class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" required>
                @error('whatsapp_api_token')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="whatsapp_default_targets" class="block text-gray-700 font-medium mb-2">Nomor Tujuan Default</label>
                <textarea name="whatsapp_default_targets" id="whatsapp_default_targets" rows="3"
                    class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200"
                    placeholder="Contoh: 6281234567890,6287788899900">{{ old('whatsapp_default_targets', $settings['whatsapp_default_targets']) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Pisahkan lebih dari satu nomor dengan koma (,).</p>
                @error('whatsapp_default_targets')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="whatsapp_country_code" class="block text-gray-700 font-medium mb-2">Kode Negara</label>
                <input type="text" name="whatsapp_country_code" id="whatsapp_country_code"
                    value="{{ old('whatsapp_country_code', $settings['whatsapp_country_code']) }}"
                    class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200">
                @error('whatsapp_country_code')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="whatsapp_announcement_template" class="block text-gray-700 font-medium mb-2">Template Pesan Announcement</label>
                <textarea name="whatsapp_announcement_template" id="whatsapp_announcement_template" rows="6"
                    class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200"
                    required>{{ old('whatsapp_announcement_template', $settings['whatsapp_announcement_template'] ?? "*Pengumuman Baru Dipublikasikan*\nJudul: {title}\nPreview: {preview}\nTanggal Terbit: {publish_date}\nLihat detail: {url}\nStatus: {status}") }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Placeholder yang bisa dipakai: {title}, {preview}, {publish_date}, {url}, {status}</p>
                <p class="text-xs text-gray-500 mt-1">{preview} akan diisi otomatis dari ringkasan isi announcement (potongan konten).</p>
                @error('whatsapp_announcement_template')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="border border-gray-200 rounded-lg bg-gray-50 p-4">
                <h4 class="text-sm font-semibold text-gray-700 mb-2">Live Preview Pesan</h4>
                <p class="text-xs text-gray-500 mb-3">Preview ini simulasi hasil placeholder menggunakan contoh data announcement.</p>
                <pre id="wa-template-preview" class="whitespace-pre-wrap break-words text-sm text-gray-800 leading-relaxed"></pre>
            </div>

            <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="fas fa-save mr-2"></i> Simpan Konfigurasi
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Uji Kirim WhatsApp</h3>
        <p class="text-sm text-gray-500 mb-6">
            Gunakan bagian ini untuk memastikan gateway aktif dan kredensial benar.
        </p>

        <form action="{{ route('whatsapp.test') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="test_target" class="block text-gray-700 font-medium mb-2">Nomor Tujuan Test</label>
                <input type="text" name="test_target" id="test_target"
                    value="{{ old('test_target') }}"
                    placeholder="Contoh: 6281234567890"
                    class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200" required>
                @error('test_target')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="test_message" class="block text-gray-700 font-medium mb-2">Pesan Test</label>
                <textarea name="test_message" id="test_message" rows="4"
                    class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200"
                    required>{{ old('test_message', 'Tes notifikasi WhatsApp dari sistem pengumuman BKPSDM.') }}</textarea>
                @error('test_message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full sm:w-auto bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-200">
                <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan Test
            </button>
        </form>

        @if (session('wa_test_results'))
            <div class="mt-6 border border-gray-200 rounded-lg p-4">
                <h4 class="font-semibold text-gray-700 mb-3">Detail Respon Test:</h4>
                <div class="space-y-2 text-sm">
                    @foreach (session('wa_test_results') as $result)
                        <div class="border rounded p-2 {{ $result['success'] ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }}">
                            <p><span class="font-medium">Target:</span> {{ $result['target'] }}</p>
                            <p><span class="font-medium">HTTP Status:</span> {{ $result['status'] }}</p>
                            <p class="break-all"><span class="font-medium">Response:</span> {{ $result['body'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const templateInput = document.getElementById('whatsapp_announcement_template');
    const previewBox = document.getElementById('wa-template-preview');

    if (!templateInput || !previewBox) {
        return;
    }

    const sampleData = {
        title: 'Pengumuman Seleksi Administrasi CPNS 2026',
        preview: 'Peserta diminta memeriksa kelengkapan dokumen dan jadwal tahapan lanjutan melalui portal resmi BKPSDM.',
        publish_date: '09-04-2026',
        url: "{{ url('/pengumuman/contoh-announcement') }}",
        status: 'published'
    };

    function renderPreview() {
        let text = templateInput.value || '';

        Object.keys(sampleData).forEach(function (key) {
            const pattern = new RegExp('\\\\{' + key + '\\\\}', 'g');
            text = text.replace(pattern, sampleData[key]);
        });

        previewBox.textContent = text;
    }

    templateInput.addEventListener('input', renderPreview);
    renderPreview();
});
</script>
@endsection
