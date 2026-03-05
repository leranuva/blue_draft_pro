<?php

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeadNotContactedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Quote $quote
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '⚠️ Lead not contacted 24h — ' . $this->quote->client_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.lead-not-contacted',
        );
    }
}
