<?php

namespace App\Infrastructure\Http\Controllers;

use App\Domain\DTOs\FileDownloadDTO;
use App\Domain\DTOs\FileUploadDTO;
use App\Domain\Entities\Client;
use App\Domain\Entities\Provider;
use App\Domain\Interfaces\UseCases\DownloadFileUseCaseInterface;
use App\Infrastructure\Http\Requests\UploadFormFileRequest;
use App\Infrastructure\Http\Requests\UploadJsonFileRequest;
use Illuminate\Http\Request;

class DownloadFileController extends Controller
{
    public function __invoke(Request $request, string $uuid, DownloadFileUseCaseInterface $useCase)
    {
        /** @var Provider $provider */
        $provider = $request->attributes->get('provider');

        /** @var Client $client */
        $client = $request->attributes->get('client');

        $dto = new FileDownloadDTO($uuid, $provider, $client);

        return response()->json($useCase($dto)->toArray(), 200);
    }
}
