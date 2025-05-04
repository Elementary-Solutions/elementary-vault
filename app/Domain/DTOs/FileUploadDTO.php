<?php

namespace App\Domain\DTOs;

use App\Domain\Entities\Provider;
use Illuminate\Http\UploadedFile;
use finfo;

class FileUploadDTO
{
    public function __construct(
        public readonly ?string $filename,
        public readonly string $mimeType,
        /** @var string|resource $content */
        public readonly mixed $content,
        public readonly Provider $provider,
        public readonly ?string $path = null
    ) {

        if (! is_string($content) && gettype($content) !== 'resource') {
            throw new \InvalidArgumentException('Invalid content type.');
        }
    }

    public static function fromBase64(
        Provider $provider,
        string $base64,
        ?string $filename = null,
        ?string $path = null
    ): self 
    {
        $content = base64_decode($base64);

        if ($content === false) {
            throw new \InvalidArgumentException('Invalid Base64 content');
        }

        $mimeType = self::detectMimeTypeFromString($content);

        return new self(
            filename: $filename,
            mimeType: $mimeType,
            content: $content,
            provider: $provider,
            path: $path
        );
    }

    public static function fromUploadedFile(
        Provider $provider,
        UploadedFile $file,
        ?string $path = null
    ): self 
    {

        return new self(
            filename: $file->getClientOriginalName(),
            mimeType: $file->getMimeType() ?? 'unknown',
            content: fopen($file->getRealPath(), 'r'),
            provider: $provider,
            path: $path
        );
    }


    private static function detectMimeTypeFromString(string $content): string
    {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        return $finfo->buffer($content) ?: 'unknown';
    }


    public function getPath(): string
    {
        return (!$this->path) ? "" : $this->path;
    }
}
