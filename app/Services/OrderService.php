<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\OrderDTO;
use App\Models\Order;
use App\Repositories\Interface\OrderRepositoryInterface;

class OrderService
{
    public function __construct(private OrderRepositoryInterface $orderRepository)
    {
    }

    public function store(OrderDTO $dto): Order
    {
        $total = $this->calculateTotal($dto);
        $order = $this->orderRepository->store($dto->userId, $total);
        $data  = $this->getProductSyncData($dto);

        return $this->orderRepository->attachProductsToOrder($order, $data);
    }

    private function calculateTotal(OrderDTO $dto): int|float
    {
        return collect($dto->products)->sum(function ($product) {
            return $product['price'] * $product['quantity'];
        });
    }

    private function getProductSyncData(OrderDTO $dto): array
    {
        $productSyncData = [];
        foreach ($dto->products as $productData) {
            $productSyncData[$productData['product_id']] = ['quantity' => $productData['quantity']];
        }

        return $productSyncData;
    }

}
