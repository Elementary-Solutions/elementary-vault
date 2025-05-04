<?php

namespace App\Domain\Interfaces\Repositories;

use App\Domain\Entities\MimeType;

interface FileMimeRepositoryInterface
{
    public function find(int $id): ?MimeType;
    public function findByMime(string $mime): ?MimeType;
    public function findByExtension(string $extension): ?MimeType;
}
