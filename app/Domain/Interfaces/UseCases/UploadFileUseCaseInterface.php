<?php

namespace App\Domain\Interfaces\UseCases;

use App\Domain\DTOs\FileUploadDTO;

interface UploadFileUseCaseInterface
{
    public function __invoke(FileUploadDTO $dto): string;
}
