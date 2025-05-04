<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\Provider;

interface ProviderRepositoryInterface
{
    public function findByKey(string $accessKey): ?Provider;
}
