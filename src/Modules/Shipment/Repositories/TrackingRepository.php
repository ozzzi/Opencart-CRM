<?php

declare(strict_types=1);

namespace Modules\Shipment\Repositories;

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
}
