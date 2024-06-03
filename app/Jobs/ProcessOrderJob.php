<?php

declare(strict_types=1);

namespace App\Jobs;

use App\DTO\OrderDTO;
use App\Services\OrderService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private OrderDTO $dto)
    {
    }

    public function handle(OrderService $orderService): void
    {
        $orderService->store($this->dto);
    }
}
