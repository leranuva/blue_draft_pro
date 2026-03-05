<?php

namespace App\Console\Commands;

use App\Jobs\FollowUpProposalSent;
use App\Jobs\NotifyNewLeadAfter24Hours;
use App\Models\Quote;
use Illuminate\Console\Command;

class CheckLeadFollowUps extends Command
{
    protected $signature = 'leads:check-followups';

    protected $description = 'Dispatch jobs for leads needing attention (new+24h, proposal_sent+5d)';

    public function handle(): int
    {
        $newCount = Quote::where('stage', Quote::STAGE_NEW)
            ->where('created_at', '<=', now()->subHours(24))
            ->count();

        Quote::where('stage', Quote::STAGE_NEW)
            ->where('created_at', '<=', now()->subHours(24))
            ->each(fn (Quote $q) => NotifyNewLeadAfter24Hours::dispatch($q));

        $proposalCount = Quote::where('stage', Quote::STAGE_PROPOSAL_SENT)
            ->where(function ($q) {
                $q->where('last_contacted_at', '<=', now()->subDays(5))
                    ->orWhere(function ($q2) {
                        $q2->whereNull('last_contacted_at')
                            ->where('updated_at', '<=', now()->subDays(5));
                    });
            })
            ->count();

        Quote::where('stage', Quote::STAGE_PROPOSAL_SENT)
            ->where(function ($q) {
                $q->where('last_contacted_at', '<=', now()->subDays(5))
                    ->orWhere(function ($q2) {
                        $q2->whereNull('last_contacted_at')
                            ->where('updated_at', '<=', now()->subDays(5));
                    });
            })
            ->each(fn (Quote $q) => FollowUpProposalSent::dispatch($q));

        $this->info("Dispatched: {$newCount} new-lead notifications, {$proposalCount} proposal follow-ups.");

        return self::SUCCESS;
    }
}
