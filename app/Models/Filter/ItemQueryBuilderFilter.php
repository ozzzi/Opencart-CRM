<?php

declare(strict_types=1);

namespace App\Models\Filter;

use Illuminate\Database\Query\Builder;

interface ItemQueryBuilderFilter
{
    public function filter(Builder $query, $value): Builder;
}
