<?php

declare(strict_types=1);

namespace Modules\Order\Repositories;

use App\Enums\Store;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ExternalOrderProductRepository
{
    public function __construct(private readonly Store $store)
    {
    }

    public function list(int $orderId): Collection
    {
        return DB::connection($this->store->value)
            ->table('order_product')
            ->where('order_id', $orderId)
            ->get();
    }
}
