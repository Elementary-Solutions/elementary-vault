<?php

namespace App\Domain\Interfaces;

interface FileStorageAdapterInterface
{
    public function upload(string $path, mixed $file): string;
    //public function download(string $path): mixed;
    //public function delete(string $path): bool;
    //public function list(string $directory): array;
}
