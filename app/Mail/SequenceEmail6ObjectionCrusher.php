<?php

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SequenceEmail6ObjectionCrusher extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Quote $quote
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permits, delays, hidden costs — we answer your top concerns',
            replyTo: [config('mail.admin_notification_email', 'info@bluedraft.cc')],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.sequence.6-objection-crusher',
        );
    }
}
