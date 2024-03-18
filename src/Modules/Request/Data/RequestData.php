<?php

declare(strict_types=1);

namespace Modules\Request\Data;

use App\Enums\Store;
use App\Support\Traits\ObjectArray;

class RequestData
{
    use ObjectArray;

    public function __construct(
        public readonly ?int $orderId,
        public readonly ?int $clientId,
        public readonly int $statusId,
        public readonly string $name,
        public readonly ?string $phone,
        public readonly ?string $comment,
        public readonly Store $store
    ) {
    }
}
