<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompleteDataSuccess extends Mailable {

    use Queueable, SerializesModels;
    public Order $order;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Complete data success'
        );
    }


    public function content(): Content {
        return new Content(
            view: 'mail.complete-data-success',
            with: ['order' => $this->order],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
