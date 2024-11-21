<?php

namespace MrLks\CloudflareTurnstileLaravel\Rules;

use Illuminate\Contracts\Validation\Rule;
use MrLks\CloudflareTurnstileLaravel\Facades\Turnstile;

class TurnstileRule implements Rule
{
    public function passes($attribute, $value)
    {
        return Turnstile::verify($value);
    }

    public function message()
    {
        return 'The Turnstile verification failed.';
    }
}