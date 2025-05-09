<?php

namespace App\Infrastructure\Http\Middleware;

use App\Domain\Interfaces\Repositories\ApiClientRepositoryInterface;
use App\Infrastructure\Exceptions\UnauthorizedApiClientException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiClient
{
    public function __construct(
        protected ApiClientRepositoryInterface $repository
    ) {
    }

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('tinker/*')) {
            return $next($request);
        }
        
        $clientKey = $request->header('X-Client-Key');

        if (!$clientKey) {
            throw new UnauthorizedApiClientException();
        }

        $client = $this->repository->findByApiKey($clientKey);

        if (!$client) {
            throw new UnauthorizedApiClientException('Cliente inválido o inactivo');
        }

        $request->attributes->set('client', $client);

        return $next($request);
    }
}
