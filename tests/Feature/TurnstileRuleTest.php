<?php

namespace MrLks\CloudflareTurnstileLaravel\Tests\Feature;

use MrLks\CloudflareTurnstileLaravel\Rules\TurnstileRule;
use MrLks\CloudflareTurnstileLaravel\Tests\TestCase;
use MrLks\CloudflareTurnstileLaravel\Facades\Turnstile;

class TurnstileRuleTest extends TestCase
{
    public function test_validation_passes_with_valid_token()
    {
        Turnstile::shouldReceive('verify')
            ->once()
            ->with('valid_token')
            ->andReturn(true);

        $rule = new TurnstileRule();
        $this->assertTrue($rule->passes('turnstile', 'valid_token'));
    }

    public function test_validation_fails_with_invalid_token()
    {
        Turnstile::shouldReceive('verify')
            ->once()
            ->with('invalid_token')
            ->andReturn(false);

        $rule = new TurnstileRule();
        $this->assertFalse($rule->passes('turnstile', 'invalid_token'));
    }

    public function test_validation_message()
    {
        $rule = new TurnstileRule();
        $this->assertEquals('The Turnstile verification failed.', $rule->message());
    }
}