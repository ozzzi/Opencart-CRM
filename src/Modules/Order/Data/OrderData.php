<?php

declare(strict_types=1);

namespace Modules\Order\Data;

use App\Enums\Store;
use App\Support\Traits\ObjectArray;
use Illuminate\Contracts\Support\Arrayable;

class OrderData implements Arrayable
{
    use ObjectArray;

    /**
     * @param int $orderId
     * @param Store $store
     * @param string $name
     * @param string|null $email
     * @param string $phone
     * @param string $paymentMethod
     * @param string $shippingMethod
     * @param string $shippingCity
     * @param string $shippingZone
     * @param string|null $comment
     * @param float $total
     * @param int $statusId
     * @param string $dateAdded
     * @param OrderProductData[] $products
     */
    public function __construct(
        public readonly int $orderId,
        public readonly Store $store,
        public readonly string $name,
        public readonly ?string $email,
        public readonly string $phone,
        public readonly string $paymentMethod,
        public readonly string $shippingMethod,
        public readonly string $shippingCity,
        public readonly string $shippingZone,
        public readonly ?string $comment,
        public readonly float $total,
        public readonly int $statusId,
        public readonly string $dateAdded,
        public readonly array $products
    ) {
    }
}
