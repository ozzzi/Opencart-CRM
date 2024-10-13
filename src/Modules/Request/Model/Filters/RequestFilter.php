<?php

declare(strict_types=1);

namespace Modules\Request\Model\Filters;

use App\Models\Filter\BaseFilter;

class RequestFilter extends BaseFilter
{
    /**
     * @var array<string, class-string>
     */
    protected array $filters = [
        'date_from' => DateFromFilter::class,
        'date_to' => DateToFilter::class,
        'name' => NameFilter::class,
        'phone' => PhoneFilter::class,
        'store' => StoreFilter::class,
        'status' => StatusFilter::class,
        'not_completed' => NotCompletedFilter::class,
    ];
}
