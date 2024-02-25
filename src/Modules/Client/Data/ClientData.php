<?php

declare(strict_types=1);

namespace Modules\Client\Data;

use App\Enums\Store;

class ClientData
{
    /**
     * @param string $name
     * @param string|null $address
     * @param string|null $comment
     * @param bool $isBad
     * @param Store $store
     * @param ContactsData[] $contacts
     */
    public function __construct(
        public readonly string $name,
        public readonly ?string $address,
        public readonly bool $isBad,
        public readonly Store $store,
        public readonly array $contacts = [],
        public readonly ?string $comment = null,
    ) {
    }
}
