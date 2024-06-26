<?php

declare(strict_types=1);

namespace App\DTO;

class OrderDTO
{
    public function __construct(
        public array $products,
        public int $userId
    ) {
    }
}
