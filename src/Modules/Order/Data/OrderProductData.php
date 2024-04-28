<?php

declare(strict_types=1);

namespace Modules\Order\Data;

use App\Support\Traits\ObjectArray;
use Illuminate\Contracts\Support\Arrayable;

class OrderProductData implements Arrayable
{
    use ObjectArray;

    /**
     * @param int $orderId
     * @param int $productId
     * @param string $name
     * @param string $model
     * @param int $quantity
     * @param float $price
     * @param float $total
     * @param OrderProductOptionData[] $options
     */
    public function __construct(
        public readonly int $orderId,
        public readonly int $productId,
        public readonly string $name,
        public readonly string $model,
        public readonly int $quantity,
        public readonly float $price,
        public readonly float $total,
        public readonly array $options = []
    ) {
    }
}
