<?php

namespace App\Infrastructure\Adapters;

use App\Domain\Entities\File;
use App\Domain\Entities\FileUpload;
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

    public function upload(FileUpload $file): void
    {
        $path = trim(($file->storagePath ?? '') . '/' . $file->completeName(), '/');

        $stream = is_resource($file->content)
        ? $file->content
        : fopen('php://temp', 'r+');

        if (!is_resource($file->content)) {
            fwrite($stream, $file->content);
            rewind($stream);
        }

        $this->filesystem->writeStream($path, $stream);

        if (!is_resource($file->content)) {
            fclose($stream);
        }
    }

    public function download(string $path): string
    {
        if (! $this->filesystem->fileExists($path)) {
            throw new \RuntimeException("Archivo no encontrado en: $path");
        }

        $stream = $this->filesystem->readStream($path);

        if (!is_resource($stream)) {
            throw new \RuntimeException("No se pudo leer el archivo: $path");
        }

        $content = stream_get_contents($stream);
        fclose($stream);

        if ($content === false) {
            throw new \RuntimeException("Error al obtener el contenido del archivo: $path");
        }

        return base64_encode($content);
    }
}
