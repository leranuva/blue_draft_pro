<?php

namespace Tests\Feature;

use App\Filament\Pages\CustomDashboard;
use App\Models\Quote;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MetricsSystemTest extends TestCase
{
    use RefreshDatabase;

    protected function createQuote(array $overrides = []): Quote
    {
        $defaults = [
            'client_name' => 'Test Client',
            'email' => 'test@example.com',
            'service_type' => 'residential',
            'is_partial' => false,
            'step' => 2,
            'status' => 'pending',
            'stage' => Quote::STAGE_NEW,
        ];
        return Quote::create(array_merge($defaults, $overrides));
    }

    public function test_dashboard_renders_without_errors_when_authenticated(): void
    {
        $user = User::factory()->create(['email' => 'admin@bluedraft.cc']);
        $response = $this->actingAs($user)->get('/system-bd-access');
        $response->assertSuccessful();
    }

    public function test_dashboard_view_data_includes_all_metric_keys(): void
    {
        $user = User::factory()->create(['email' => 'admin@bluedraft.cc']);
        $this->actingAs($user)->get('/system-bd-access');

        $dashboard = new CustomDashboard;
        $data = $dashboard->getViewData();

        $this->assertArrayHasKey('revenueBySource', $data);
        $this->assertArrayHasKey('velocity', $data);
        $this->assertArrayHasKey('scoreVsClose', $data);
        $this->assertArrayHasKey('forecast', $data);
        $this->assertArrayHasKey('boroughDeep', $data);
        $this->assertArrayHasKey('calculatorMetrics', $data);
        $this->assertArrayHasKey('funnel', $data);
        $this->assertArrayHasKey('pipeline', $data);
    }

    public function test_revenue_by_source_groups_by_lead_source(): void
    {
        $this->createQuote(['lead_source' => 'google', 'stage' => Quote::STAGE_WON, 'closed_value' => 50000, 'closed_at' => now()]);
        $this->createQuote(['lead_source' => 'google', 'stage' => Quote::STAGE_LOST, 'closed_at' => now()]);
        $this->createQuote(['lead_source' => 'facebook', 'stage' => Quote::STAGE_WON, 'closed_value' => 30000, 'closed_at' => now()]);

        $dashboard = new CustomDashboard;
        $data = $dashboard->getViewData();
        $revenueBySource = $data['revenueBySource'];

        $sources = $revenueBySource->pluck('source')->toArray();
        $this->assertContains('google', $sources);
        $this->assertContains('facebook', $sources);

        $google = $revenueBySource->firstWhere('source', 'google');
        $this->assertNotNull($google);
        $this->assertEquals(2, $google->leads);
        $this->assertEquals(1, $google->won);
        $this->assertEquals(50000, (float) $google->revenue);
        $this->assertEquals(50.0, $google->close_rate_pct);
        $this->assertEquals(50000, $google->avg_ticket);
    }

    public function test_revenue_by_source_falls_back_to_utm_source_when_lead_source_empty(): void
    {
        $this->createQuote(['lead_source' => '', 'utm_source' => 'newsletter', 'stage' => Quote::STAGE_WON, 'closed_value' => 25000, 'closed_at' => now()]);

        $dashboard = new CustomDashboard;
        $data = $dashboard->getViewData();
        $revenueBySource = $data['revenueBySource'];

        $newsletter = $revenueBySource->firstWhere('source', 'newsletter');
        $this->assertNotNull($newsletter);
        $this->assertEquals(1, $newsletter->leads);
        $this->assertEquals(25000, (float) $newsletter->revenue);
    }

    public function test_revenue_by_source_defaults_to_website_when_no_source(): void
    {
        $this->createQuote(['lead_source' => null, 'utm_source' => null, 'stage' => Quote::STAGE_NEW]);

        $dashboard = new CustomDashboard;
        $data = $dashboard->getViewData();
        $revenueBySource = $data['revenueBySource'];

        $website = $revenueBySource->firstWhere('source', 'website');
        $this->assertNotNull($website);
        $this->assertEquals(1, $website->leads);
    }

    public function test_score_vs_close_rate_calculates_percentages_correctly(): void
    {
        // Hot: 2 total, 1 won = 50%
        $this->createQuote(['lead_score' => 10, 'stage' => Quote::STAGE_WON, 'closed_value' => 10000, 'closed_at' => now()]);
        $this->createQuote(['lead_score' => 9, 'stage' => Quote::STAGE_LOST, 'closed_at' => now()]);

        // Warm: 2 total, 1 won = 50%
        $this->createQuote(['lead_score' => 6, 'stage' => Quote::STAGE_WON, 'closed_value' => 8000, 'closed_at' => now()]);
        $this->createQuote(['lead_score' => 7, 'stage' => Quote::STAGE_NEW]);

        // Cold: 1 total, 0 won = 0%
        $this->createQuote(['lead_score' => 2, 'stage' => Quote::STAGE_LOST, 'closed_at' => now()]);

        $dashboard = new CustomDashboard;
        $data = $dashboard->getViewData();
        $scoreVsClose = $data['scoreVsClose'];

        $this->assertEquals(50.0, $scoreVsClose['hot']);
        $this->assertEquals(50.0, $scoreVsClose['warm']);
        $this->assertEquals(0.0, $scoreVsClose['cold']);
        $this->assertEquals(2, $scoreVsClose['hot_total']);
        $this->assertEquals(2, $scoreVsClose['warm_total']);
        $this->assertEquals(1, $scoreVsClose['cold_total']);
    }

    public function test_forecast_calculates_expected_revenue(): void
    {
        // 2 proposal_sent, 1 won = 50% close rate
        $this->createQuote([
            'stage' => Quote::STAGE_PROPOSAL_SENT,
            'estimated_value' => 60000,
            'first_contacted_at' => now()->subDays(5),
            'proposal_sent_at' => now()->subDays(2),
        ]);
        $this->createQuote([
            'stage' => Quote::STAGE_PROPOSAL_SENT,
            'estimated_value' => 40000,
            'first_contacted_at' => now()->subDays(5),
            'proposal_sent_at' => now()->subDays(2),
        ]);
        $this->createQuote([
            'stage' => Quote::STAGE_WON,
            'closed_value' => 50000,
            'closed_at' => now(),
            'first_contacted_at' => now()->subDays(10),
            'proposal_sent_at' => now()->subDays(5),
        ]);

        $dashboard = new CustomDashboard;
        $data = $dashboard->getViewData();
        $forecast = $data['forecast'];

        // Pipeline = 60000 + 40000 = 100000, close rate 50% => expected 50000
        $this->assertEquals(50.0, $forecast['close_rate']);
        $this->assertEquals(100000.0, $forecast['pipeline']);
        $this->assertEquals(50000.0, $forecast['expected']);
    }

    public function test_borough_deep_includes_metrics_per_borough(): void
    {
        $this->createQuote([
            'borough' => 'manhattan',
            'stage' => Quote::STAGE_WON,
            'closed_value' => 80000,
            'closed_at' => now(),
            'created_at' => now()->subDays(20),
        ]);
        $this->createQuote([
            'borough' => 'manhattan',
            'stage' => Quote::STAGE_LOST,
            'closed_at' => now(),
        ]);
        $this->createQuote([
            'borough' => 'brooklyn',
            'stage' => Quote::STAGE_WON,
            'closed_value' => 40000,
            'closed_at' => now(),
            'created_at' => now()->subDays(15),
        ]);

        $dashboard = new CustomDashboard;
        $data = $dashboard->getViewData();
        $boroughDeep = $data['boroughDeep'];

        $manhattan = $boroughDeep->firstWhere('borough', 'manhattan');
        $this->assertNotNull($manhattan);
        $this->assertEquals(2, $manhattan->leads);
        $this->assertEquals(1, $manhattan->won);
        $this->assertEquals(80000, (float) $manhattan->revenue);
        $this->assertEquals(50.0, $manhattan->close_rate_pct);
        $this->assertEquals(80000, $manhattan->avg_ticket);

        $brooklyn = $boroughDeep->firstWhere('borough', 'brooklyn');
        $this->assertNotNull($brooklyn);
        $this->assertEquals(1, $brooklyn->leads);
        $this->assertEquals(1, $brooklyn->won);
        $this->assertEquals(40000, (float) $brooklyn->revenue);
    }

    public function test_velocity_metrics_use_first_contacted_and_proposal_sent(): void
    {
        $created = now()->subDays(10);
        $firstContacted = now()->subDays(8);
        $proposalSent = now()->subDays(5);
        $closed = now();

        $quote = $this->createQuote([
            'stage' => Quote::STAGE_WON,
            'closed_value' => 50000,
            'closed_at' => $closed,
            'first_contacted_at' => $firstContacted,
            'proposal_sent_at' => $proposalSent,
        ]);
        \DB::table('quotes')->where('id', $quote->id)->update(['created_at' => $created]);

        $dashboard = new CustomDashboard;
        $data = $dashboard->getViewData();
        $velocity = $data['velocity'];

        $this->assertEquals(2, $velocity['to_first_contact']);
        $this->assertEquals(5, $velocity['to_proposal']);
        $this->assertEquals(10, $velocity['to_close']);
    }

    public function test_quote_sets_first_contacted_at_when_moving_to_contacted(): void
    {
        $quote = $this->createQuote(['stage' => Quote::STAGE_NEW]);
        $this->assertNull($quote->first_contacted_at);

        $quote->update(['stage' => Quote::STAGE_CONTACTED]);
        $quote->refresh();
        $this->assertNotNull($quote->first_contacted_at);
    }

    public function test_quote_sets_proposal_sent_at_when_moving_to_proposal_sent(): void
    {
        $quote = $this->createQuote(['stage' => Quote::STAGE_QUALIFIED]);
        $this->assertNull($quote->proposal_sent_at);

        $quote->update(['stage' => Quote::STAGE_PROPOSAL_SENT]);
        $quote->refresh();
        $this->assertNotNull($quote->proposal_sent_at);
    }

    public function test_quote_does_not_overwrite_first_contacted_at_on_subsequent_stage_changes(): void
    {
        $quote = $this->createQuote(['stage' => Quote::STAGE_NEW]);
        $quote->update(['stage' => Quote::STAGE_CONTACTED]);
        $quote->refresh();
        $firstContacted = $quote->first_contacted_at;

        $quote->update(['stage' => Quote::STAGE_QUALIFIED]);
        $quote->refresh();
        $this->assertEquals($firstContacted->toDateTimeString(), $quote->first_contacted_at->toDateTimeString());
    }

    public function test_monthly_report_command_runs_successfully(): void
    {
        $period = Carbon::now()->subMonth();
        $this->artisan('report:monthly', [
            '--month' => $period->month,
            '--year' => $period->year,
            '--no-pdf' => true,
        ])->assertSuccessful();
    }

    public function test_monthly_report_includes_revenue_by_source_and_borough_deep(): void
    {
        $period = Carbon::now()->subMonth();
        $this->createQuote([
            'created_at' => $period->copy()->day(15),
            'lead_source' => 'google',
            'stage' => Quote::STAGE_WON,
            'closed_value' => 35000,
            'closed_at' => $period->copy()->day(20),
            'borough' => 'manhattan',
        ]);

        $this->artisan('report:monthly', [
            '--month' => $period->month,
            '--year' => $period->year,
            '--no-pdf' => true,
        ])->assertSuccessful();
    }

    public function test_dashboard_fallback_data_when_exception(): void
    {
        $dashboard = new CustomDashboard;
        $data = $dashboard->getViewData();

        $this->assertIsArray($data);
        $this->assertArrayHasKey('revenueBySource', $data);
        $this->assertArrayHasKey('velocity', $data);
        $this->assertArrayHasKey('scoreVsClose', $data);
        $this->assertArrayHasKey('forecast', $data);
        $this->assertArrayHasKey('boroughDeep', $data);
        $this->assertArrayHasKey('calculatorMetrics', $data);
    }

    public function test_quote_extract_tracking_includes_utm_content(): void
    {
        $request = \Illuminate\Http\Request::create('/test?utm_source=google&utm_medium=cpc&utm_campaign=spring&utm_content=banner-v1&lead_source=google');
        $request->setLaravelSession(app('session')->driver('array'));

        $tracking = Quote::extractTrackingFromRequest($request);

        $this->assertArrayHasKey('utm_content', $tracking);
        $this->assertEquals('banner-v1', $tracking['utm_content']);
    }
}
