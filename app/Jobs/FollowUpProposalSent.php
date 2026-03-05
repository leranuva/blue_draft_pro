<?php

namespace App\Jobs;

use App\Mail\ProposalFollowUpNotification;
use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FollowUpProposalSent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Quote $quote
    ) {}

    public function handle(): void
    {
        if ($this->quote->stage !== Quote::STAGE_PROPOSAL_SENT) {
            return;
        }

        $lastContact = $this->quote->last_contacted_at ?? $this->quote->updated_at;
        if ($lastContact->diffInDays(now()) < 5) {
            return;
        }

        $to = config('mail.admin_notification_email', env('ADMIN_NOTIFICATION_EMAIL', 'info@bluedraft.cc'));

        try {
            Mail::to($to)->send(new ProposalFollowUpNotification($this->quote));
            Log::info('Proposal follow-up notification sent', ['quote_id' => $this->quote->id]);
        } catch (\Exception $e) {
            Log::error('Failed to send proposal follow-up notification', [
                'quote_id' => $this->quote->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
