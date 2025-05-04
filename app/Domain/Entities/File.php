<?php

namespace App\Domain\Entities;

class File
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $name,
        public readonly string $storagePath,
        public readonly int $mimeTypeId,
        public readonly int $providerId,
        public readonly int $size
    ) {
    }

    public function uuid(): string
    {
        return $this->uuid;
    }
}
