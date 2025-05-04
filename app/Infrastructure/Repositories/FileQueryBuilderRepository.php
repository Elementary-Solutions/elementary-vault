<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\File;
use App\Domain\Entities\MimeType;
use App\Domain\Interfaces\Repositories\FileRepositoryInterface;
use FileTypeEnum;
use Illuminate\Support\Facades\DB;

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
            'client_id' => $file->clientId,
            'size' => $file->size,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function find(string $uuid, int $providerId): ?File
    {
        $row = DB::table('files')
            ->where('id', $uuid)
            ->where('provider_id', $providerId)
            ->whereNull('deleted_at')
            ->first();

        if (!$row) {
            return null;
        }

        return new File(
            $row->id,
            $row->name,
            $row->path,
            $row->mime_type_id,
            $row->provider_id,
            $row->client_id,
            $row->size,
            $row->created_at,
            $row->updated_at
        );
    }
}
