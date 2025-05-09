<?php

namespace App\Infrastructure\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;

class FileNotFoundInProviderException extends HttpResponseException
{
    public function __construct()
    {
        parent::__construct(
            response()->json([
                'code' => 1060,
            ], 404)
        );
    }
}
