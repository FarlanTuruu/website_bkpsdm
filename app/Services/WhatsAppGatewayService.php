<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;

class WhatsAppGatewayService
{
    public function getSettings(): array
    {
        $keys = [
            'whatsapp_enabled',
            'whatsapp_api_url',
            'whatsapp_api_token',
            'whatsapp_default_targets',
            'whatsapp_country_code',
            'whatsapp_announcement_template',
        ];

        $settings = Setting::whereIn('name', $keys)->pluck('value', 'name')->toArray();

        return array_merge([
            'whatsapp_enabled' => '0',
            'whatsapp_api_url' => 'https://api.fonnte.com/send',
            'whatsapp_api_token' => '',
            'whatsapp_default_targets' => '',
            'whatsapp_country_code' => '62',
            'whatsapp_announcement_template' => "*Pengumuman Baru Dipublikasikan*\nJudul: {title}\nPreview: {preview}\nTanggal Terbit: {publish_date}\nLihat detail: {url}\nStatus: {status}",
        ], $settings);
    }

    public function parseTargets(string $targets): array
    {
        return collect(explode(',', $targets))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    public function isConfiguredAndEnabled(): bool
    {
        $settings = $this->getSettings();

        return (bool) $settings['whatsapp_enabled']
            && !empty($settings['whatsapp_api_url'])
            && !empty($settings['whatsapp_api_token']);
    }

    public function renderTemplate(string $template, array $data): string
    {
        $replace = [];

        foreach ($data as $key => $value) {
            $replace['{' . $key . '}'] = (string) $value;
        }

        return strtr($template, $replace);
    }

    public function sendBulk(array $targets, string $message): array
    {
        $settings = $this->getSettings();

        if (!(bool) $settings['whatsapp_enabled']) {
            return [
                'ok' => false,
                'message' => 'Fitur WhatsApp nonaktif.',
                'results' => [],
            ];
        }

        if (empty($settings['whatsapp_api_url']) || empty($settings['whatsapp_api_token'])) {
            return [
                'ok' => false,
                'message' => 'Konfigurasi WhatsApp belum lengkap (URL API / Token).',
                'results' => [],
            ];
        }

        if (empty($targets)) {
            return [
                'ok' => false,
                'message' => 'Nomor tujuan belum diisi.',
                'results' => [],
            ];
        }

        $results = [];
        $hasError = false;

        foreach ($targets as $target) {
            try {
                $response = Http::asForm()
                    ->timeout(20)
                    ->withHeaders([
                        'Authorization' => $settings['whatsapp_api_token'],
                    ])
                    ->post($settings['whatsapp_api_url'], [
                        'target' => $target,
                        'message' => $message,
                        'countryCode' => $settings['whatsapp_country_code'] ?? '62',
                    ]);

                $results[] = [
                    'target' => $target,
                    'success' => $response->successful(),
                    'status' => $response->status(),
                    'body' => $response->body(),
                ];

                if (!$response->successful()) {
                    $hasError = true;
                }
            } catch (\Throwable $th) {
                $hasError = true;

                $results[] = [
                    'target' => $target,
                    'success' => false,
                    'status' => 0,
                    'body' => $th->getMessage(),
                ];
            }
        }

        return [
            'ok' => !$hasError,
            'message' => !$hasError
                ? 'Semua pesan WhatsApp berhasil dikirim.'
                : 'Sebagian atau semua pesan WhatsApp gagal dikirim.',
            'results' => $results,
        ];
    }
}
