<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InviteCompanion extends Mailable {

    use Queueable, SerializesModels;
    public User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }


    public function envelope(): Envelope {
        return new Envelope(
            subject: 'You are invite to APEC 2024',
        );
    }


    public function content(): Content {
        return new Content(
            view: 'mail.invite-companion',
            with: ['user' => $this->user]
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