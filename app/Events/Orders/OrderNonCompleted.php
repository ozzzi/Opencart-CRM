<?php

declare(strict_types=1);

namespace App\Events\Orders;

use Illuminate\Foundation\Events\Dispatchable;

class OrderNonCompleted
{
    use Dispatchable;

    public function __construct(public string $store)
    {
    }
}
