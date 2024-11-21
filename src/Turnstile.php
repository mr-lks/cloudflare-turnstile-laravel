<?php

namespace MrLks\CloudflareTurnstileLaravel;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class Turnstile
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function verify(string $token): bool
    {
        $response = $this->client->post(config('turnstile.verify_url'), [
            'form_params' => [
                'secret' => config('turnstile.secret_key'),
                'response' => $token,
                'remoteip' => request()->ip(),
            ],
        ]);

        $body = json_decode($response->getBody(), true);

        return $body['success'] ?? false;
    }

    public function renderWidget(array $attributes = []): string
    {
        $defaultAttributes = [
            'class' => 'cf-turnstile',
            'data-sitekey' => config('turnstile.site_key'),
            'data-theme' => config('turnstile.theme'),
            'data-size' => config('turnstile.size'),
        ];

        $mergedAttributes = array_merge($defaultAttributes, $attributes);
        $attributeString = $this->buildAttributeString($mergedAttributes);

        return "<div {$attributeString}></div>";
    }

    protected function buildAttributeString(array $attributes): string
    {
        return collect($attributes)
            ->map(fn($value, $key) => "{$key}=\"{$value}\"")
            ->implode(' ');
    }
}