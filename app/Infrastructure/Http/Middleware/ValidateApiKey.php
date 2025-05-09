<?php

namespace App\Infrastructure\Http\Middleware;

use App\Infrastructure\Exceptions\UnauthorizedApiKeyException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('tinker/*')) {
            return $next($request);
        }

        $configuredKey = config('vault.api_key');

        $providedKey = $request->header('X-Api-Key');

        if (!$configuredKey || $providedKey !== $configuredKey) {
            throw new UnauthorizedApiKeyException();
        }

        return $next($request);
    }
}
