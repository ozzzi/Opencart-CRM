<?php

declare(strict_types=1);

namespace Modules\Client\Data;

use Modules\Client\Enums\ContactType;

class ContactsData
{
    public function __construct(
        public readonly ContactType $type,
        public readonly string $value
    ) {
    }
}
