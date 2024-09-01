<?php

declare(strict_types=1);

namespace Modules\Notification\Interfaces;

interface Notification
{
    public function notify(string $message, ?string $title = null): bool;
}
