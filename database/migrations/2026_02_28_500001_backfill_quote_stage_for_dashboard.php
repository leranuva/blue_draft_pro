<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Backfill stage for quotes that have NULL or empty stage.
     * Fixes dashboard not showing leads when stage column exists but has null values.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('quotes', 'stage')) {
            return;
        }

        \DB::table('quotes')
            ->whereNull('stage')
            ->orWhere('stage', '')
            ->update(['stage' => 'new']);

        if (Schema::hasColumn('quotes', 'status')) {
            \DB::table('quotes')
                ->where('stage', 'new')
                ->where('status', 'contacted')
                ->update(['stage' => 'contacted']);

            \DB::table('quotes')
                ->whereIn('stage', ['new', 'contacted'])
                ->where('status', 'completed')
                ->update(['stage' => 'won']);
        }
    }

    public function down(): void
    {
        // No rollback needed
    }
};
