<?php

use App\Domain\Interfaces\FileStorageAdapterInterface;

class LocalFileStorageAdapter implements FileStorageAdapterInterface {
    
    public function upload(string $path, mixed $file): string {
        Storage::disk('local')->put($path, $file);
        return $path;
    }
}
