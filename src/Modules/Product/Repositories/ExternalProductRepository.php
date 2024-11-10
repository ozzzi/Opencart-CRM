<?php

declare(strict_types=1);

namespace Modules\Product\Repositories;

use App\Enums\Store;
use Illuminate\Database\Connection;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ExternalProductRepository
{
    private Connection $connection;

    public function __construct(private readonly Store $store)
    {
        $this->connection = DB::connection($this->store->value);
    }

    public function find(int $productId): ?object
    {
        return $this->connection
            ->table('product as p')
            ->leftJoin('product_description as pd', function (JoinClause $join) {
                $join->on('p.product_id', '=', 'pd.product_id')
                    ->where('pd.language_id', $this->store->language());
            })
            ->where('p.product_id', $productId)
            ->first();
    }

    public function finByModel(string $model): ?object
    {
        return $this->connection
            ->table('product as p')
            ->leftJoin('product_description as pd', function (JoinClause $join) {
                $join->on('p.product_id', '=', 'pd.product_id')
                    ->where('pd.language_id', $this->store->language());
            })
            ->where('model', $model)
            ->first();
    }

    public function productCategories(int $productId): Collection
    {
        return $this->connection
            ->table('product_to_category as p2c')
            ->leftJoin('category_description as cd', function (JoinClause $join) {
                $join->on('p2c.category_id', '=', 'cd.category_id')
                    ->where('cd.language_id', $this->store->language());
            })
            ->where('p2c.product_id', $productId)
            ->get();
    }

    public function productAttributes(int $productId): Collection
    {
        return $this->connection
            ->table('product_attribute as pa')
            ->select('ad.name', 'pa.text')
            ->leftJoin('attribute_description as ad', function (JoinClause $join) {
                $join->on('pa.attribute_id', '=', 'ad.attribute_id')
                    ->where('ad.language_id', $this->store->language());
            })
            ->where('pa.product_id', $productId)
            ->get();
    }

    public function productOptions(int $productId): Collection
    {
        return $this->connection
            ->table('product_option_value as po')
            ->select('od.name', 'ovd.name as value')
            ->leftJoin('option_value_description as ovd', function (JoinClause $join) {
                $join->on('po.option_value_id', '=', 'ovd.option_value_id')
                    ->where('ovd.language_id', $this->store->language());
            })
            ->leftJoin('option_description as od', function (JoinClause $join) {
                $join->on('po.option_id', '=', 'od.option_id')
                    ->where('od.language_id', $this->store->language());
            })
            ->where('po.product_id', $productId)
            ->get();
    }
}
