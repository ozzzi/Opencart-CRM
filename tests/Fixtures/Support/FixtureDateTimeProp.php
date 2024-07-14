<?php

declare(strict_types=1);

namespace Tests\Fixtures\Support;

use DateTime;

class FixtureDateTimeProp
{
    public function __construct(
        public readonly DateTime $createdAt,
    ) {
    }
}
