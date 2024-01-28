<?php

namespace Database\Factories;

use App\Enums\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Client\Models\Client;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'address' => fake()->address,
            'comment' => fake()->text(200),
            'is_bad' => 0,
            'store' => Store::Wildbear,
        ];
    }

    protected $model = Client::class;
}
