<?php

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProposalFollowUpNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Quote $quote
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📋 Follow-up propuesta — ' . $this->quote->client_name . ' (5+ días)',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.proposal-follow-up',
        );
    }
}
