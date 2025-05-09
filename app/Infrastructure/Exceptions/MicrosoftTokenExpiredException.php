<?php

namespace App\Infrastructure\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;

class MicrosoftTokenExpiredException extends HttpResponseException
{
    public function __construct()
    {
        parent::__construct(
            response()->json([
                'code' => 2001,
            ], 401)
        );
    }
}
