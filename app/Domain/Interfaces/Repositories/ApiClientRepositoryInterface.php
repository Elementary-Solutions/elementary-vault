<?php

namespace App\Domain\Interfaces\Repositories;

use App\Domain\Entities\Client;

interface ApiClientRepositoryInterface
{
    public function findByApiKey(string $apiKey): ?Client;
}
