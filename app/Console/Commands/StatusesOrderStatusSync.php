<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\OrderStatus\Services\OrderStatusSyncService;

class StatusesOrderStatusSync extends Command
{
    protected $signature = 'app:order-status-sync';

    protected $description = 'Synchronization external order statuses';

    public function handle(): int
    {
        foreach (config('store.list') as $store) {
            (new OrderStatusSyncService($store))->process();
        }

        return self::SUCCESS;
    }
}
