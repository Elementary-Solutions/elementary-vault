<?php

namespace App\Domain\Interfaces;

use App\Domain\DTOs\FileUploadDTO;

interface UploadFileUseCaseInterface
{
    public function __invoke(FileUploadDTO $dto): string;
}
