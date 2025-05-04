<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\File;
use App\Domain\Entities\FileUpload;

interface FileStorageAdapterInterface
{
    public function upload(FileUpload $file): void;
    //public function download(string $path): mixed;
    //public function delete(string $path): bool;
    //public function list(string $directory): array;
}
