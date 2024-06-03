<?php

declare(strict_types=1);

namespace App\DTO;

class ProductUpdateDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public int $price,
    ) {
    }
}
