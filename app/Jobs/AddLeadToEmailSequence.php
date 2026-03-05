<?php

namespace App\Jobs;

use App\Models\Quote;
use App\Services\EmailSequenceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddLeadToEmailSequence implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Quote $quote
    ) {}

    public function handle(EmailSequenceService $service): void
    {
        $service->addLeadToSequence($this->quote);
    }
}
