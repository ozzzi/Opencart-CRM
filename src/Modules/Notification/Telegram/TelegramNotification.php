<?php

declare(strict_types=1);

namespace Modules\Notification\Telegram;

use Illuminate\Support\Facades\Http;
use Modules\Notification\Exceptions\Notificationexception;
use Modules\Notification\Interfaces\Notification;
use Throwable;

final class TelegramNotification implements Notification
{
    public const HOST = 'https://api.telegram.org/bot';

    public function __construct(
        private readonly string $token,
        private readonly int $chatId
    ) {
    }

    public function notify(string $message, ?string $title = null): bool
    {
        try {
            $response = Http::get(self::HOST . $this->token . '/sendMessage', [
                'chat_id' => $this->chatId,
                'text' => sprintf('<b>%s</b>: %s', $title, $message),
                'parse_mode' => 'HTML'
            ])
                ->throw()
                ->json();

            return $response['ok'] ?? false;
        } catch (Throwable $e) {
            report(new NotificationException($e->getMessage()));

            return false;
        }

    }
}
