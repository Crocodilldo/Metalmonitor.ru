<?php

namespace Tests\Feature\ApiTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Shop;

class ProductsResponseServiceTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void

    {
        parent::setUp();
        Category::factory()->count(6)->create();
        Shop::factory()->count(6)->create();
        Product::factory()->create([
            'name' => 'Труба металлическая профильная 50х50х2,0 мм 3 м',
            'category_id' => 2,
            'shop_id' => 1,
            'parameter' => '50*50*2',
            'price' => 914.0,
            'url' => '/catalog/21_obshchestroitelnye_materialy/metalloprokat/truby_metallicheskie/truba_metallicheskaya_profilnaya_50kh50kh2_0_mm_3_m/'
        ]);

        Product::factory()->create([
            'name' => 'Уголок металлический 50х5,0 мм 3 м',
            'category_id' => 6,
            'shop_id' => 1,
            'parameter' => '50*5',
            'price' => 1010.0,
            'url' => '/catalog/21_obshchestroitelnye_materialy/metalloprokat/ugolki/ugolok_metallicheskiy_50kh5_0_mm_3_m/'
        ]);

        Product::factory()->create([
            'name' => 'Уголок металлический 25х4,0 мм 3 м',
            'category_id' => 6,
            'shop_id' => 1,
            'parameter' => '25*4',
            'price' => 500.0,
            'url' => '/catalog/21_obshchestroitelnye_materialy/metalloprokat/ugolki/ugolok_metallicheskiy_25kh4_0_mm_3_m/'
        ]);
    }

    public function test_return_all_products()
    {
        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_return_by_category_filter()
    {
        $response = $this->getJson('/api/products?category_id=6');
        $response->assertStatus(200)
            ->assertJsonCount(2, 'data')
            ->assertJsonFragment(['name' => 'Уголок металлический 50х5,0 мм 3 м'])
            ->assertJsonFragment(['name' => 'Уголок металлический 25х4,0 мм 3 м']);
    }

    public function test_return_by_price_filter()
    {
        $response = $this->getJson('/api/products?min_price=500&max_price=1000');
        $response->assertStatus(200)
            ->assertJsonCount(2, 'data')
            ->assertJsonFragment(['name' => 'Труба металлическая профильная 50х50х2,0 мм 3 м'])
            ->assertJsonFragment(['name' => 'Уголок металлический 25х4,0 мм 3 м']);
    }

    public function test_return_by_search_filter()
    {
        $response = $this->getJson('/api/products?search=Уголок');
        $response->assertStatus(200)
            ->assertJsonCount(2, 'data')
            ->assertJsonFragment(['name' => 'Уголок металлический 50х5,0 мм 3 м'])
            ->assertJsonFragment(['name' => 'Уголок металлический 25х4,0 мм 3 м']);
    }

    public function test_return_by_all_filter()
    {
        $response = $this->getJson('/api/products?search=Уголок&category_id=6&min_price=500&max_price=800');
        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['name' => 'Уголок металлический 25х4,0 мм 3 м']);
    }

    public function test_negative_result()
    {
        $response = $this->getJson('/api/productssabc?sdfsrfrgw');
        $response->assertStatus(404);
    }
}
