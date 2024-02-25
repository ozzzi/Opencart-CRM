<?php

declare(strict_types=1);

namespace Modules\OrderStatus\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\OrderStatus\Models\OrderStatus;

class OrderStatusRepository
{
    /**
     * @return Collection<OrderStatus>
     */
    public function list(): Collection
    {
        return OrderStatus::all();
    }

    public function show(int $id): OrderStatus
    {
        return OrderStatus::query()->findOrFail($id);
    }
}
