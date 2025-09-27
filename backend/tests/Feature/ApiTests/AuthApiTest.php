<?php

namespace Tests\Feature\ApiTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;
    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Создаем администратора в базе
        $this->admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
    }

    public function test_login_return_token()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'user',
                'token',
            ]);
    }

    public function test_login_with_wrong_password_return_401()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'admin@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertExactJson(['Wrong email or password']);
    }

    public function test_logout()
    {

        $token = $this->admin->createToken('api-token')->plainTextToken;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/logout');

        $response->assertStatus(200)
            ->assertExactJson(['message' => 'Logged out']);

        // Обновляем модель, чтобы подтянуть токены из БД
        $this->admin->refresh();

        // Проверяем, что токены удалены
        $this->assertCount(0, $this->admin->tokens);
    }
}
