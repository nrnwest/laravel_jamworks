<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\ProductStoreDTO;
use App\DTO\ProductUpdateDTO;
use App\Models\Product;
use App\Repositories\Interface\ProductRepositoryInterface;

class ProductService
{
    public function __construct(private ProductRepositoryInterface $productRepository)
    {
    }

    public function store(ProductStoreDTO $dto): Product
    {
        return $this->productRepository->store($dto);
    }

    public function update(Product $product, ProductUpdateDTO $dto): Product
    {
        return $this->productRepository->update($product, $dto);
    }
}
