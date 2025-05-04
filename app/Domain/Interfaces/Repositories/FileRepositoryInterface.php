<?php

namespace App\Domain\Interfaces\Repositories;

use App\Domain\Entities\File;

interface FileRepositoryInterface
{
    public function save(File $file): bool;
    public function find(string $uuid, int $providerId): ?File;
}
