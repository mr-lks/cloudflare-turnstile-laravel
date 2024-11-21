<?php

namespace MrLks\CloudflareTurnstileLaravel\Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use MrLks\CloudflareTurnstileLaravel\Turnstile;
use MrLks\CloudflareTurnstileLaravel\Tests\TestCase;

class TurnstileTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_it_can_render_widget()
    {
        $turnstile = new Turnstile();
        $html = $turnstile->renderWidget();

        $this->assertStringContainsString('class="cf-turnstile"', $html);
        $this->assertStringContainsString('data-sitekey="test_site_key"', $html);
    }

    public function test_it_can_render_widget_with_custom_attributes()
    {
        $turnstile = new Turnstile();
        $html = $turnstile->renderWidget([
            'data-theme' => 'dark',
            'data-size' => 'compact',
        ]);

        $this->assertStringContainsString('data-theme="dark"', $html);
        $this->assertStringContainsString('data-size="compact"', $html);
    }

    public function test_it_verifies_valid_token()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['success' => true])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $turnstile = $this->getMockBuilder(Turnstile::class)
            ->onlyMethods(['getHttpClient'])
            ->getMock();

        $turnstile->method('getHttpClient')
            ->willReturn($client);

        $this->assertTrue($turnstile->verify('valid_token'));
    }

    public function test_it_fails_invalid_token()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['success' => false])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $turnstile = $this->getMockBuilder(Turnstile::class)
            ->onlyMethods(['getHttpClient'])
            ->getMock();

        $turnstile->method('getHttpClient')
            ->willReturn($client);

        $this->assertFalse($turnstile->verify('invalid_token'));
    }
}