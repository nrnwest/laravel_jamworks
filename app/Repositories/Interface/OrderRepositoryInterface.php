<?php

declare(strict_types=1);

namespace App\Repositories\Interface;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function store($userId, $total): Order;

    public function attachProductsToOrder(Order $order, array $products): Order;
}
