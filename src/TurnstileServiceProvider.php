<?php

namespace MrLks\CloudflareTurnstileLaravel;

use Illuminate\Support\ServiceProvider;
use MrLks\CloudflareTurnstileLaravel\Http\Middleware\TurnstileMiddleware;

class TurnstileServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/turnstile.php',
            'turnstile'
        );

        $this->app->singleton('turnstile', function ($app) {
            return new Turnstile();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/turnstile.php' => config_path('turnstile.php'),
        ], 'config');

        // Register the middleware
        $this->app['router']->aliasMiddleware('turnstile', TurnstileMiddleware::class);
    }
}