<?php

namespace App\Infrastructure\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class NoConfiguredProviderException extends HttpResponseException
{
    public function __construct(string $message = 'Provider default no configurado.')
    {
        parent::__construct(
            response()->json(['code' => 110], 400)
        );
    }
}
