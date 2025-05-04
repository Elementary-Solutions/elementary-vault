<?php

namespace App\Application\UseCases;

use App\Application\Services\FileStorageAdapterResolver;
use App\Domain\DTOs\FileUploadDTO;
use App\Domain\Entities\File;
use App\Domain\Interfaces\FileMimeRepositoryInterface;
use App\Domain\Interfaces\FileRepositoryInterface;
use App\Domain\Interfaces\UploadFileUseCaseInterface;
use Illuminate\Support\Str;

class UploadFileUseCase implements UploadFileUseCaseInterface
{
    public function __construct(
        private readonly FileMimeRepositoryInterface $mimeRepository,
        private readonly FileStorageAdapterResolver $adapterResolver,
        private readonly FileRepositoryInterface $fileRepository
    ) {}

    public function __invoke(FileUploadDTO $dto): string
    {
        $mime = $this->mimeRepository->findByMime($dto->mimeType);

        if (!$mime)
            throw new \InvalidArgumentException("MIME type '{$dto->mimeType}' no support.");

        $adapter = $this->adapterResolver->resolve($dto->provider);

        //$path = $adapter->upload($input);

        $file = new File(
            uuid: (string) Str::uuid(),
            name: $dto->filename,
            storagePath: $dto->getPath(),
            mimeTypeId: $mime->id,
            providerId: $dto->provider->id,
            size: is_string($dto->content) ? strlen($dto->content) : fstat($dto->content)['size']
        );
        

        if(!$this->fileRepository->save($file))
            throw new \InvalidArgumentException("MIME type '{$dto->mimeType}' no support.");

        return $file->uuid;
    }
}
