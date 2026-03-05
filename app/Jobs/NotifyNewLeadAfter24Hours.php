<?php

namespace App\Jobs;

use App\Mail\LeadNotContactedNotification;
use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyNewLeadAfter24Hours implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Quote $quote
    ) {}

    public function handle(): void
    {
        if ($this->quote->stage !== Quote::STAGE_NEW) {
            return;
        }

        if ($this->quote->created_at->diffInHours(now()) < 24) {
            return;
        }

        $to = config('mail.admin_notification_email', env('ADMIN_NOTIFICATION_EMAIL', 'info@bluedraft.cc'));

        try {
            Mail::to($to)->send(new LeadNotContactedNotification($this->quote));
            Log::info('Lead not contacted notification sent', ['quote_id' => $this->quote->id]);
        } catch (\Exception $e) {
            Log::error('Failed to send lead not contacted notification', [
                'quote_id' => $this->quote->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
