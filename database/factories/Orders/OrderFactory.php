<?php

declare(strict_types=1);

namespace Database\Factories\Orders;

use App\Enums\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Order\Models\Order;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => fake()->randomNumber(3),
            'store' => Store::Wildbear,
            'name' => fake()->name,
            'email' => fake()->email,
            'phone' => fake()->phoneNumber,
            'payment_method' => fake()->word,
            'shipping_method' => fake()->word,
            'shipping_city' => fake()->city,
            'shipping_zone' => fake()->word,
            'comment' => fake()->text,
            'total' => fake()->randomFloat(2, 0, 100),
            'status_id' => fake()->randomNumber(1),
            'date_added' => now(),
        ];
    }
}
