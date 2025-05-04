<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\MimeType;
use App\Domain\Enums\FileTypeEnum;
use Illuminate\Support\Facades\DB;
use App\Domain\Interfaces\FileMimeRepositoryInterface;
class FileMimeQueryBuilderRepository implements FileMimeRepositoryInterface
{
    public function findByMime(string $mime): ?MimeType
    {
        $row = DB::table('file_mime_types')
        ->select('id','type_id','mime','extension')
        ->where('mime', $mime)
        ->first();

        if(!$row)
            return null;

        return new MimeType(
            $row->id,
            FileTypeEnum::from($row->type_id),
            $row->mime,
            $row->extension
        );
    }
    
    public function findByExtension(string $extension): ?MimeType
    {
        $row = DB::table('file_mime_types')
        ->select('type_id','mime','extension')
        ->where('extension', $extension)
        ->first();

        if(!$row)
            return null;

        return new MimeType(
            $row->id,
            FileTypeEnum::from($row->type_id),
            $row->mime,
            $row->extension
        );
    }
    
}
