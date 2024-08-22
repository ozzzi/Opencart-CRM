<?php

namespace Tests\Feature\Request;

use App\Enums\Store;
use App\Models\User;
use Database\Factories\Orders\OrderStatusFactory;
use Database\Factories\Requests\RequestFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RequestTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function test_create_success(): void
    {
        $status = OrderStatusFactory::new()->create();

        $response = $this->post('/requests', [
            'status_id' => $status->id,
            'name' => 'Test',
            'phone' => '80931112233',
            'comment' => 'call me',
            'store' => Store::Wildbear->value,
        ]);

        $response->assertRedirectToRoute('requests.index');

        $this->assertDatabaseHas('clients', [
            'name' => 'Test',
        ]);

        $this->assertDatabaseHas('requests', [
            'name' => 'Test',
        ]);
    }

    public function test_edit_success(): void
    {
        $request = RequestFactory::new()->create();

        $response = $this->put("/requests/{$request->id}", [
            'name' => 'Will Smith',
            'phone' => '380942233444',
            'status_id' => $request->status_id,
            'store' => Store::Wildbear->value,
        ]);

        $response->assertRedirectToRoute('requests.index');

        $this->assertDatabaseHas('requests', [
            'phone' => '380942233444',
        ]);
    }

    public function test_delete_success(): void
    {
        $request = RequestFactory::new()->create();

        $this->delete("/requests/{$request->id}");

        $this->assertDatabaseMissing('requests', [
            'id' => $request->id
        ]);
    }
}
