<?php

declare(strict_types=1);

namespace App\Mail;

use App\DTO\OrderDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderDispatchedMail extends Mailable
{
    use Queueable, SerializesModels;

    public const SUBJECT = 'Your order has been queued';

    public function __construct(private OrderDTO $orderDTO)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: self::SUBJECT,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order.dispatched',
            with: [
                'order' => $this->orderDTO,
            ]
        );
    }

}
