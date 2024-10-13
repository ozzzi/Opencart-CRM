<?php

declare(strict_types=1);

namespace Modules\Request\Model\Filters;

use App\Models\Filter\ItemEloquentFilter;
use Illuminate\Database\Eloquent\Builder;

class NotCompletedFilter implements ItemEloquentFilter
{
    public function filter(Builder $query, $value): Builder
    {
        $statuses = array_unique(array_merge([], ...array_values(config('store.status_completed'))));

        return $query->whereNotIn('status_id', $statuses);
    }
}
