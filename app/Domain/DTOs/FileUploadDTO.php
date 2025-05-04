<?php

namespace App\Domain\DTOs;

use App\Domain\Entities\Client;
use App\Domain\Entities\Provider;
use finfo;
use Illuminate\Http\UploadedFile;

class FileUploadDTO
{
    public function __construct(
        public readonly ?string $fileName,
        public readonly string $mimeType,
        /** @var string|resource $content */
        public readonly mixed $content,
        public readonly Provider $provider,
        public readonly Client $client,
        public readonly ?string $path = null
    ) {

        if (! is_string($content) && gettype($content) !== 'resource') {
            throw new \InvalidArgumentException('Invalid content type.');
        }
    }

    public static function fromBase64(
        Provider $provider,
        Client $client,
        string $base64,
        ?string $fileName = null,
        ?string $path = null
    ): self {
        $content = base64_decode($base64);

        if ($content === false) {
            throw new \InvalidArgumentException('Invalid Base64 content');
        }

        $mimeType = self::detectMimeTypeFromString($content);

        return new self(
            fileName: str_replace(" ", "_", $fileName),
            mimeType: $mimeType,
            content: $content,
            provider: $provider,
            client: $client,
            path: $path
        );
    }

    public static function fromUploadedFile(
        Provider $provider,
        Client $client,
        UploadedFile $file,
        ?string $fileName = null,
        ?string $path = null
    ): self {
        return new self(
            fileName: str_replace(" ", "_", $fileName),
            mimeType: $file->getMimeType() ?? 'unknown',
            content: fopen($file->getRealPath(), 'r'),
            provider: $provider,
            client: $client,
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
