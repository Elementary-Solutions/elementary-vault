<?php

namespace App\Infrastructure\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UnauthorizedApiClientException extends HttpResponseException
{
    public function __construct(string $message = 'Falta el header X-Client-Key')
    {
        parent::__construct(
            response()->json(['code' => 101], 401)
        );
    }
}
