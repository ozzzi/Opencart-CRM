<?php

declare(strict_types=1);

namespace Modules\Order\Data;

use App\Support\Traits\ObjectArray;
use Illuminate\Contracts\Support\Arrayable;

class OrderProductData implements Arrayable
{
    use ObjectArray;

    public function __construct(
        public readonly int $orderId,
        public readonly int $productId,
        public readonly string $name,
        public readonly string $model,
        public readonly int $quantity,
        public readonly float $price
    ) {
    }
}
