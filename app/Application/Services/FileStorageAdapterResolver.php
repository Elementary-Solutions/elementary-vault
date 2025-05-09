<?php

namespace App\Application\Services;

use App\Domain\Entities\Provider;
use App\Domain\Enums\AdapterEnum;
use App\Domain\Interfaces\FileStorageAdapterInterface;
use App\Infrastructure\Adapters\GoogleDriveFileStorageAdapter;
use App\Infrastructure\Adapters\LocalFileStorageAdapter;
use App\Infrastructure\Adapters\OneDriveFileStorageAdapter;
use Google\Service\AndroidPublisher\OneTimeCode;

class FileStorageAdapterResolver
{
    public function resolve(Provider $provider): FileStorageAdapterInterface
    {
        return match ($provider->adapter) {
            AdapterEnum::LOCAL => new LocalFileStorageAdapter($provider),
            AdapterEnum::GOOGLE_DRIVE => new GoogleDriveFileStorageAdapter($provider),
            AdapterEnum::ONE_DRIVE => new OneDriveFileStorageAdapter($provider),
            // 'google_drive' => new GoogleDriveStorageAdapter($provider),
            // 'aws_s3' => new S3FileStorageAdapter($provider),
            default => throw new \RuntimeException("Adapter '{$provider->adapter->name}' not supported."),
        };
    }
}
