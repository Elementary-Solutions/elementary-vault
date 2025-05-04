<?php

namespace App\Infrastructure\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UnauthorizedApiKeyException extends HttpResponseException
{
    public function __construct(string $message = 'API Key inválida.')
    {
        parent::__construct(
            response()->json(['code' => 100], 401)
        );
    }
}
