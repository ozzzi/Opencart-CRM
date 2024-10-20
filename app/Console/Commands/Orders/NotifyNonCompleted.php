<?php

namespace App\Console\Commands\Orders;

use App\Events\Orders\OrderNonCompleted;
use Illuminate\Console\Command;
use Modules\Order\Repositories\OrderRepository;

class NotifyNonCompleted extends Command
{
    protected $signature = 'app:order-notify-non-completed';

    protected $description = 'Notify about non completed orders';

    public function handle(OrderRepository $orderRepository): int
    {
        foreach (config('store.list') as $store) {
            $qntOrders = $orderRepository->listOldNotCompleted($store)->count();

            if ($qntOrders > 0) {
                OrderNonCompleted::dispatch($store->value);
            }
        }

        return self::SUCCESS;
    }
}
