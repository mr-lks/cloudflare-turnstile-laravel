# Laravel Cloudflare Turnstile

<div align="center">

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mrlks/cloudflare-turnstile-laravel.svg)](https://packagist.org/packages/mrlks/cloudflare-turnstile-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/mrlks/cloudflare-turnstile-laravel.svg)](https://packagist.org/packages/mrlks/cloudflare-turnstile-laravel)
[![License](https://img.shields.io/packagist/l/mrlks/cloudflare-turnstile-laravel.svg)](LICENSE.md)

</div>

A Laravel package that provides an elegant way to integrate Cloudflare Turnstile CAPTCHA protection into your Laravel applications. Turnstile is Cloudflare's privacy-first CAPTCHA alternative that helps protect your forms from spam and abuse.

## Features

- 🚀 Easy integration with Laravel forms
- 🛡️ Middleware for route protection
- ⚡ Simple validation rules
- 🎨 Customizable widget appearance
- 🔧 Configurable settings

## Requirements

- PHP ^8.1
- Laravel ^10.0

## Installation

You can install the package via composer:

```bash
composer require mrlks/cloudflare-turnstile-laravel
```

## Configuration

1. Publish the configuration file:

```bash
php artisan vendor:publish --provider="MrLks\CloudflareTurnstileLaravel\TurnstileServiceProvider"
```

2. Add your Cloudflare Turnstile credentials to your `.env` file:

TURNSTILE_SITE_KEY=your-site-key
TURNSTILE_SECRET_KEY=your-secret-key

## Usage

### Basic Form Integration

1. Add the Turnstile widget to your form:

{!! Turnstile::renderWidget() !!}

2. Validate the Turnstile response in your controller:

use MrLks\CloudflareTurnstileLaravel\Rules\TurnstileRule;
public function store(Request $request)
{
$request->validate([
'cf-turnstile-response' => ['required', new TurnstileRule],
]);
// Your logic here
}

### Using Middleware

Protect your routes using the Turnstile middleware:

// In your routes file
Route::post('/protected-route', function () {
// Your protected route logic
})->middleware('turnstile');
// Or in your controller
public function construct()
{
$this->middleware('turnstile')->only(['store', 'update']);
}

### Customizing the Widget

You can customize the widget appearance:

{!! Turnstile::renderWidget([
'data-theme' => 'dark',
'data-size' => 'compact',
'data-action' => 'login',
'data-language' => 'en'
]) !!}

Available options:

- Theme: `light`, `dark`, `auto`
- Size: `normal`, `compact`
- Language: Any valid language code

## Configuration Options

The `config/turnstile.php` file allows you to configure:

return [
// Your Cloudflare Turnstile keys
'site_key' => env('TURNSTILE_SITE_KEY', ''),
'secret_key' => env('TURNSTILE_SECRET_KEY', ''),
// Verification endpoint
'verify_url' => env('TURNSTILE_VERIFY_URL', 'https://challenges.cloudflare.com/turnstile/v0/siteverify'),
// Default widget settings
'theme' => 'light',
'size' => 'normal',
];

## Events

The package dispatches the following events:

- `TurnstileValidated`: When a Turnstile challenge is successfully validated
- `TurnstileFailedValidation`: When a Turnstile challenge fails validation

## Testing

composer test

## Security

If you discover any security-related issues, please email security@example.com instead of using the issue tracker.

## Credits

- [Mrlks](https://github.com/mr-lks)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Support

For support, please use the [issue tracker](https://github.com/yourusername/cloudflare-turnstile-laravel/issues).

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. # Open a Pull Request

# cloudflare-turnstile-laravel

Laravel integration for Cloudflare Turnstile CAPTCHA

> > > > > > > # 1066a7ad2c02e4c3d3d86e8c7d6fba8efae75106

# cloudflare-turnstile-laravel

> > > > > > > bc520bb64e4deb9561a07f56826d3bd9a264f47c
