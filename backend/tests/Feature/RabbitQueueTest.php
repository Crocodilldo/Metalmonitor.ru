<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Queue;
use App\Jobs\TestRabbitJob;
use Tests\TestCase;

class RabbitQueueTest extends TestCase
{
    public function test_rabbit_queue_dispatch(): void
        {
            // Используем fake, чтобы не обрабатывать реальную очередь
            $response=Queue::fake();

            // Отправляем job
            TestRabbitJob::dispatch();

            // Проверяем, что job была отправлена
            $response->assertPushed(TestRabbitJob::class);
        }
}
