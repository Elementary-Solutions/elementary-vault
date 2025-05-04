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
        $this->name = (!$name) ? $this->generateFileName() : $name;
    }

    private function generateFileName(): string
    {
        $random = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 6)), 0, 6);
        $timestamp = date('dmYHis');

        return"{$random}_{$timestamp}";
    }

    public function completeName(): string
    {
        return $this->name . "." . $this->mime->extension;
    }

    public function completeNameWithStoragePath(): string
    {
        return $this->storagePath() . $this->completeName();
    }


    public function storagePath(): string
    {
        return $this->storagePath;
    }


}
