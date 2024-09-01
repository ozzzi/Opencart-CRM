<?php

namespace App\Listeners\Notification;

use App\Events\Orders\OrderCreated;
use Modules\Notification\NotificationService;
use Modules\Notification\Telegram\TelegramNotification;

class OrderNotification
{
    public function __construct(private readonly NotificationService $notificationService)
    {
    }

    public function handle(OrderCreated $event): void
    {
        $message = sprintf('Заказ номер %s оформлен', $event->orderId);

        $this->notificationService->setService(new TelegramNotification(
            config('services.telegram.token'),
            config('services.telegram.chat_id')
        ));

        $this->notificationService->notify($message, 'Новый заказ');
    }
}
