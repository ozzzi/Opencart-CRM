<?php

declare(strict_types=1);

namespace Modules\Product\Repositories;

use App\Enums\Store;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class ExternalProductRepository
{
    public function __construct(private readonly Store $store)
    {
    }

    public function find(int $productId): object|null
    {
        return DB::connection($this->store->value)
            ->table('product as p')
            ->select(
                'p.sku',
                'p.model',
                'p.quantity',
                'p.image',
                'p.price'
            )
            ->leftJoin('product_description as pd', function (JoinClause $join) {
                $join->on('p.product_id', '=', 'pd.product_id')
                    ->where('pd.language_id', $this->store->language());
            })
            ->where('p.product_id', $productId)
            ->first();
    }
}
