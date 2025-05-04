<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Provider;
use App\Domain\Enums\AdapterEnum;
use App\Domain\Interfaces\Repositories\ProviderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProviderQueryBuilderRepository implements ProviderRepositoryInterface
{
    public function findByKey(string $accessKey): ?Provider
    {
        $row = DB::table('providers')
        ->join('provider_adapters', 'provider_adapters.id', '=', 'providers.adapter_id')
        ->select(
            'providers.id',
            'provider_adapters.name',
            'providers.key',
            'providers.adapter_id'
        )
        ->where('providers.access_key', $accessKey)
        ->where('providers.enabled', 1)
        ->first();

        if (!$row) {
            return null;
        }

        return new Provider($row->id, $row->key, $accessKey, $row->name, AdapterEnum::from($row->adapter_id));
    }
}
