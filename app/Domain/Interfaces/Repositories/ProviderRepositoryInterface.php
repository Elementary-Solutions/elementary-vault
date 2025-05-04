<?php

namespace App\Domain\Interfaces\Repositories;

use App\Domain\Entities\Provider;

interface ProviderRepositoryInterface
{
    public function findByKey(string $accessKey): ?Provider;
}
