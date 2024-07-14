<?php

declare(strict_types=1);

namespace Tests\Fixtures\Support;

class FixtureSimple
{
    public function __construct(
        public readonly string $name,
        public readonly string $fullName,
    ) {
    }
}
