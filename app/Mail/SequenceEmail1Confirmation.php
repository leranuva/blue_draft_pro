<?php

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SequenceEmail1Confirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Quote $quote
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'We received your quote request — Blue Draft Construction',
            replyTo: [config('mail.admin_notification_email', 'info@bluedraft.cc')],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.sequence.1-confirmation',
        );
    }
}
