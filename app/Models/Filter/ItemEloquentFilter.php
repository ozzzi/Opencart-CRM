<?php

declare(strict_types=1);

namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Builder;

interface ItemEloquentFilter
{
    public function filter(Builder $query, $value): Builder;
}
