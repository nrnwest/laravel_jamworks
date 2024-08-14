<?php

declare(strict_types=1);

namespace App\DTO;

class ProductStoreDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public int $price,
        public int $user_id,
    ) {
    }
}
