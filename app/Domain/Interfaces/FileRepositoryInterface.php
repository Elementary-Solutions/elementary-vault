<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\File;

interface FileRepositoryInterface
{
    public function save(File $file): bool;
}
