<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class RedisCacheTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_redis(): void
    {
        Cache::store('redis')->put('test_key', 'test_value', 10);

        $value = Cache::store('redis')->get('test_key');

        $this->assertEquals('test_value', $value);
    }
}
