<?php

declare(strict_types=1);

namespace Modules\Request\Data;

use App\Enums\Store;

class RequestData
{
    public function __construct(
        public readonly ?int $order_id,
        public readonly ?int $client_id,
        public readonly int $status_id,
        public readonly string $name,
        public readonly ?string $phone,
        public readonly ?string $comment,
        public readonly Store $store
    ) {
    }

    public function toArray(): array
    {
        return [
            'order_id' => $this->order_id ?? null,
            'client_id' => $this->client_id ?? null,
            'status_id' => $this->status_id,
            'name' => $this->name,
            'phone' => $this->phone ?? null,
            'comment' => $this->comment ?? null,
            'store' => $this->store->value
        ];
    }
}
