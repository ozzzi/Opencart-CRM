<?php

declare(strict_types=1);

namespace Tests\Fixtures\Support;

use App\Enums\Store;

class FixtureEnumProp
{
    public function __construct(public readonly Store $store)
    {
    }
}
