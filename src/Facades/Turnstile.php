<?php

namespace MrLks\CloudflareTurnstileLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class Turnstile extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'turnstile';
    }
}