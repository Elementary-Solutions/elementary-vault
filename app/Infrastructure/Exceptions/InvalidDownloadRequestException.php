<?php

namespace App\Infrastructure\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;

class InvalidDownloadRequestException extends HttpResponseException
{
    public function __construct()
    {
        parent::__construct(
            response()->json([
                'code' => 1050,
            ], 422)
        );
    }
}
