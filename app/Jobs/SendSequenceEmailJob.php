<?php

namespace App\Jobs;

use App\Mail\SequenceEmail1Confirmation;
use App\Mail\SequenceEmail2Education;
use App\Mail\SequenceEmail3Authority;
use App\Mail\SequenceEmail4Urgency;
use App\Mail\SequenceEmail5CaseStudy;
use App\Mail\SequenceEmail6ObjectionCrusher;
use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendSequenceEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Quote $quote,
        public int $emailNumber
    ) {}

    public function handle(): void
    {
        if ($this->emailNumber < 1 || $this->emailNumber > 6) {
            return;
        }

        $alreadySent = DB::table('quote_email_sequence_log')
            ->where('quote_id', $this->quote->id)
            ->where('email_number', $this->emailNumber)
            ->exists();

        if ($alreadySent) {
            Log::debug('Sequence email already sent', ['quote_id' => $this->quote->id, 'email' => $this->emailNumber]);
            return;
        }

        $mailable = match ($this->emailNumber) {
            1 => new SequenceEmail1Confirmation($this->quote),
            2 => new SequenceEmail2Education($this->quote),
            3 => new SequenceEmail3Authority($this->quote),
            4 => new SequenceEmail4Urgency($this->quote),
            5 => new SequenceEmail5CaseStudy($this->quote),
            6 => new SequenceEmail6ObjectionCrusher($this->quote),
            default => null,
        };

        if (!$mailable) {
            return;
        }

        try {
            Mail::to($this->quote->email)->send($mailable);
            DB::table('quote_email_sequence_log')->insert([
                'quote_id' => $this->quote->id,
                'email_number' => $this->emailNumber,
                'sent_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Log::info('Sequence email sent', ['quote_id' => $this->quote->id, 'email' => $this->emailNumber]);
        } catch (\Exception $e) {
            Log::error('Sequence email failed', [
                'quote_id' => $this->quote->id,
                'email' => $this->emailNumber,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
