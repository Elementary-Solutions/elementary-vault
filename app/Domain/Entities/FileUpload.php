<?php

namespace App\Domain\Entities;

class FileUpload
{
    public readonly string $name;

    public function __construct(
        public readonly MimeType $mime,
        /** @var string|resource $content */
        public readonly mixed $content,
        public readonly ?string $storagePath = null,
        ?string $name = null
    ) {
        $this->name = $this->generateFileName($name);
    }

    private function generateFileName(?string $name = null): string
    {
        $timestamp = date('dmYHis');
        if (!$name || strlen($name) > 25) {
            $random = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 6)), 0, 12);

            return"{$random}_{$timestamp}";
        }

        return"{$name}_{$timestamp}";
    }

    public function completeName(): string
    {
        return $this->name . "." . $this->mime->extension;
    }

    public function completeNameWithStoragePath(): string
    {
        $storagePath = $this->storagePath();

        if (str_starts_with($storagePath, '/'))
            $storagePath = substr($storagePath, 1);


         if (!str_ends_with($storagePath, '/'))
            $storagePath .= '/';
        
        return $storagePath . $this->completeName();
    }


    public function storagePath(): ?string
    {
        return $this->storagePath;
    }


}
