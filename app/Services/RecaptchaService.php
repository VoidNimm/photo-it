<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RecaptchaService
{
    private string $secretKey;
    private string $siteKey;

    public function __construct()
    {
        $this->secretKey = config('services.recaptcha.secret_key');
        $this->siteKey = config('services.recaptcha.site_key');
    }

    public function verify(string $response, ?string $remoteIp = null): bool
    {
        if (empty($response)) {
            return false;
        }

        $data = [
            'secret' => $this->secretKey,
            'response' => $response,
        ];

        if ($remoteIp) {
            $data['remoteip'] = $remoteIp;
        }

        $result = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', $data);

        if ($result->successful()) {
            $body = $result->json();
            return isset($body['success']) && $body['success'] === true;
        }

        return false;
    }

    public function getSiteKey(): string
    {
        return $this->siteKey;
    }
}