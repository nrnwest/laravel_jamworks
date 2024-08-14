<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\DTO\OrderDTO;
use App\Models\Order;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     */
    public function testStore(): void
    {
        $user            = User::factory()->create();
        $orderRepository = new OrderRepository(new Order());
        $orderService    = new OrderService($orderRepository);

        $products = [
            'products' =>
                ['product_id' => 1, 'price' => 100, 'quantity' => 2],
            ['product_id' => 2, 'price' => 150, 'quantity' => 1],
        ];

        $orderDTO = new OrderDTO($products, $user->id);

        $order = $orderService->store($orderDTO);

        $this->assertDatabaseHas('orders', [
            'id'      => $order->id,
            'user_id' => $user->id,
            'total'   => 350,
        ]);
    }
}
