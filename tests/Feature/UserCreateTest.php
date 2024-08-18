<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_created(): void
    {
        $this->artisan('app:user-create')
            ->expectsQuestion('Name', 'test')
            ->expectsQuestion('Email', 'test@test.com')
            ->expectsQuestion('Password', 1234567)
            ->assertSuccessful();

        $this->assertDatabaseHas(
            'users',
            [
                'name' => 'test',
                'email' => 'test@test.com'
            ]
        );
    }
}
