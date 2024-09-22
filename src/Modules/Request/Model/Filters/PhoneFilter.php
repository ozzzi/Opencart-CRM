<?php

declare(strict_types=1);

namespace Modules\Request\Model\Filters;

use App\Models\Filter\ItemEloquentFilter;
use Illuminate\Database\Eloquent\Builder;

class PhoneFilter implements ItemEloquentFilter
{
    public function filter(Builder $query, $value): Builder
    {
        return $query->where('phone', 'like', "%$value%");
    }
}
