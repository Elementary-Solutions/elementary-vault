<?php

namespace App\Infrastructure\Http\Middleware;

use App\Infrastructure\Exceptions\NoConfiguredProviderException;
use App\Infrastructure\Exceptions\UnauthorizedProviderException;
use App\Domain\Interfaces\ProviderRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveStorageProvider
{
    public function __construct(
        protected ProviderRepositoryInterface $repository
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $providerAccessKey = $request->hasHeader('X-Storage-Provider') ? $request->header('X-Storage-Provider') : config('vault.default_provider');

        if (!$providerAccessKey)
            throw new NoConfiguredProviderException();

        $provider = $this->repository->findByKey($providerAccessKey);

        if (!$provider)
            throw new UnauthorizedProviderException();

        $request->attributes->set('provider', $provider);

        return $next($request);
    }
}
