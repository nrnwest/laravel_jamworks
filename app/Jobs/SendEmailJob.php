<?php

declare(strict_types=1);

namespace App\Jobs;

use App\DTO\OrderDTO;
use App\Mail\OrderDispatchedMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private OrderDTO $orderDTO, private User $user)
    {
    }

    public function handle()
    {
        Mail::to($this->user->email)->send(new OrderDispatchedMail($this->orderDTO));
    }
}
