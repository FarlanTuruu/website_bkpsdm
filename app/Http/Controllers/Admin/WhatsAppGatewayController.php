<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\WhatsAppGatewayService;
use Illuminate\Http\Request;

class WhatsAppGatewayController extends Controller
{
    public function __construct(private WhatsAppGatewayService $whatsAppGatewayService)
    {
    }

    public function index()
    {
        $settings = $this->whatsAppGatewayService->getSettings();

        return view('admin.whatsapp.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'whatsapp_enabled' => 'nullable|boolean',
            'whatsapp_api_url' => 'required|url|max:255',
            'whatsapp_api_token' => 'required|string|max:255',
            'whatsapp_default_targets' => 'nullable|string|max:2000',
            'whatsapp_country_code' => 'nullable|string|max:5',
            'whatsapp_announcement_template' => 'required|string|max:4000',
        ]);

        $validated['whatsapp_enabled'] = $request->boolean('whatsapp_enabled') ? '1' : '0';

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['name' => $key],
                ['value' => $value]
            );
        }

        return redirect()
            ->route('whatsapp.index')
            ->with('success', 'Pengaturan WhatsApp Gateway berhasil disimpan.');
    }

    public function test(Request $request)
    {
        $validated = $request->validate([
            'test_target' => 'required|string|max:50',
            'test_message' => 'required|string|max:2000',
        ]);

        $result = $this->whatsAppGatewayService->sendBulk([
            trim($validated['test_target'])
        ], $validated['test_message']);

        if ($result['ok']) {
            return redirect()
                ->route('whatsapp.index')
                ->with('success', 'Pesan tes WhatsApp berhasil dikirim ke nomor tujuan.');
        }

        return redirect()
            ->route('whatsapp.index')
            ->with('warning', 'Pesan tes WhatsApp gagal: ' . $result['message'])
            ->with('wa_test_results', $result['results']);
    }
}
