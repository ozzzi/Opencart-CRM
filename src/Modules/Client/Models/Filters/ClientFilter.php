<?php

declare(strict_types=1);

namespace Modules\Client\Models\Filters;

use App\Models\Filter\BaseFilter;

class ClientFilter extends BaseFilter
{
    /**
     * @var array<string, class-string>
     */
    protected array $filters = [
        'address' => AddressFilter::class,
        'contact' => ContactFilter::class,
        'store' => StoreFilter::class,
        'name' => NameFilter::class,
        'is_bad' => IsBadFilter::class,
    ];
}
