<?php

declare(strict_types=1);

namespace Modules\Notification;

use Modules\Notification\Interfaces\Notification;
use WeakMap;

final class NotificationService
{
    private WeakMap $services;

    public function __construct()
    {
        $this->services = new WeakMap();
    }

    public function setService(Notification $notification): void
    {
        $this->services[$notification] = $notification;
    }

    public function notify(string $message, ?string $title = null): void
    {
        foreach ($this->services as $notification) {
            $notification->notify($message, $title);
        }
    }
}
