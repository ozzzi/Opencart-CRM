<?php

declare(strict_types=1);

namespace Modules\OrderStatus\Repositories;

use App\Enums\Store;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ExternalOrderStatusRepository
{
    public function __construct(private readonly Store $store)
    {
    }

    public function list(): Collection
    {
        return DB::connection($this->store->value)
            ->table('order_status')
            ->where('language_id', $this->store->language())
            ->get();
    }
}
