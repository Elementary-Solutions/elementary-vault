<?php

namespace App\Infrastructure\Adapters;

use App\Domain\Entities\Provider;
use App\Domain\Interfaces\FileStorageAdapterInterface;
use Illuminate\Http\UploadedFile;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;

class LocalFileStorageAdapter implements FileStorageAdapterInterface
{
    protected Filesystem $filesystem;

    public function __construct(protected Provider $provider)
    {
        $rootPath = env('VAULT_' . strtoupper($provider->key) . '_STORAGE_PATH', storage_path('app/private'));

        if (! $rootPath) {
            throw new \RuntimeException('Storage path not defined for provider: ' . $provider->key);
        }

        $adapter = new LocalFilesystemAdapter($rootPath);
        $this->filesystem = new Filesystem($adapter);
    }

    public function upload(string $path, mixed $file): string
    {
        return "";
    }

    // public function upload(string $path, string $file): string
    // {
    //     // $filename = uniqid() . '_' . $file->getClientOriginalName();
    //     // $stream = fopen($file->getRealPath(), 'r');
    //     // $this->filesystem->writeStream($path . '/' . $filename, $stream);
    //     // fclose($stream);
    //     // return trim($path . '/' . $filename, '/');
    //     return "";
    // }

    // public function get(string $path): string
    // {
    //     return $this->filesystem->read($path);
    // }

    // public function delete(string $path): bool
    // {
    //     return $this->filesystem->delete($path);
    // }
}
