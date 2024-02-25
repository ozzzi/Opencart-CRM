<?php

namespace Database\Factories\Orders;

use App\Enums\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\OrderStatus\Models\OrderStatus;

/**
 * @extends Factory<OrderStatus>
 */
class OrderStatusFactory extends Factory
{
    protected $model = OrderStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'external_id' => 1,
            'store' => Store::Wildbear->value,
            'name' => 'Progressing',
        ];
    }
}
