<?php

use App\Infrastructure\Http\Middleware\ResolveStorageProvider;
use App\Infrastructure\Http\Middleware\ValidateApiKey;
use App\Infrastructure\Http\Middleware\VerifyApiClient;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(ValidateApiKey::class);
        $middleware->append(VerifyApiClient::class);
        $middleware->append(ResolveStorageProvider::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
