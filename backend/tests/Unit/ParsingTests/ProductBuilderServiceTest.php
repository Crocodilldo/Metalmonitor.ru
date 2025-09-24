<?php

namespace Tests\Unit\ParsingTests;

use PHPUnit\Framework\TestCase;
use App\Services\ParsingServices\ProductBuilderService;
use Illuminate\Support\Carbon;

class ProductBuilderServiceTest extends TestCase
{
    private ProductBuilderService $service;

    protected function setUp(): void
    {
        $this->service = new ProductBuilderService();

        // фиксируем время
        Carbon::setTestNow(Carbon::create('2025-09-24 12:00:00'));
    }

    public function test_build_product()
    {
        $result = $this->service->build(
            ['Профильная труба 20*20'],
            ['20*20'],
            [123],
            ['/metal/1'],
            1,
            2
        );

        $this->assertCount(1, $result);
        $this->assertEquals([
            'name'        => 'Профильная труба 20*20',
            'category_id' => 2,
            'shop_id'     => 1,
            'parameter'   => '20*20',
            'price'       => 123,
            'url'         => '/metal/1',
            'updated_at'  => '2025-09-24 12:00:00',
        ], $result[0]);
    }

    public function test_uses_defaults_when_data_missing()
    {
        $result = $this->service->build(
            ['Профильная труба'],
            [],
            [],
            ['/metal/1'],
            5,
            2
        );

        $this->assertEquals([
            'name'        => 'Профильная труба',
            'category_id' => 2,
            'shop_id'     => 5,
            'parameter'   => '-',
            'price'       => '-',
            'url'         => '/metal/1',
            'updated_at'  => '2025-09-24 12:00:00',
        ], $result[0]);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow(); // сброс мокнутого времени
    }
}
