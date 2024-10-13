<?php

namespace App\Console\Commands\Orders;

use Illuminate\Console\Command;
use Modules\Order\Repositories\ExternalOrderRepository;
use Modules\Order\Repositories\OrderRepository;
use Modules\Request\Repositories\RequestRepository;

class OrderStatusUpdate extends Command
{
    protected $signature = 'app:order-status-update';

    protected $description = 'Update order statuses';

    private bool $shouldExit = false;

    /**
     * Execute the console command.
     */
    public function handle(
        RequestRepository $requestRepository,
        OrderRepository $orderRepository
    ): int {
        $this->trap([SIGINT, SIGTERM], function () {
            $this->shouldExit = true;
        });

        foreach (config('store.list') as $store) {
            $externalOrderRepository = new ExternalOrderRepository($store);

            if ($this->shouldExit) {
                $this->info(now()->format('H:i:s') . ' - Exit');

                return Command::SUCCESS;
            }

            $requests = $requestRepository->listNotCompleted($store);

            foreach ($requests as $request) {
                $statusId = $externalOrderRepository->statusId($request->order_id_ext);

                $requestRepository->update($request->id, [
                    'status_id' => $statusId
                ]);

                $orderRepository->update($request->order_id, [
                    'status_id' => $statusId
                ]);
            }
        }


        return self::SUCCESS;
    }
}
