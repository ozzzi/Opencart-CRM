<?php

declare(strict_types=1);

namespace Modules\Order\Repositories;

use App\Enums\Store;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Order\Data\OrderData;
use Modules\Order\Models\Order;
use Throwable;

class OrderRepository
{
    public function list(): LengthAwarePaginator
    {
        return Order::query()
            ->with(['status'])
            ->orderByDesc('order_id')
            ->paginate()
            ->withQueryString();
    }

    public function listOldNotCompleted(Store $store): Collection
    {
        return Order::query()
            ->nonCompleted($store)
            ->get();
    }

    public function show(int $id): Order
    {
        return Order::query()
            ->with(['products', 'products.options'])
            ->findOrFail($id);
    }

    public function showByOrderId(int $orderId): Order
    {
        return Order::query()
            ->with(['products', 'products.options'])
            ->where('order_id', $orderId)
            ->firstOrFail();
    }

    /**
     * @throws Throwable
     */
    public function store(OrderData $data): Order
    {
        DB::beginTransaction();

        try {
            $dataArray = $data->toArray();
            $productsArray = [];

            if (isset($dataArray['products'])) {
                $productsArray = $dataArray['products'];
                unset($dataArray['products']);
            }

            $order = Order::query()->create($dataArray);

            $optionsArray = [];

            foreach ($productsArray as $productData) {
                if (isset($productData['options'])) {
                    $optionsArray = $productData['options'];
                    unset($productData['options']);
                }

                $orderProduct = $order->products()->create($productData);

                if (count($optionsArray)) {
                    $orderProduct->options()->createMany($optionsArray);
                }
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            throw $e;
        }

        return $order;
    }

    public function update(int $id, array $data): int
    {
        return Order::query()
            ->where('id', $id)
            ->update($data);
    }
}
