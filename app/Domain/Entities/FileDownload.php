<?php

namespace App\Domain\Entities;

class FileDownload
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $name,
        public readonly string $file,
        public readonly MimeType $mime,
        public readonly ?string $createdAt,
        public readonly ?string $updatedAt
    ) {
    }


    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->mime->type->name,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'file' => $this->file
        ];
    }
}
