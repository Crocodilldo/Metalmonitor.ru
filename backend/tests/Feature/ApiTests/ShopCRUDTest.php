<?php

namespace Tests\Feature\ApiTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Shop;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

class ShopCRUDTest extends TestCase
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

    public function test_index_return_all_shops(): void
    {
        Shop::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/shops');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_store_shop()
    {
        $response = $this->postJson('/api/admin/shops', [
            'name' => 'Формула М2',
            'url' => 'http://formulam2.com',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Формула М2');

        $this->assertDatabaseHas('shops', [
            'name' => 'Формула М2',
            'slug' => 'FormulaM2',
            'url' => 'http://formulam2.com'
        ]);
    }

    public function test_show_shop()
    {
        $shop = Shop::factory()->create();

        $response = $this->getJson("/api/admin/shops/{$shop->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.name', $shop->name);
    }

    public function test_update_shop()
    {
        $shop = Shop::factory()->create();
        $response = $this->putJson("/api/admin/shops/{$shop->id}", ['name' => 'Updated Shop', 'url' => 'http://updated.com']);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Updated Shop');

        $this->assertDatabaseHas('shops', [
            'id' => $shop->id,
            'name' => 'Updated Shop',
        ]);
    }

    public function test_delete_shop()
    {
        $shop = Shop::factory()->create();

        $response = $this->deleteJson("/api/admin/shops/{$shop->id}");

        $response->assertStatus(200)
            ->assertExactJson(['message' => 'It was deleted']);

        $this->assertDatabaseMissing('shops', ['id' => $shop->id]);
    }
}
