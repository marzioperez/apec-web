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
    public string $password;

    public function __construct(User $user, string $password) {
        $this->user = $user;
        $this->password = $password;
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'APEC CEO Summit 2024 - Forgot  your password?',
        );
    }

    public function content(): Content {
        return new Content(
            view: 'mail.reset-password',
            with: ['user' => $this->user, 'password' => $this->password],
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
