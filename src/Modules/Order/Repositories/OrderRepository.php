<?php

declare(strict_types=1);

namespace Modules\Order\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Order\Data\OrderData;
use Modules\Order\Models\Order;
use Throwable;

class OrderRepository
{
    /**
     * @throws Throwable
     */
    public function store(OrderData $data): Order
    {
        DB::beginTransaction();

        try {
            $dataArray = $data->toArray();
            $productsArray = $dataArray['products'];

            unset($dataArray['products']);

            $order = Order::query()->create($dataArray);
            $order->products()->createMany($productsArray);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            throw $e;
        }

        return $order;
    }
}
