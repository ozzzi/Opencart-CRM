<?php

declare(strict_types=1);

namespace App\Models\Filter;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class BaseFilter implements Filter
{
    /**
     * @var array<string, mixed>
     */
    protected array $values = [];

    /**
     * @var array<string, class-string>
     */
    protected array $filters = [];

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function apply(EloquentBuilder|QueryBuilder $query): Builder
    {
        foreach ($this->receivedFilters() as $name => $value) {
            if (!$value) {
                continue;
            }

            $filterInstance = $this->resolveFilter($name);
            $query = $filterInstance->filter($query, $this->values[$name]);
        }

        return $query;
    }

    protected function resolveFilter(string $name): ItemEloquentFilter|ItemQueryBuilderFilter
    {
        return new $this->filters[$name]();
    }

    /**
     * @return array<string, class-string>
     */
    protected function receivedFilters(): array
    {
        $values = array_filter($this->values);

        return array_intersect_key($this->filters, $values);
    }
}
