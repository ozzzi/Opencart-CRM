<?php

declare(strict_types=1);

namespace Modules\Client\Models\Filters;

use App\Models\Filter\ItemEloquentFilter;
use Illuminate\Database\Eloquent\Builder;

class IsBadFilter implements ItemEloquentFilter
{
    public function filter(Builder $query, $value): Builder
    {
        return $query->where('is_bad', 1);
    }
}
