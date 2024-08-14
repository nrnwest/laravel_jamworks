<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\OrderDispatchedEvent;
use App\Jobs\SendEmailJob;

class SendOrderDispatchedEmailListener
{
    public function handle(OrderDispatchedEvent $event): void
    {
        SendEmailJob::dispatch($event->orderDTO, $event->user)->onQueue(config('queue.emails'));
    }
}
