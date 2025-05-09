<?php

use App\Infrastructure\Http\Middleware\ResolveStorageProvider;
use App\Infrastructure\Http\Middleware\ValidateApiKey;
use App\Infrastructure\Http\Middleware\VerifyApiClient;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function () {
            Route::middleware(['throttle:vault'])
            //Route::middleware(['throttle:vault'])
            ->group(base_path('routes/vault.php'));

            Route::middleware(['throttle:vault'])
            ->prefix('tinker')
            ->group(base_path('routes/backoffice.php'));

        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(ValidateApiKey::class);
        $middleware->append(VerifyApiClient::class);
        $middleware->append(ResolveStorageProvider::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
