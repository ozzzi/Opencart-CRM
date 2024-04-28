<?php

declare(strict_types=1);

namespace Modules\Order\Data;

use App\Support\Traits\ObjectArray;
use Illuminate\Contracts\Support\Arrayable;

class OrderProductOptionData implements Arrayable
{
    use ObjectArray;

    public function __construct(
        public readonly int $orderProductId,
        public readonly string $name,
        public readonly string $value
    ) {
    }
}
