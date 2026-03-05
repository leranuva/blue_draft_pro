<?php

namespace Tests\Feature;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CommandsTest extends TestCase
{
    use RefreshDatabase;

    public function test_mark_abandoned_quotes_runs_successfully(): void
    {
        $this->artisan('quotes:mark-abandoned')
            ->assertSuccessful();
    }

    public function test_mark_abandoned_quotes_marks_old_partial_quotes(): void
    {
        $oldQuote = Quote::create([
            'client_name' => 'Old',
            'email' => 'old@example.com',
            'service_type' => 'residential',
            'is_partial' => true,
            'step' => 1,
            'status' => 'pending',
            'stage' => Quote::STAGE_NEW,
        ]);
        DB::table('quotes')->where('id', $oldQuote->id)->update([
            'created_at' => now()->subHours(25)->toDateTimeString(),
        ]);

        $this->artisan('quotes:mark-abandoned')
            ->assertSuccessful();

        $oldQuote->refresh();
        $this->assertNotNull($oldQuote->abandoned_at);
    }

    public function test_leads_check_followups_runs_successfully(): void
    {
        $this->artisan('leads:check-followups')
            ->assertSuccessful();
    }
}
