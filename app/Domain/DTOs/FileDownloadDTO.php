<?php

namespace App\Domain\DTOs;

use App\Domain\Entities\Client;
use App\Domain\Entities\Provider;

class FileDownloadDTO
{
    public function __construct(
        public readonly string $id,
        public readonly Provider $provider,
        public readonly Client $client
    ) {
    }
}
