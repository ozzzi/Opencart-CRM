<?php

declare(strict_types=1);

namespace App\Support\Flash;

final class Message
{
    public function __construct(
        public readonly string $message,
        public readonly FlashTypes $type
    ) {
    }
}
