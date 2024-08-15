<?php

declare(strict_types=1);

namespace Modules\Shipment\Repositories;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\LazyCollection;
use Modules\Shipment\Models\Tracking;

final class TrackingRepository
{
    public function upsert(array $data): void
    {
        Tracking::query()
            ->updateOrCreate(
                [
                    'request_id' => $data['request_id'],
                    'type' => $data['type'],
                ],
                [
                    'number' => $data['number'],
                ]
            );
    }

    public function update(string $number, array $data): void
    {
        Tracking::query()
            ->where('number', $number)
            ->update($data);
    }

    public function findWhere(array $criteria): Collection
    {
        return Tracking::query()
            ->where([$criteria])
            ->get();
    }

    public function getNew(): LazyCollection
    {
        return Tracking::query()
            ->with('request')
            ->new()
            ->lazy();
    }

    public function getNewChunk(int $chunkSize, Closure $callback): bool
    {
        return Tracking::query()
            ->new()
            ->chunk($chunkSize, $callback);
    }
}
