<?php

namespace App\Console\Commands;

use App\Models\Quote;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class GenerateMonthlyReport extends Command
{
    protected $signature = 'report:monthly
                            {--month= : Month (1-12), default: previous month}
                            {--year= : Year, default: current or previous}
                            {--email : Send PDF by email to admin}
                            {--no-pdf : Show in console only, do not generate PDF}';

    protected $description = 'Generate monthly executive report with KPIs (leads, conversion, revenue, borough, service)';

    public function handle(): int
    {
        $month = (int) ($this->option('month') ?: now()->subMonth()->month);
        $year = (int) ($this->option('year') ?: now()->subMonth()->year);
        $period = Carbon::create($year, $month, 1);
        $periodLabel = $period->locale('en')->translatedFormat('F Y');

        $data = $this->gatherReportData($period);

        $this->info("=== Executive Report: {$periodLabel} ===");
        $this->table(
            ['KPI', 'Value'],
            [
                ['Total leads', $data['leads_total']],
                ['Leads contacted <24h (%)', $data['contacted_24h_pct'] . '%'],
                ['Proposals sent', $data['proposals_sent']],
                ['Close rate (%)', $data['close_rate_pct'] . '%'],
                ['Avg. time to close (days)', $data['avg_close_days']],
                ['Revenue earned', '$' . number_format($data['revenue_won'], 0)],
                ['Pipeline potential', '$' . number_format($data['revenue_pipeline'], 0)],
                ['Top borough', $data['top_borough']],
                ['Top service', $data['top_service']],
            ]
        );

        if (!$this->option('no-pdf')) {
            $pdfPath = $this->generatePdf($period, $periodLabel, $data);
            $this->info("PDF generated: {$pdfPath}");

            if ($this->option('email')) {
                $this->sendReportEmail($pdfPath, $periodLabel);
            }
        }

        return self::SUCCESS;
    }

    private function gatherReportData(Carbon $period): array
    {
        $start = $period->copy()->startOfMonth();
        $end = $period->copy()->endOfMonth();

        $base = Quote::whereBetween('created_at', [$start, $end]);
        $leadsTotal = (clone $base)->count();

        $driver = \DB::connection()->getDriverName();
        $contacted24hQuery = Quote::whereBetween('created_at', [$start, $end])
            ->where('stage', '!=', Quote::STAGE_NEW)
            ->whereNotNull('last_contacted_at');
        $contacted24hRaw = match ($driver) {
            'pgsql' => 'EXTRACT(EPOCH FROM (last_contacted_at - created_at)) / 3600 <= 24',
            'sqlite' => '(julianday(last_contacted_at) - julianday(created_at)) * 24 <= 24',
            default => 'TIMESTAMPDIFF(HOUR, created_at, last_contacted_at) <= 24',
        };
        $contacted24h = $contacted24hQuery->whereRaw($contacted24hRaw)->count();
        $completeCount = (clone $base)->where('is_partial', false)->count();
        $contacted24hPct = $completeCount > 0 ? round(($contacted24h / $completeCount) * 100, 1) : 0;

        $proposalsSent = (clone $base)->where('stage', Quote::STAGE_PROPOSAL_SENT)->count();
        $wonCount = (clone $base)->where('stage', Quote::STAGE_WON)->count();
        $closeRatePct = $proposalsSent > 0 ? round(($wonCount / $proposalsSent) * 100, 1) : 0;

        $avgDaysRaw = match ($driver) {
            'pgsql' => 'AVG(EXTRACT(EPOCH FROM (COALESCE(closed_at, updated_at) - created_at)) / 86400)',
            'sqlite' => 'AVG((julianday(COALESCE(closed_at, updated_at)) - julianday(created_at)))',
            default => 'AVG(TIMESTAMPDIFF(DAY, created_at, COALESCE(closed_at, updated_at)))',
        };
        $avgCloseDays = (int) round((float) Quote::whereBetween('created_at', [$start, $end])
            ->where('stage', Quote::STAGE_WON)
            ->selectRaw($avgDaysRaw . ' as avg_days')
            ->value('avg_days') ?? 0);

        $revenueWon = (float) Quote::whereBetween('created_at', [$start, $end])
            ->where('stage', Quote::STAGE_WON)
            ->whereNotNull('closed_value')
            ->sum('closed_value');

        $revenuePipeline = (float) Quote::whereBetween('created_at', [$start, $end])
            ->whereIn('stage', [Quote::STAGE_QUALIFIED, Quote::STAGE_PROPOSAL_SENT])
            ->whereNotNull('estimated_value')
            ->sum('estimated_value');

        $topBorough = Quote::whereBetween('created_at', [$start, $end])
            ->whereNotNull('borough')
            ->where('borough', '!=', '')
            ->selectRaw('borough, count(*) as total')
            ->groupBy('borough')
            ->orderByDesc('total')
            ->value('borough');
        $topBorough = $topBorough ? (Quote::getBoroughs()[$topBorough] ?? $topBorough) : '—';

        $topService = Quote::whereBetween('created_at', [$start, $end])
            ->selectRaw('service_type, count(*) as total')
            ->groupBy('service_type')
            ->orderByDesc('total')
            ->value('service_type');
        $topService = $topService ? ucfirst($topService) : '—';

        return [
            'leads_total' => $leadsTotal,
            'contacted_24h_pct' => $contacted24hPct,
            'proposals_sent' => $proposalsSent,
            'close_rate_pct' => $closeRatePct,
            'avg_close_days' => $avgCloseDays,
            'revenue_won' => $revenueWon,
            'revenue_pipeline' => $revenuePipeline,
            'top_borough' => $topBorough,
            'top_service' => $topService,
            'by_borough' => Quote::whereBetween('created_at', [$start, $end])
                ->whereNotNull('borough')
                ->where('borough', '!=', '')
                ->selectRaw('borough, count(*) as total')
                ->groupBy('borough')
                ->orderByDesc('total')
                ->get(),
            'by_service' => Quote::whereBetween('created_at', [$start, $end])
                ->selectRaw('service_type, count(*) as total')
                ->groupBy('service_type')
                ->orderByDesc('total')
                ->get(),
            'revenue_by_source' => $this->getRevenueBySourceForPeriod($start, $end),
            'borough_deep' => $this->getBoroughDeepForPeriod($start, $end),
        ];
    }

    private function getRevenueBySourceForPeriod($start, $end): \Illuminate\Support\Collection
    {
        $sourceExpr = "COALESCE(NULLIF(lead_source, ''), NULLIF(utm_source, ''), 'website')";
        return Quote::whereBetween('created_at', [$start, $end])
            ->selectRaw("$sourceExpr as source, count(*) as leads,
                sum(case when stage = 'won' then 1 else 0 end) as won,
                coalesce(sum(case when stage = 'won' then closed_value else 0 end), 0) as revenue")
            ->groupByRaw($sourceExpr)
            ->orderByDesc('revenue')
            ->get()
            ->map(fn ($r) => (object) [
                'source' => $r->source,
                'leads' => $r->leads,
                'won' => $r->won,
                'revenue' => (float) $r->revenue,
                'close_rate_pct' => $r->leads > 0 ? round(($r->won / $r->leads) * 100, 1) : 0,
                'avg_ticket' => $r->won > 0 ? round((float) $r->revenue / $r->won, 0) : 0,
            ]);
    }

    private function getBoroughDeepForPeriod($start, $end): \Illuminate\Support\Collection
    {
        $driver = \DB::connection()->getDriverName();
        $daysExpr = match ($driver) {
            'pgsql' => "AVG(CASE WHEN stage = 'won' AND closed_at IS NOT NULL THEN EXTRACT(EPOCH FROM (closed_at - created_at)) / 86400 END)",
            'sqlite' => "AVG(CASE WHEN stage = 'won' AND closed_at IS NOT NULL THEN (julianday(closed_at) - julianday(created_at)) END)",
            default => "AVG(CASE WHEN stage = 'won' AND closed_at IS NOT NULL THEN TIMESTAMPDIFF(DAY, created_at, closed_at) END)",
        };
        return Quote::whereBetween('created_at', [$start, $end])
            ->whereNotNull('borough')->where('borough', '!=', '')
            ->selectRaw("borough, count(*) as leads,
                sum(case when stage = 'won' then 1 else 0 end) as won,
                coalesce(sum(case when stage = 'won' then closed_value else 0 end), 0) as revenue,
                $daysExpr as avg_days")
            ->groupBy('borough')
            ->orderByDesc('revenue')
            ->get()
            ->map(fn ($r) => (object) [
                'borough' => $r->borough,
                'leads' => $r->leads,
                'won' => $r->won,
                'revenue' => (float) $r->revenue,
                'close_rate_pct' => $r->leads > 0 ? round(($r->won / $r->leads) * 100, 1) : 0,
                'avg_ticket' => $r->won > 0 ? round((float) $r->revenue / $r->won, 0) : 0,
                'avg_days' => (int) round((float) ($r->avg_days ?? 0)),
            ]);
    }

    private function generatePdf(Carbon $period, string $periodLabel, array $data): string
    {
        $pdf = Pdf::loadView('reports.monthly', [
            'period' => $periodLabel,
            'data' => $data,
            'boroughs' => Quote::getBoroughs(),
        ])->setPaper('a4');

        $filename = 'reporte-mensual-' . $period->format('Y-m') . '.pdf';
        $path = 'reports/' . $filename;
        Storage::disk('local')->put($path, $pdf->output());

        return storage_path('app/' . $path);
    }

    private function sendReportEmail(string $pdfPath, string $periodLabel): void
    {
        $to = config('mail.admin_notification_email');
        if (!$to) {
            $this->warn('No ADMIN_NOTIFICATION_EMAIL configured. Email not sent.');
            return;
        }

        Mail::raw("Monthly executive report: {$periodLabel}. See attachment.", function ($message) use ($to, $pdfPath, $periodLabel) {
            $message->to($to)
                ->subject("Blue Draft — Executive Report {$periodLabel}")
                ->attach($pdfPath, ['as' => "report-{$periodLabel}.pdf"]);
        });

        $this->info("Report sent to {$to}");
    }
}
