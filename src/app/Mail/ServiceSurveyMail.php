<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServiceSurveyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $slug,
        public string $name,
        public string $email,
        public string $mensaje,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo relevamiento de servicio',
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'mail.service-survey',
        );
    }
}
