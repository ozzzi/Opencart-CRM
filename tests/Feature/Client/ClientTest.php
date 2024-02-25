<?php

namespace Tests\Feature\Client;

use App\Enums\Store;
use Database\Factories\ClientContactFactory;
use Database\Factories\ClientFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Client\Data\ClientData;
use Modules\Client\Data\ContactsData;
use Modules\Client\Enums\ContactType;
use Modules\Client\Services\ClientCreateService;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_success(): void
    {
        $response = $this->post('/clients', [
            'name' => 'John Doe',
            'address' => 'Street, 1',
            'store' => Store::Wildbear->value,
            'contacts' => [
                [
                    'type' => 'email',
                    'value' => 'test@test.com',
                ],
            ],
        ]);

        $response->assertRedirectToRoute('clients.index');

        $this->assertDatabaseHas('clients', [
            'name' => 'John Doe',
        ]);

        $this->assertDatabaseHas('client_contacts', [
            'client_id' => 1,
            'value' => 'test@test.com',
        ]);
    }

    public function test_create_wrong_fields(): void
    {
        $response = $this->post('/clients', [
            'name' => '',
            'address' => 'Street, 1',
            'contacts' => [
                [
                    'type' => 'email',
                    'value' => '',
                ],
            ],
        ]);

        $response->assertInvalid(['name', 'store', 'contacts.0.value']);
    }

    public function test_update_success(): void
    {
        $client = ClientFactory::new()->create();
        $contact = ClientContactFactory::new()->create([
            'client_id' => $client->id,
        ]);

        $this->put('/clients/' . $client->id, [
            'name' => 'Test name',
            'store' => Store::Wildbear->value,
            'contacts' => [
                $client->id => [
                    'type' => $contact->type,
                    'value' => '380931112233',
                ],
            ],
        ]);

        $this->assertDatabaseHas('clients', [
            'name' => 'Test name',
        ]);

        $this->assertDatabaseHas('client_contacts', [
            'client_id' => $client->id,
            'value' => '380931112233',
        ]);
    }

    public function test_delete_success(): void
    {
        $client = ClientFactory::new()->create();
        $contact = ClientContactFactory::new()->create([
            'client_id' => $client->id,
        ]);

        $response = $this->delete('/clients/' . $client->id);

        $response->assertRedirectToRoute('clients.index');

        $this->assertDatabaseMissing('clients', [
            'name' => $client->name,
        ]);

        $this->assertDatabaseMissing('client_contacts', [
            'client_id' => $client->id,
            'value' => $contact->value,
        ]);
    }

    public function test_client_service(): void
    {
        $clientCreateService = $this->app->make(ClientCreateService::class);

        $clientData = new ClientData(
            name: 'Test',
            address: 'street 12',
            comment: 'Cool client',
            isBad: false,
            store: Store::Wildbear,
            contacts: [
                new ContactsData(
                    type: ContactType::Phone,
                    value: '380931112233'
                ),
            ]
        );

        $clientCreateService($clientData);

        $this->assertDatabaseHas('clients', [
            'name' => 'Test',
        ]);
    }
}
