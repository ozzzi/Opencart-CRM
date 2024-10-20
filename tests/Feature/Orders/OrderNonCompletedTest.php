<?php

namespace Tests\Feature\Orders;

use App\Enums\Store;
use Database\Factories\Orders\OrderFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Order\Repositories\OrderRepository;
use Tests\TestCase;

class OrderNonCompletedTest extends TestCase
{
    use RefreshDatabase;

    private OrderRepository $orderRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->orderRepository = new OrderRepository();
    }

    public function test_empty_list(): void
    {
        OrderFactory::new()->count(2)->create([
            'status_id' => config('store.status_completed')[Store::Wildbear->value][0],
        ]);

        $this->assertDatabaseCount('orders', 2);
        $this->assertEquals(0, $this->orderRepository->listOldNotCompleted(Store::Wildbear)->count());
    }

    public function test_exist_old_non_competed_order(): void
    {
        OrderFactory::new()->create();
        OrderFactory::new()->create([
            'date_added' => now()->subDays(3),
            'status_id' => config('store.status_processing')[Store::Wildbear->value][0],
        ]);

        $this->assertDatabaseCount('orders', 2);
        $this->assertEquals(1, $this->orderRepository->listOldNotCompleted(Store::Wildbear)->count());
    }
}
