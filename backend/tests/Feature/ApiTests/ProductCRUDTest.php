<?php

namespace Tests\Feature\ApiTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

class ProductCRUDTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin
        $this->admin = User::factory()->create([
            'email' => 'admin@xyz.com',
            'password' => Hash::make('password'),
        ]);

        Sanctum::actingAs($this->admin, ['*']);
    }
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
