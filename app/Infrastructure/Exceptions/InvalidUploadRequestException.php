<?php

namespace App\Infrastructure\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;

class InvalidUploadRequestException extends HttpResponseException
{
    public function __construct()
    {
        parent::__construct(
            response()->json([
                'code' => 1002,
            ], 422)
        );
    }
}
