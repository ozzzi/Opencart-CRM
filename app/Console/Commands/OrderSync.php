<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Order\Services\OrderService;
use Throwable;

class OrderSync extends Command
{
    protected $signature = 'app:order-sync';

    protected $description = 'Synchronization external order';

    public function __construct(
        private readonly OrderService $orderService,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        foreach (config('store.list') as $store) {
            try {
                $this->orderService->sync($store);
            } catch (Throwable $e) {
                Log::channel('request')->error($e, [
                    'store' => $store->value
                ]);
            }

        }

        return self::SUCCESS;
    }
}
