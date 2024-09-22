<?php

declare(strict_types=1);

namespace App\Models\Filter;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

interface Filter
{
    public function apply(EloquentBuilder|QueryBuilder $query): Builder;
}
