<?php

declare(strict_types=1);

namespace App\Repositories\Interface;

use App\DTO\ProductStoreDTO;
use App\DTO\ProductUpdateDTO;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function store(ProductStoreDTO $dto): Product;

    public function update(Product $product, ProductUpdateDTO $dto): Product;
}
