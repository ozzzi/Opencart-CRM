<?php

declare(strict_types=1);

namespace App\Models\Filter;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

trait Filterable
{
    public function scopeFilter(EloquentBuilder $query, Filter $filter): Builder
    {
        return $filter->apply($query);
    }
}
