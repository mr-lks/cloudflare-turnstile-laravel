<?php

namespace MrLks\CloudflareTurnstileLaravel\Tests;

use MrLks\CloudflareTurnstileLaravel\TurnstileServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            TurnstileServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('turnstile.site_key', 'test_site_key');
        $app['config']->set('turnstile.secret_key', 'test_secret_key');
    }
}