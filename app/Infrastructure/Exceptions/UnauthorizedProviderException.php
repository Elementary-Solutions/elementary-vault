<?php

namespace App\Infrastructure\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UnauthorizedProviderException extends HttpResponseException
{
    public function __construct(string $message = 'Provider no autorizado.')
    {
        parent::__construct(
            response()->json(['code' => 111], 403)
        );
    }
}
