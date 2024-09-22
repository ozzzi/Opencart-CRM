<?php

declare(strict_types=1);

namespace Modules\Client\Models\Filters;

use App\Models\Filter\ItemEloquentFilter;
use Illuminate\Database\Eloquent\Builder;

class ContactFilter implements ItemEloquentFilter
{
    public function filter(Builder $query, $value): Builder
    {
        return $query->whereHas('contacts', function (Builder $subQuery) use ($value) {
            $subQuery->where('value', 'like', "%$value%");
        });
    }
}
