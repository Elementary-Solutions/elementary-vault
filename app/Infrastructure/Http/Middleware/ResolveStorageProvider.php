<?php

namespace App\Infrastructure\Http\Middleware;

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

        if (!$providerAccessKey) {
            return response()->json(['code' => 100], 400);
        }

        $provider = $this->repository->findByKey($providerAccessKey);

        if (!$provider) {
            return response()->json(['code' => 110], 400);
        }
        $request->attributes->set('provider', $provider);

        return $next($request);
    }
}
