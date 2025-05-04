<?php

namespace App\Domain\Entities;

use App\Domain\Enums\FileTypeEnum;

class MimeType
{
    public function __construct(
        public readonly int $id,
        public readonly FileTypeEnum $type,
        public readonly string $mime,
        public readonly string $extension
    ) {
    }
}
