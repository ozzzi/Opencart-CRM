<?php

declare(strict_types=1);

namespace App\Listeners\Notification;

use App\Events\Orders\OrderNonCompleted;
use Modules\Notification\NotificationService;
use Modules\Notification\Telegram\TelegramNotification;

class OrderStatusNotification
{
    public function __construct(private readonly NotificationService $notificationService)
    {
    }

    public function handle(OrderNonCompleted $event): void
    {
        $this->notificationService->setService(new TelegramNotification(
            config('services.telegram.token'),
            (int) config('services.telegram.chat_id')
        ));

        $message = sprintf("Есть необработанные заказы %s", $event->store);

        $this->notificationService->notify($message, 'Необработанные заказы');
    }
}
