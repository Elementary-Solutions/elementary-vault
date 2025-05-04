<?php

namespace App\Application\Services;

use App\Application\Adapters\FileStorage\GoogleDriveStorageAdapter;
use App\Application\Adapters\FileStorage\S3FileStorageAdapter;
use App\Domain\Entities\Provider;
use App\Domain\Enums\AdapterEnum;
use App\Domain\Interfaces\FileStorageAdapterInterface;
use App\Infrastructure\Adapters\LocalFileStorageAdapter;

class FileStorageAdapterResolver
{
    public function resolve(Provider $provider): FileStorageAdapterInterface
    {
        return match ($provider->adapter) {
            AdapterEnum::LOCAL => new LocalFileStorageAdapter($provider),
            // 'aws_s3' => new S3FileStorageAdapter($provider),
            // 'google_drive' => new GoogleDriveStorageAdapter($provider),
            default => throw new \RuntimeException("Adapter '{$provider->adapter->name}' no support."),
        };
    }
}
