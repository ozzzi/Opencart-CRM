<?php

declare(strict_types=1);

namespace Tests\Feature\Notifications;

use Illuminate\Support\Facades\Http;
use Modules\Notification\Telegram\TelegramNotification;
use PHPUnit\Framework\TestCase;

class TelegramNotificationTest extends TestCase
{
    public function test_notify_success(): void
    {
        Http::fake([
            TelegramNotification::HOST . '*' => Http::response(['ok' => true])
        ]);

        $result = (new TelegramNotification('abc', 123))->notify('test', 'test');

        $this->assertTrue($result);
    }
}
