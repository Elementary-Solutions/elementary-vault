<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\File;
use App\Domain\Entities\MimeType;
use Illuminate\Support\Facades\DB;
use App\Domain\Interfaces\FileRepositoryInterface;
use FileTypeEnum;

class FileQueryBuilderRepository implements FileRepositoryInterface
{
   
    public function save(File $file): bool
    {
        return DB::table('files')->insert([
            'id' => $file->uuid,
            'name' => $file->name,
            'path' => $file->storagePath,
            'mime_type_id' => $file->mimeTypeId,
            'provider_id' => $file->providerId,
            'size' => $file->size,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
