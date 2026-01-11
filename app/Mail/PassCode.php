<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PassCode extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public $user,
        public $code
    ) {
        $this->onConnection('database');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Temporary Password for Account Access',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.passcode',
            with: [
                'user' => $this->user,
                'code' => $this->code,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
