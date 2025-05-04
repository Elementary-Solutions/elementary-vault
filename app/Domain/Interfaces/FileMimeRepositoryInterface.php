<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\MimeType;

interface FileMimeRepositoryInterface
{
    public function findByMime(string $mime): ?MimeType;
    public function findByExtension(string $extension): ?MimeType;
}
