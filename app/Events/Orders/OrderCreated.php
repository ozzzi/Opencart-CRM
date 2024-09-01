<?php

namespace App\Events\Orders;

use Illuminate\Foundation\Events\Dispatchable;

class OrderCreated
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public int $orderId
    ) {
    }
}
