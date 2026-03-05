<?php

namespace App\Filament\Pages;

use App\Models\Quote;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\DB;

class CustomDashboard extends BaseDashboard
{
    protected string $view = 'filament.pages.custom-dashboard';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-home';
    }

    public function getTitle(): string
    {
        return 'Dashboard';
    }

    public function getHeading(): string
    {
        return 'Welcome to Administration Panel';
    }

    private function getAvgCloseDays(): float
    {
        return $this->avgDaysBetween('created_at', 'closed_at', Quote::STAGE_WON);
    }

    private function avgDaysBetween(string $from, string $to, ?string $stage = null): float
    {
        try {
            $driver = DB::connection()->getDriverName();
            $q = Quote::query()->whereNotNull($to);
            if ($stage) {
                $q->where('stage', $stage);
            }
            $raw = match ($driver) {
                'pgsql' => "AVG(EXTRACT(EPOCH FROM (\"$to\" - \"$from\")) / 86400) as v",
                'sqlite' => "AVG((julianday($to) - julianday($from))) as v",
                default => "AVG(TIMESTAMPDIFF(DAY, $from, $to)) as v",
            };
            return (float) ($q->selectRaw($raw)->value('v') ?? 0);
        } catch (\Throwable $e) {
            return 0.0;
        }
    }

    public function getViewData(): array
    {
        try {
            return $this->buildViewData();
        } catch (\Throwable $e) {
            report($e);
            \Log::error('Dashboard buildViewData failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            $fallback = $this->getFallbackViewData();
            $fallback['_dashboard_error'] = $e->getMessage();
            return $fallback;
        }
    }

    private function getFallbackViewData(): array
    {
        return array_merge($this->getBaseFallback(), [
            'monthlyLeads' => ['current' => 0, 'previous' => 0, 'variation' => 0, 'variation_pct' => 0],
            'revenue' => ['won' => 0, 'pipeline' => 0, 'avgTicket' => 0],
            'revenueBySource' => collect(),
            'velocity' => ['to_first_contact' => 0, 'to_proposal' => 0, 'to_close' => 0],
            'scoreVsClose' => ['hot' => 0, 'warm' => 0, 'cold' => 0],
            'forecast' => ['close_rate' => 0, 'pipeline' => 0, 'expected' => 0],
            'boroughDeep' => collect(),
            'marginBySource' => collect(),
            'marginByBorough' => collect(),
            'calculatorMetrics' => [],
        ]);
    }

    private function getBaseFallback(): array
    {
        return [
            'funnel' => [
                'partial' => 0,
                'complete' => 0,
                'partial_to_complete_pct' => 0,
                'proposal_sent' => 0,
                'complete_to_proposal_pct' => 0,
                'won' => 0,
                'proposal_to_won_pct' => 0,
                'avg_close_days' => 0,
                'won_by_borough' => collect(),
            ],
            'pipeline' => [
                'new' => 0,
                'contacted' => 0,
                'qualified' => 0,
                'proposal_sent' => 0,
                'won' => 0,
                'lost' => 0,
            ],
            'alerts' => ['new_24h' => 0, 'proposal_followup' => 0],
            'bySource' => collect(),
            'byBorough' => collect(),
            'byService' => collect(),
            'topLeads' => collect(),
        ];
    }

    private function buildViewData(): array
    {
        $base = Quote::query();
        $partialCount = Quote::where('is_partial', true)->count();
        $completeCount = Quote::where('is_partial', false)->count();
        $totalStarted = $partialCount + $completeCount;
        $proposalCount = Quote::where('stage', Quote::STAGE_PROPOSAL_SENT)->count();
        $wonCount = Quote::where('stage', Quote::STAGE_WON)->count();

        $currentMonth = Quote::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $previousMonth = Quote::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $variation = $currentMonth - $previousMonth;
        $variationPct = $previousMonth > 0
            ? round(($variation / $previousMonth) * 100, 1)
            : ($currentMonth > 0 ? 100 : 0);

        $wonRevenue = (float) Quote::where('stage', Quote::STAGE_WON)
            ->whereNotNull('closed_value')
            ->sum('closed_value');
        $pipelineRevenue = (float) Quote::whereIn('stage', [Quote::STAGE_QUALIFIED, Quote::STAGE_PROPOSAL_SENT])
            ->whereNotNull('estimated_value')
            ->sum('estimated_value');
        $wonWithValue = Quote::where('stage', Quote::STAGE_WON)->whereNotNull('closed_value')->count();
        $avgTicket = $wonWithValue > 0 ? $wonRevenue / $wonWithValue : 0;

        return [
            'monthlyLeads' => [
                'current' => $currentMonth,
                'previous' => $previousMonth,
                'variation' => $variation,
                'variation_pct' => $variationPct,
            ],
            'revenue' => [
                'won' => $wonRevenue,
                'pipeline' => $pipelineRevenue,
                'avgTicket' => round($avgTicket, 2),
            ],
            'funnel' => [
                'partial' => $partialCount,
                'complete' => $completeCount,
                'partial_to_complete_pct' => $totalStarted > 0 ? round(($completeCount / $totalStarted) * 100, 1) : 0,
                'proposal_sent' => $proposalCount,
                'complete_to_proposal_pct' => $completeCount > 0 ? round(($proposalCount / $completeCount) * 100, 1) : 0,
                'won' => $wonCount,
                'proposal_to_won_pct' => $proposalCount > 0 ? round(($wonCount / $proposalCount) * 100, 1) : 0,
                'avg_close_days' => (int) round($this->getAvgCloseDays()),
                'won_by_borough' => Quote::where('stage', Quote::STAGE_WON)
                    ->whereNotNull('borough')
                    ->where('borough', '!=', '')
                    ->selectRaw('borough, count(*) as total')
                    ->groupBy('borough')
                    ->orderByDesc('total')
                    ->get(),
            ],
            'pipeline' => [
                'new' => (clone $base)->where('stage', Quote::STAGE_NEW)->count(),
                'contacted' => (clone $base)->where('stage', Quote::STAGE_CONTACTED)->count(),
                'qualified' => (clone $base)->where('stage', Quote::STAGE_QUALIFIED)->count(),
                'proposal_sent' => (clone $base)->where('stage', Quote::STAGE_PROPOSAL_SENT)->count(),
                'won' => (clone $base)->where('stage', Quote::STAGE_WON)->count(),
                'lost' => (clone $base)->where('stage', Quote::STAGE_LOST)->count(),
            ],
            'alerts' => [
                'new_24h' => Quote::where('stage', Quote::STAGE_NEW)
                    ->where('created_at', '<=', now()->subHours(24))
                    ->count(),
                'proposal_followup' => Quote::where('stage', Quote::STAGE_PROPOSAL_SENT)
                    ->where(function ($q) {
                        $q->where('last_contacted_at', '<=', now()->subDays(5))
                            ->orWhere(function ($q2) {
                                $q2->whereNull('last_contacted_at')
                                    ->where('updated_at', '<=', now()->subDays(5));
                            });
                    })
                    ->count(),
            ],
            'bySource' => Quote::selectRaw("COALESCE(NULLIF(lead_source, ''), NULLIF(utm_source, ''), 'website') as source, count(*) as total")
                ->groupByRaw('1')
                ->orderByDesc('total')
                ->limit(8)
                ->get(),
            'byBorough' => Quote::whereNotNull('borough')
                ->where('borough', '!=', '')
                ->selectRaw('borough, count(*) as total')
                ->groupBy('borough')
                ->orderByDesc('total')
                ->get(),
            'byService' => Quote::selectRaw('service_type, count(*) as total')
                ->groupBy('service_type')
                ->orderByDesc('total')
                ->get(),
            'topLeads' => Quote::whereIn('stage', [Quote::STAGE_NEW, Quote::STAGE_CONTACTED, Quote::STAGE_QUALIFIED, Quote::STAGE_PROPOSAL_SENT])
                ->orderByDesc('lead_score')
                ->take(5)
                ->get(),

            // Revenue by source (real ROI)
            'revenueBySource' => $this->getRevenueBySource(),

            // Sales velocity
            'velocity' => [
                'to_first_contact' => (int) round($this->avgDaysBetween('created_at', 'first_contacted_at', null)),
                'to_proposal' => (int) round($this->avgDaysBetween('created_at', 'proposal_sent_at', null)),
                'to_close' => (int) round($this->getAvgCloseDays()),
            ],

            // Score vs Close Rate
            'scoreVsClose' => $this->getScoreVsClose(),

            // Predictive forecast
            'forecast' => $this->getForecast($wonRevenue, $pipelineRevenue, $proposalCount, $wonCount),

            // Borough deep analysis
            'boroughDeep' => $this->getBoroughDeep(),

            // Expected margin by source and borough (calculator leads with expected_margin)
            'marginBySource' => $this->getMarginBySource(),
            'marginByBorough' => $this->getMarginByBorough(),

            // Calculator derived metrics (for landing ads)
            'calculatorMetrics' => $this->getCalculatorDerivedMetrics(),
        ];
    }

    private function getCalculatorDerivedMetrics(): array
    {
        $calculatorLeads = Quote::where('lead_source', 'calculator');
        $total = $calculatorLeads->count();
        if ($total === 0) {
            return [
                'calculator_to_quote_rate' => 0,
                'calculator_to_closed_rate' => 0,
                'average_margin_calculator' => 0,
                'revenue_from_calculator' => 0,
                'total_calculator_leads' => 0,
            ];
        }
        $completed = (clone $calculatorLeads)->where('is_partial', false)->count();
        $won = (clone $calculatorLeads)->where('stage', Quote::STAGE_WON)->count();
        $revenue = (float) Quote::where('lead_source', 'calculator')->where('stage', Quote::STAGE_WON)->sum('closed_value');
        $avgMargin = (float) Quote::where('lead_source', 'calculator')->whereNotNull('expected_margin')->avg('expected_margin');

        return [
            'calculator_to_quote_rate' => round(($completed / $total) * 100, 1),
            'calculator_to_closed_rate' => $completed > 0 ? round(($won / $completed) * 100, 1) : 0,
            'average_margin_calculator' => round($avgMargin ?? 0, 0),
            'revenue_from_calculator' => round($revenue, 0),
            'total_calculator_leads' => $total,
        ];
    }

    private function getRevenueBySource(): \Illuminate\Support\Collection
    {
        $sourceExpr = "COALESCE(NULLIF(lead_source, ''), NULLIF(utm_source, ''), 'website')";
        return Quote::selectRaw("$sourceExpr as source, count(*) as leads,
            sum(case when stage = 'won' then 1 else 0 end) as won,
            coalesce(sum(case when stage = 'won' then closed_value else 0 end), 0) as revenue")
            ->groupByRaw('1')
            ->orderByDesc('revenue')
            ->limit(10)
            ->get()
            ->map(function ($row) {
                $row->close_rate_pct = $row->leads > 0 ? round(($row->won / $row->leads) * 100, 1) : 0;
                $row->avg_ticket = $row->won > 0 ? round((float) $row->revenue / $row->won, 0) : 0;
                return $row;
            });
    }

    private function getScoreVsClose(): array
    {
        $hotTotal = Quote::whereBetween('lead_score', [9, 12])->count();
        $hotWon = Quote::whereBetween('lead_score', [9, 12])->where('stage', Quote::STAGE_WON)->count();
        $warmTotal = Quote::whereBetween('lead_score', [5, 8])->count();
        $warmWon = Quote::whereBetween('lead_score', [5, 8])->where('stage', Quote::STAGE_WON)->count();
        $coldTotal = Quote::whereBetween('lead_score', [0, 4])->count();
        $coldWon = Quote::whereBetween('lead_score', [0, 4])->where('stage', Quote::STAGE_WON)->count();

        return [
            'hot' => $hotTotal > 0 ? round(($hotWon / $hotTotal) * 100, 1) : 0,
            'warm' => $warmTotal > 0 ? round(($warmWon / $warmTotal) * 100, 1) : 0,
            'cold' => $coldTotal > 0 ? round(($coldWon / $coldTotal) * 100, 1) : 0,
            'hot_total' => $hotTotal,
            'warm_total' => $warmTotal,
            'cold_total' => $coldTotal,
        ];
    }

    private function getForecast(float $wonRevenue, float $pipelineRevenue, int $proposalCount, int $wonCount): array
    {
        $closeRate = $proposalCount > 0 ? ($wonCount / $proposalCount) * 100 : 0;
        $expected = $closeRate > 0 ? $pipelineRevenue * ($closeRate / 100) : 0;
        return [
            'close_rate' => round($closeRate, 1),
            'pipeline' => $pipelineRevenue,
            'expected' => round($expected, 0),
        ];
    }

    private function getBoroughDeep(): \Illuminate\Support\Collection
    {
        $driver = DB::connection()->getDriverName();
        $daysExpr = match ($driver) {
            'pgsql' => "AVG(CASE WHEN stage = 'won' AND closed_at IS NOT NULL THEN EXTRACT(EPOCH FROM (closed_at - created_at)) / 86400 END)",
            'sqlite' => "AVG(CASE WHEN stage = 'won' AND closed_at IS NOT NULL THEN (julianday(closed_at) - julianday(created_at)) END)",
            default => "AVG(CASE WHEN stage = 'won' AND closed_at IS NOT NULL THEN TIMESTAMPDIFF(DAY, created_at, closed_at) END)",
        };

        return Quote::whereNotNull('borough')
            ->where('borough', '!=', '')
            ->selectRaw("borough, count(*) as leads,
                sum(case when stage = 'won' then 1 else 0 end) as won,
                coalesce(sum(case when stage = 'won' then closed_value else 0 end), 0) as revenue,
                $daysExpr as avg_days")
            ->groupBy('borough')
            ->orderByDesc('revenue')
            ->get()
            ->map(function ($row) {
                $row->close_rate_pct = $row->leads > 0 ? round(($row->won / $row->leads) * 100, 1) : 0;
                $row->avg_ticket = $row->won > 0 ? round((float) $row->revenue / $row->won, 0) : 0;
                $row->avg_days = (int) round((float) ($row->avg_days ?? 0));
                return $row;
            });
    }

    private function getMarginBySource(): \Illuminate\Support\Collection
    {
        $sourceExpr = "COALESCE(NULLIF(lead_source, ''), NULLIF(utm_source, ''), 'website')";
        return Quote::selectRaw("$sourceExpr as source, count(*) as leads,
            sum(case when stage = 'won' then 1 else 0 end) as won,
            coalesce(sum(expected_margin), 0) as total_margin,
            coalesce(sum(estimated_value), 0) as total_value")
            ->whereNotNull('expected_margin')
            ->groupByRaw('1')
            ->orderByDesc('total_margin')
            ->limit(10)
            ->get()
            ->map(function ($row) {
                $row->margin_pct = $row->total_value > 0 ? round(((float) $row->total_margin / (float) $row->total_value) * 100, 1) : 0;
                $row->avg_margin = $row->leads > 0 ? round((float) $row->total_margin / $row->leads, 0) : 0;
                return $row;
            });
    }

    private function getMarginByBorough(): \Illuminate\Support\Collection
    {
        return Quote::whereNotNull('calculator_borough')
            ->where('calculator_borough', '!=', '')
            ->selectRaw("calculator_borough as borough, count(*) as leads,
                coalesce(sum(expected_margin), 0) as total_margin,
                coalesce(sum(estimated_value), 0) as total_value")
            ->groupBy('calculator_borough')
            ->orderByDesc('total_margin')
            ->get()
            ->map(function ($row) {
                $row->margin_pct = $row->total_value > 0 ? round(((float) $row->total_margin / (float) $row->total_value) * 100, 1) : 0;
                $row->avg_margin = $row->leads > 0 ? round((float) $row->total_margin / $row->leads, 0) : 0;
                return $row;
            });
    }
}

