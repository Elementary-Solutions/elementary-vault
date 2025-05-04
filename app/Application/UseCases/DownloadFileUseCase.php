<?php

namespace App\Application\UseCases;

use App\Application\Services\FileStorageAdapterResolver;
use App\Domain\DTOs\FileDownloadDTO;
use App\Domain\Entities\FileDownload;
use App\Domain\Interfaces\Repositories\FileMimeRepositoryInterface;
use App\Domain\Interfaces\Repositories\FileRepositoryInterface;
use App\Domain\Interfaces\UseCases\DownloadFileUseCaseInterface;

class DownloadFileUseCase implements DownloadFileUseCaseInterface
{
    public function __construct(
        private readonly FileStorageAdapterResolver $adapterResolver,
        private readonly FileRepositoryInterface $fileRepository,
        private readonly FileMimeRepositoryInterface $mimeRepository,
    ) {
    }

    public function __invoke(FileDownloadDTO $dto): FileDownload
    {
        $adapter = $this->adapterResolver->resolve($dto->provider);

        $file = $this->fileRepository->find($dto->id, $dto->provider->id);

        if (!$file) {
            throw new \InvalidArgumentException("no encontrado...");
        }

        $content = $adapter->download($file->completeStoragePath());

        $mime = $this->mimeRepository->find($file->mimeTypeId);

        if (!$mime) {
            throw new \InvalidArgumentException("no encontrado...");
        }

        return new FileDownload(
            $file->uuid,
            $file->name,
            $content,
            $mime,
            $file->createdAt,
            $file->updatedAt
        );
    }
}
