<?php

namespace App\Infrastructure\Http\Controllers;

use App\Domain\DTOs\FileDownloadDTO;
use App\Domain\Entities\Client;
use App\Domain\Entities\Provider;
use App\Domain\Interfaces\UseCases\DownloadFileUseCaseInterface;
use App\Infrastructure\Http\Requests\DownloadFileRequest;

class DownloadFileController extends Controller
{
    /**
     * @param \App\Infrastructure\Http\Requests\DownloadFileRequest $request
     * @param string $uuid
     * @param \App\Domain\Interfaces\DownloadFileUseCaseInterface $useCase
     */
    public function __invoke(DownloadFileRequest $request, string $uuid, DownloadFileUseCaseInterface $useCase)
    {
        /** @var Provider $provider */
        $provider = $request->attributes->get('provider');

        /** @var Client $client */
        $client = $request->attributes->get('client');

        $dto = new FileDownloadDTO($uuid, $provider, $client);

        return response()->json($useCase($dto)->toArray(), 200);
    }
}
