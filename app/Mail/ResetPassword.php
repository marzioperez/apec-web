<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable {

    use Queueable, SerializesModels;
    public User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Reset Password',
        );
    }

    public function content(): Content {
        return new Content(
            view: 'mail.reset-password',
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
