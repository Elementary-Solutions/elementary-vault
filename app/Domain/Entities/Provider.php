<?php

namespace App\Domain\Entities;

use App\Domain\Enums\AdapterEnum;

class Provider
{
    public function __construct(
        public readonly int $id,
        public readonly string $key,
        public readonly string $accessKey,
        public readonly string $name,
        public readonly AdapterEnum $adapter
    ) {
    }
}
