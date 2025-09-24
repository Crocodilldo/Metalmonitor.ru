<?php

namespace Tests\Unit\ParsingTests;

use PHPUnit\Framework\TestCase;
use App\Services\ParsingServices\ProductParameterNormalizerService;

class ProductParameterNormalizerServiceTest extends TestCase
{
    private ProductParameterNormalizerService $service;

    protected function setUp(): void
    {
        $this->service = new ProductParameterNormalizerService();
    }

    public function test_normalize_sizes()
    {
        $raw = ['Труба профильная 10,5x20.5/30'];
        $result = $this->service->normalize($raw);

        $this->assertEquals(['30*20.5*10.5'], $result);
    }


    public function test_no_matches()
    {
        $raw = ['цукенфыва'];
        $result = $this->service->normalize($raw);

        $this->assertEquals([''], $result);
    }

}
