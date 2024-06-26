<?php

namespace App\Events;

use App\DTO\OrderDTO;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderDispatchedEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public OrderDTO $orderDTO, public User $user)
    {
    }

}
