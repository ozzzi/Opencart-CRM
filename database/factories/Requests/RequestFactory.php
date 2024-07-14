<?php

namespace Database\Factories\Requests;

use App\Enums\Store;
use Database\Factories\ClientFactory;
use Database\Factories\Orders\OrderStatusFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Request\Model\Request;

/**
 * @extends Factory<Request>
 */
class RequestFactory extends Factory
{
    protected $model = Request::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = OrderStatusFactory::new()->create();

        return [
            'client_id' => ClientFactory::new()->create()->id,
            'status_id' => $status->external_id,
            'name' => fake()->name,
            'phone' => fake()->phoneNumber,
            'comment' => fake()->text,
            'store' => Store::Wildbear,
            'date_added' => now(),
        ];
    }
}
