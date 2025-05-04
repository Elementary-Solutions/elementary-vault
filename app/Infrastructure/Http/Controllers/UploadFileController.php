<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCases\UploadFileUseCase;
use Illuminate\Http\Request;
use App\Domain\DTOs\FileUploadDTO;
use App\Domain\Entities\Provider;
use App\Domain\Interfaces\UploadFileUseCaseInterface;

class UploadFileController extends Controller
{
    public function __invoke(Request $request, UploadFileUseCaseInterface $useCase)
    {
        $dto = $this->getDto($request); 

        if(!$dto)
            return response()->json(['code' => '1001'], 400);

        return response()->json(['resource_id' => $useCase($dto)], 201);
    }

    private function getDto(Request $request): ?FileUploadDTO
    {
        /** @var Provider $provider */
        $provider = $request->attributes->get('provider');

        if($request->isJson())
        {
            return FileUploadDTO::fromBase64(
                $provider,
                $request->input('file')
            );
        } elseif ($request->hasFile('file'))
        {
            return FileUploadDTO::fromUploadedFile(
                $provider,
                $request->file('file')
            );
        }

        return null;
    }
}
