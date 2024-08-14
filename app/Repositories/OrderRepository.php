<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interface\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    public function __construct(private Order $order)
    {
    }

    public function store($userId, $total): Order
    {
        return $this->order->create(['user_id' => $userId, 'total' => $total]);
    }

    public function attachProductsToOrder(Order $order, array $products): Order
    {
        DB::transaction(function () use ($order, $products) {
            $order->products()->syncWithoutDetaching($products);
        });

        return $order;
    }


}
