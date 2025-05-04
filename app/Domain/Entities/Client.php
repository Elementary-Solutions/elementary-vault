<?php

namespace App\Domain\Entities;

class Client
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $key,
        public readonly string $secret
    ) {
    }
}
