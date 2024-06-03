<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\ProductStoreDTO;
use App\DTO\ProductUpdateDTO;
use App\Models\Product;
use App\Repositories\Interface\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(private Product $product)
    {
    }

    public function store(ProductStoreDTO $dto): Product
    {
        return $this->product->create((array)$dto);
    }

    public function update(Product $product, ProductUpdateDTO $dto): Product
    {
        $product->update((array)$dto);

        return $product;
    }


}
