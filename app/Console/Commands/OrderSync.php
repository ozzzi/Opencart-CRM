<?php

namespace App\Console\Commands;

use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Order\Services\OrderService;
use Throwable;

class OrderSync extends Command
{
    protected $signature = 'app:order-sync {dateStart?}';

    protected $description = 'Synchronization external order. Date format: d-m-Y';

    public function __construct(
        private readonly OrderService $orderService,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $dateStart = $this->argument('dateStart')
            ? DateTime::createFromFormat('d-m-Y', $this->argument('dateStart'))
            : new DateTime();

        foreach (config('store.list') as $store) {
            try {
                $this->orderService->sync($store, $dateStart);
            } catch (Throwable $e) {
                Log::channel('request')->error($e, [
                    'store' => $store->value
                ]);
            }
        }

        return self::SUCCESS;
    }
}
