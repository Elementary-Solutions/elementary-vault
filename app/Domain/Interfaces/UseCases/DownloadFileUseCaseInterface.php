<?php

namespace App\Domain\Interfaces\UseCases;

use App\Domain\DTOs\FileDownloadDTO;
use App\Domain\Entities\FileDownload;

interface DownloadFileUseCaseInterface
{
    public function __invoke(FileDownloadDTO $dto): FileDownload;
}
