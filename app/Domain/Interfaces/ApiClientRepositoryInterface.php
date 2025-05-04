<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\Client;

interface ApiClientRepositoryInterface
{
    public function findByApiKey(string $apiKey): ?Client;
}
