<?php

declare(strict_types=1);

namespace Modules\OrderStatus\Services;

use App\Enums\Store;
use Modules\OrderStatus\Models\OrderStatus;
use Modules\OrderStatus\Repositories\ExternalOrderStatusRepository;

class OrderStatusSyncService
{
    private ExternalOrderStatusRepository $externalOrderStatusRepository;

    public function __construct(protected Store $store)
    {
        $this->externalOrderStatusRepository = new ExternalOrderStatusRepository($store);
    }

    public function process(): void
    {
        $statuses = $this->externalOrderStatusRepository->list();

        foreach ($statuses as $status) {
            OrderStatus::query()
                ->updateOrCreate(
                    [
                        'external_id' => $status->order_status_id,
                        'store' => $this->store
                    ],
                    ['name' => $status->name]
                );
        }
    }
}
