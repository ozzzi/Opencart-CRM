<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Client\Enums\ContactType;
use Modules\Client\Models\ClientContact;

/**
 * @extends Factory<ClientContact>
 */
class ClientContactFactory extends Factory
{
    public function definition(): array
    {
        $client = ClientFactory::new()->create();

        return [
            'client_id' => $client->id,
            'type' => ContactType::Phone->value,
            'value' => fake()->phoneNumber,
        ];
    }

    protected $model = ClientContact::class;
}
