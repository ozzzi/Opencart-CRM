<?php

declare(strict_types=1);

namespace Modules\Order\Repositories;

use App\Enums\Store;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class ExternalOrderRepository
{
    public function __construct(private readonly Store $store)
    {
    }

    public function listLazy(): LazyCollection
    {
        return DB::connection($this->store->value)
            ->table('order')
            ->orderBy('order_id', 'desc')
            ->lazy();
    }

    public function products(int $orderId): Collection
    {
        return DB::connection($this->store->value)
            ->table('order_product')
            ->where('order_id', $orderId)
            ->get();
    }

    public function productOptions(int $orderId, int $orderProductId): Collection
    {
        return DB::connection($this->store->value)
            ->table('order_option')
            ->where('order_id', $orderId)
            ->where('order_product_id', $orderProductId)
            ->get();
    }

    public function statusId(int $orderId): int
    {
        return (int) DB::connection($this->store->value)
            ->table('order_history')
            ->where('order_id', $orderId)
            ->orderByDesc('order_history_id')
            ->value('order_status_id');
    }
}
