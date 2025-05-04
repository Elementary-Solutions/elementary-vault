<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Client;
use App\Domain\Entities\Provider;
use App\Domain\Enums\AdapterEnum;
use App\Domain\Interfaces\ApiClientRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ApiClientQueryBuilderRepository implements ApiClientRepositoryInterface
{
    public function findByApiKey(string $apiKey): ?Client
    {
        $row = DB::table('api_clients')
            ->select('id','name', 'secret')
            ->where('key', $apiKey)
            ->where('active', 1)
            ->first();

        if (!$row) {
            return null;
        }

        return new Client($row->id, $row->name, $apiKey, $row->secret);
    }
}
