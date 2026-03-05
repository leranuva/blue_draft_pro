<?php

namespace App\Console\Commands;

use App\Models\Quote;
use Illuminate\Console\Command;

class MarkAbandonedQuotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotes:mark-abandoned';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Marca como abandoned_at los quotes parciales (Step 1) con más de 24h sin completar';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $cutoff = now()->subHours(24);

        $count = Quote::where('is_partial', true)
            ->whereNull('abandoned_at')
            ->where('created_at', '<', $cutoff)
            ->update(['abandoned_at' => now()]);

        $this->info("Marcados {$count} quotes como abandonados.");

        return self::SUCCESS;
    }
}
