<?php

namespace MrLks\CloudflareTurnstileLaravel\Tests\Feature;

use MrLks\CloudflareTurnstileLaravel\Tests\TestCase;
use MrLks\CloudflareTurnstileLaravel\Facades\Turnstile;

class TurnstileMiddlewareTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app['router']->post('/test-route', function () {
            return response()->json(['message' => 'success']);
        })->middleware('turnstile');
    }

    public function test_middleware_passes_with_valid_token()
    {
        Turnstile::shouldReceive('verify')
            ->once()
            ->with('valid_token')
            ->andReturn(true);

        $response = $this->postJson('/test-route', [
            'cf-turnstile-response' => 'valid_token'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'success']);
    }

    public function test_middleware_fails_with_invalid_token()
    {
        Turnstile::shouldReceive('verify')
            ->once()
            ->with('invalid_token')
            ->andReturn(false);

        $response = $this->postJson('/test-route', [
            'cf-turnstile-response' => 'invalid_token'
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'cf-turnstile-response'
            ]
        ]);
    }

    public function test_middleware_fails_with_missing_token()
    {
        $response = $this->postJson('/test-route', []);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'cf-turnstile-response'
            ]
        ]);
    }
}