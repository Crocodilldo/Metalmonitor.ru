<?php

namespace Tests\Feature\ApiTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

class CategoryCRUDTest extends TestCase
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

    public function test_index_return_all_categories(): void
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/categories');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_store_category()
    {
        $response = $this->postJson('/api/admin/categories', [
            'name' => 'Электроды',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Электроды');

        $this->assertDatabaseHas('categories', [
            'name' => 'Электроды']);
    }

    public function test_show_category()
    {
        $category = Category::factory()->create();

        $response = $this->getJson("/api/admin/categories/{$category->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.name', $category->name);
    }

    public function test_update_category()
    {
        $category = Category::factory()->create();
        $response = $this->putJson("/api/admin/categories/{$category->id}", ['name' => 'Электроды']);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Электроды');

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Электроды'
        ]);
    }

    public function test_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/admin/categories/{$category->id}");

        $response->assertStatus(200)
            ->assertExactJson(['message' => 'It was deleted']);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
