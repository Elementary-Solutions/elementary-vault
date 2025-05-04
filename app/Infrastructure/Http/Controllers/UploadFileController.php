<?php

namespace App\Infrastructure\Http\Controllers;

use App\Domain\DTOs\FileUploadDTO;
use App\Domain\Entities\Client;
use App\Domain\Entities\Provider;
use App\Domain\Interfaces\UseCases\UploadFileUseCaseInterface;
use App\Infrastructure\Http\Requests\UploadFormFileRequest;
use App\Infrastructure\Http\Requests\UploadJsonFileRequest;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function __invoke(Request $request, UploadFileUseCaseInterface $useCase)
    {
        $dto = $this->getDto($request);

        if (!$dto) {
            return response()->json(['code' => 1001], 400);
        }

        return response()->json(['resource_id' => $useCase($dto)], 201);
    }

    private function getDto(Request $request): ?FileUploadDTO
    {
        /** @var Provider $provider */
        $provider = $request->attributes->get('provider');

        /** @var Client $client */
        $client = $request->attributes->get('client');

        if ($request->isJson()) {

            app(UploadJsonFileRequest::class);

            return FileUploadDTO::fromBase64(
                $provider,
                $client,
                $request->input('file'),
                $request->input('file_name')
            );

        } elseif ($request->hasFile('file')) {

            app(UploadFormFileRequest::class);

            return FileUploadDTO::fromUploadedFile(
                $provider,
                $client,
                $request->file('file'),
                $request->input('file_name')
            );
        }

        return null;
    }
}
