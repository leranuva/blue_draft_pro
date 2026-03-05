<x-filament-panels::page>
    @php
        $data = method_exists($this, 'getViewData') ? $this->getViewData() : [];
        $dashboardError = $data['_dashboard_error'] ?? null;
        $pipeline = $data['pipeline'] ?? [];
        $funnel = $data['funnel'] ?? [];
        $alerts = $data['alerts'] ?? [];
        $topLeads = $data['topLeads'] ?? collect();
        $monthlyLeads = $data['monthlyLeads'] ?? ['current' => 0, 'previous' => 0, 'variation' => 0, 'variation_pct' => 0];
        $revenue = $data['revenue'] ?? ['won' => 0, 'pipeline' => 0, 'avgTicket' => 0];
        $revenueBySource = $data['revenueBySource'] ?? collect();
        $velocity = $data['velocity'] ?? ['to_first_contact' => 0, 'to_proposal' => 0, 'to_close' => 0];
        $scoreVsClose = $data['scoreVsClose'] ?? ['hot' => 0, 'warm' => 0, 'cold' => 0];
        $forecast = $data['forecast'] ?? ['close_rate' => 0, 'pipeline' => 0, 'expected' => 0];
        $boroughDeep = $data['boroughDeep'] ?? collect();
        $marginBySource = $data['marginBySource'] ?? collect();
        $marginByBorough = $data['marginByBorough'] ?? collect();
        $calculatorMetrics = $data['calculatorMetrics'] ?? [];
    @endphp
    <div style="padding: 1.5rem; max-width: 100%;">
        @if($dashboardError)
        <div style="background: #fef2f2; border: 2px solid #dc2626; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1.5rem;">
            <strong style="color: #991b1b;">⚠️ Dashboard error:</strong>
            <p style="margin: 0.5rem 0 0 0; font-size: 0.875rem; color: #b91c1c;">{{ $dashboardError }}</p>
            <p style="margin: 0.5rem 0 0 0; font-size: 0.8rem; color: #6b7280;">Run <code>php artisan migrate --force</code> on the server and check <code>storage/logs/laravel.log</code></p>
        </div>
        @endif
        <!-- Executive KPIs: Monthly Leads + Revenue -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
            <div style="background: linear-gradient(135deg, #003366 0%, #336699 100%); border-radius: 0.5rem; padding: 1.25rem; color: white; box-shadow: 0 2px 8px rgba(0,51,102,0.2);">
                <div style="font-size: 0.8rem; opacity: 0.9; margin-bottom: 0.25rem;">Leads this month</div>
                <div style="font-size: 2rem; font-weight: bold;">{{ $monthlyLeads['current'] }}</div>
                <div style="font-size: 0.85rem; margin-top: 0.5rem;">
                    @if($monthlyLeads['variation'] >= 0)
                        <span style="color: #86efac;">↑ {{ $monthlyLeads['variation_pct'] }}%</span> vs previous month ({{ $monthlyLeads['previous'] }})
                    @else
                        <span style="color: #fca5a5;">↓ {{ abs($monthlyLeads['variation_pct']) }}%</span> vs previous month ({{ $monthlyLeads['previous'] }})
                    @endif
                </div>
            </div>
            <div style="background: linear-gradient(135deg, #047857 0%, #059669 100%); border-radius: 0.5rem; padding: 1.25rem; color: white; box-shadow: 0 2px 8px rgba(4,120,87,0.2);">
                <div style="font-size: 0.8rem; opacity: 0.9; margin-bottom: 0.25rem;">Revenue earned</div>
                <div style="font-size: 1.5rem; font-weight: bold;">${{ number_format($revenue['won'], 0) }}</div>
                <div style="font-size: 0.85rem; margin-top: 0.5rem;">Closed with value</div>
            </div>
            <div style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); border-radius: 0.5rem; padding: 1.25rem; color: white; box-shadow: 0 2px 8px rgba(30,64,175,0.2);">
                <div style="font-size: 0.8rem; opacity: 0.9; margin-bottom: 0.25rem;">Pipeline potential</div>
                <div style="font-size: 1.5rem; font-weight: bold;">${{ number_format($revenue['pipeline'], 0) }}</div>
                <div style="font-size: 0.85rem; margin-top: 0.5rem;">Qualified + Proposal Sent</div>
            </div>
            <div style="background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%); border-radius: 0.5rem; padding: 1.25rem; color: white; box-shadow: 0 2px 8px rgba(124,58,237,0.2);">
                <div style="font-size: 0.8rem; opacity: 0.9; margin-bottom: 0.25rem;">Average ticket</div>
                <div style="font-size: 1.5rem; font-weight: bold;">${{ number_format($revenue['avgTicket'], 0) }}</div>
                <div style="font-size: 0.85rem; margin-top: 0.5rem;">Per closed project</div>
            </div>
        </div>

        <!-- Sales velocity -->
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; padding: 1.5rem; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 1rem 0;">⚡ Sales velocity (avg days)</h3>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                <div style="text-align: center; padding: 1rem; background: #eff6ff; border-radius: 0.5rem;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #1d4ed8;">{{ $velocity['to_first_contact'] }}</div>
                    <div style="font-size: 0.8rem; color: #1e40af;">To first contact</div>
                </div>
                <div style="text-align: center; padding: 1rem; background: #f0fdf4; border-radius: 0.5rem;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #15803d;">{{ $velocity['to_proposal'] }}</div>
                    <div style="font-size: 0.8rem; color: #166534;">To proposal</div>
                </div>
                <div style="text-align: center; padding: 1rem; background: #fefce8; border-radius: 0.5rem;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #a16207;">{{ $velocity['to_close'] }}</div>
                    <div style="font-size: 0.8rem; color: #854d0e;">To close</div>
                </div>
            </div>
        </div>

        <!-- Score vs Close Rate -->
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; padding: 1.5rem; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 1rem 0;">📊 Score vs Close Rate</h3>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                <div style="text-align: center; padding: 1rem; background: #fef2f2; border-radius: 0.5rem;">
                    <div style="font-size: 1.25rem; font-weight: bold; color: #dc2626;">{{ $scoreVsClose['hot'] }}%</div>
                    <div style="font-size: 0.8rem; color: #991b1b;">Hot (9-12) — {{ $scoreVsClose['hot_total'] ?? 0 }} leads</div>
                </div>
                <div style="text-align: center; padding: 1rem; background: #fffbeb; border-radius: 0.5rem;">
                    <div style="font-size: 1.25rem; font-weight: bold; color: #d97706;">{{ $scoreVsClose['warm'] }}%</div>
                    <div style="font-size: 0.8rem; color: #92400e;">Warm (5-8) — {{ $scoreVsClose['warm_total'] ?? 0 }} leads</div>
                </div>
                <div style="text-align: center; padding: 1rem; background: #f3f4f6; border-radius: 0.5rem;">
                    <div style="font-size: 1.25rem; font-weight: bold; color: #6b7280;">{{ $scoreVsClose['cold'] }}%</div>
                    <div style="font-size: 0.8rem; color: #4b5563;">Cold (0-4) — {{ $scoreVsClose['cold_total'] ?? 0 }} leads</div>
                </div>
            </div>
        </div>

        <!-- Predictive forecast -->
        <div style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); border-radius: 0.5rem; padding: 1.5rem; color: white; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.125rem; font-weight: 600; margin: 0 0 1rem 0;">📈 Predictive forecast</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 2rem; align-items: center;">
                <div>
                    <span style="font-size: 0.85rem; opacity: 0.9;">Historical close rate:</span>
                    <span style="font-weight: bold; font-size: 1.25rem;">{{ $forecast['close_rate'] }}%</span>
                </div>
                <div>
                    <span style="font-size: 0.85rem; opacity: 0.9;">Current pipeline:</span>
                    <span style="font-weight: bold; font-size: 1.25rem;">${{ number_format($forecast['pipeline'], 0) }}</span>
                </div>
                <div>
                    <span style="font-size: 0.85rem; opacity: 0.9;">Expected revenue:</span>
                    <span style="font-weight: bold; font-size: 1.5rem;">${{ number_format($forecast['expected'], 0) }}</span>
                </div>
            </div>
        </div>

        <!-- Revenue by source (real ROI) -->
        @if($revenueBySource->isNotEmpty())
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; padding: 1.5rem; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 1rem 0;">💰 Revenue by source (real ROI)</h3>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 0.875rem;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e5e7eb;">
                            <th style="text-align: left; padding: 0.5rem;">Source</th>
                            <th style="text-align: right; padding: 0.5rem;">Leads</th>
                            <th style="text-align: right; padding: 0.5rem;">Won</th>
                            <th style="text-align: right; padding: 0.5rem;">Close %</th>
                            <th style="text-align: right; padding: 0.5rem;">Revenue</th>
                            <th style="text-align: right; padding: 0.5rem;">Avg ticket</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($revenueBySource as $row)
                        <tr style="border-bottom: 1px solid #f3f4f6;">
                            <td style="padding: 0.5rem;">{{ $row->source ?? '—' }}</td>
                            <td style="text-align: right; padding: 0.5rem;">{{ $row->leads }}</td>
                            <td style="text-align: right; padding: 0.5rem;">{{ $row->won }}</td>
                            <td style="text-align: right; padding: 0.5rem;">{{ $row->close_rate_pct }}%</td>
                            <td style="text-align: right; padding: 0.5rem;">${{ number_format($row->revenue, 0) }}</td>
                            <td style="text-align: right; padding: 0.5rem;">${{ number_format($row->avg_ticket, 0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Borough deep analysis -->
        @if($boroughDeep->isNotEmpty())
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; padding: 1.5rem; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 1rem 0;">🗽 Analysis by borough (NYC)</h3>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 0.875rem;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e5e7eb;">
                            <th style="text-align: left; padding: 0.5rem;">Borough</th>
                            <th style="text-align: right; padding: 0.5rem;">Leads</th>
                            <th style="text-align: right; padding: 0.5rem;">Won</th>
                            <th style="text-align: right; padding: 0.5rem;">Close %</th>
                            <th style="text-align: right; padding: 0.5rem;">Revenue</th>
                            <th style="text-align: right; padding: 0.5rem;">Avg ticket</th>
                            <th style="text-align: right; padding: 0.5rem;">Days to close</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($boroughDeep as $row)
                        <tr style="border-bottom: 1px solid #f3f4f6;">
                            <td style="padding: 0.5rem;">{{ \App\Models\Quote::getBoroughs()[$row->borough] ?? $row->borough }}</td>
                            <td style="text-align: right; padding: 0.5rem;">{{ $row->leads }}</td>
                            <td style="text-align: right; padding: 0.5rem;">{{ $row->won }}</td>
                            <td style="text-align: right; padding: 0.5rem;">{{ $row->close_rate_pct }}%</td>
                            <td style="text-align: right; padding: 0.5rem;">${{ number_format($row->revenue, 0) }}</td>
                            <td style="text-align: right; padding: 0.5rem;">${{ number_format($row->avg_ticket, 0) }}</td>
                            <td style="text-align: right; padding: 0.5rem;">{{ $row->avg_days }}d</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Expected margin by source and borough (calculator leads) -->
        @if($marginBySource->isNotEmpty() || $marginByBorough->isNotEmpty())
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; padding: 1.5rem; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 1rem 0;">📉 Expected margin (Margin matters more than revenue.)</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                @if($marginBySource->isNotEmpty())
                <div>
                    <h4 style="font-size: 0.9rem; font-weight: 600; color: #4b5563; margin-bottom: 0.5rem;">By source</h4>
                    <table style="width: 100%; font-size: 0.8rem;">
                        <tr style="border-bottom: 1px solid #e5e7eb;"><th style="text-align: left; padding: 0.25rem;">Source</th><th style="text-align: right;">Margin</th><th style="text-align: right;">%</th></tr>
                        @foreach($marginBySource as $r)
                        <tr style="border-bottom: 1px solid #f3f4f6;"><td>{{ $r->source }}</td><td style="text-align: right;">${{ number_format($r->total_margin, 0) }}</td><td style="text-align: right;">{{ $r->margin_pct }}%</td></tr>
                        @endforeach
                    </table>
                </div>
                @endif
                @if($marginByBorough->isNotEmpty())
                <div>
                    <h4 style="font-size: 0.9rem; font-weight: 600; color: #4b5563; margin-bottom: 0.5rem;">By borough (calculator)</h4>
                    <table style="width: 100%; font-size: 0.8rem;">
                        <tr style="border-bottom: 1px solid #e5e7eb;"><th style="text-align: left; padding: 0.25rem;">Borough</th><th style="text-align: right;">Margin</th><th style="text-align: right;">%</th></tr>
                        @foreach($marginByBorough as $r)
                        <tr style="border-bottom: 1px solid #f3f4f6;"><td>{{ $r->borough === 'nj' ? 'New Jersey' : (\App\Models\Quote::getBoroughs()[$r->borough] ?? $r->borough) }}</td><td style="text-align: right;">${{ number_format($r->total_margin, 0) }}</td><td style="text-align: right;">{{ $r->margin_pct }}%</td></tr>
                        @endforeach
                    </table>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Calculator derived metrics (landing for ads) -->
        @if(!empty($calculatorMetrics) && ($calculatorMetrics['total_calculator_leads'] ?? 0) > 0)
        <div style="background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%); border-radius: 0.5rem; padding: 1.5rem; color: white; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.125rem; font-weight: 600; margin: 0 0 1rem 0;">📊 Calculator — Metrics for Ads</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1rem;">
                <div><span style="font-size: 0.75rem; opacity: 0.9;">Calculator → Quote</span><div style="font-weight: bold; font-size: 1.25rem;">{{ $calculatorMetrics['calculator_to_quote_rate'] ?? 0 }}%</div></div>
                <div><span style="font-size: 0.75rem; opacity: 0.9;">Quote → Closed</span><div style="font-weight: bold; font-size: 1.25rem;">{{ $calculatorMetrics['calculator_to_closed_rate'] ?? 0 }}%</div></div>
                <div><span style="font-size: 0.75rem; opacity: 0.9;">Avg. Margin</span><div style="font-weight: bold; font-size: 1.25rem;">${{ number_format($calculatorMetrics['average_margin_calculator'] ?? 0, 0) }}</div></div>
                <div><span style="font-size: 0.75rem; opacity: 0.9;">Revenue from calculator</span><div style="font-weight: bold; font-size: 1.25rem;">${{ number_format($calculatorMetrics['revenue_from_calculator'] ?? 0, 0) }}</div></div>
                <div><span style="font-size: 0.75rem; opacity: 0.9;">Calculator leads</span><div style="font-weight: bold; font-size: 1.25rem;">{{ $calculatorMetrics['total_calculator_leads'] ?? 0 }}</div></div>
            </div>
            <p style="font-size: 0.75rem; opacity: 0.85; margin-top: 0.75rem; margin-bottom: 0;">Use the calculator as landing for cold traffic (Meta/Google Ads). ROI_ads_to_calculator requires external ad spend data.</p>
        </div>
        @endif

        <!-- Alerts -->
        @if(($alerts['new_24h'] ?? 0) > 0 || ($alerts['proposal_followup'] ?? 0) > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
            @if(($alerts['new_24h'] ?? 0) > 0)
            <a href="{{ route('filament.admin.resources.quotes.index') }}" style="text-decoration: none;">
                <div style="background: #fef2f2; border: 2px solid #dc2626; border-radius: 0.5rem; padding: 1rem; display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 3rem; height: 3rem; background: #dc2626; color: white; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: bold;">{{ $alerts['new_24h'] }}</div>
                    <div>
                        <strong style="color: #991b1b;">Leads not contacted (24h+)</strong>
                        <p style="margin: 0; font-size: 0.875rem; color: #b91c1c;">Require attention</p>
                    </div>
                </div>
            </a>
            @endif
            @if(($alerts['proposal_followup'] ?? 0) > 0)
            <a href="{{ route('filament.admin.resources.quotes.index') }}" style="text-decoration: none;">
                <div style="background: #fffbeb; border: 2px solid #d97706; border-radius: 0.5rem; padding: 1rem; display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 3rem; height: 3rem; background: #d97706; color: white; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: bold;">{{ $alerts['proposal_followup'] }}</div>
                    <div>
                        <strong style="color: #92400e;">Proposals pending follow-up (5d+)</strong>
                        <p style="margin: 0; font-size: 0.875rem; color: #b45309;">Follow-up needed</p>
                    </div>
                </div>
            </a>
            @endif
        </div>
        @endif

        <!-- Conversion Funnel -->
        @if(!empty($funnel))
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; padding: 1.5rem; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 1rem 0;">Conversion Funnel</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 0.75rem;">
                <div style="text-align: center; padding: 0.75rem; background: #f3f4f6; border-radius: 0.5rem;">
                    <div style="font-size: 1.25rem; font-weight: bold; color: #374151;">{{ $funnel['partial'] ?? 0 }}</div>
                    <div style="font-size: 0.7rem; color: #6b7280;">Partial (Step 1)</div>
                </div>
                <div style="text-align: center; padding: 0.75rem; background: #dbeafe; border-radius: 0.5rem;">
                    <div style="font-size: 1.25rem; font-weight: bold; color: #1e40af;">{{ $funnel['complete'] ?? 0 }}</div>
                    <div style="font-size: 0.7rem; color: #1e3a8a;">Complete</div>
                    <div style="font-size: 0.65rem; color: #3b82f6; margin-top: 0.25rem;">{{ $funnel['partial_to_complete_pct'] ?? 0 }}% rate</div>
                </div>
                <div style="text-align: center; padding: 0.75rem; background: #e0e7ff; border-radius: 0.5rem;">
                    <div style="font-size: 1.25rem; font-weight: bold; color: #3730a3;">{{ $funnel['proposal_sent'] ?? 0 }}</div>
                    <div style="font-size: 0.7rem; color: #4338ca;">Proposal Sent</div>
                    <div style="font-size: 0.65rem; color: #6366f1; margin-top: 0.25rem;">{{ $funnel['complete_to_proposal_pct'] ?? 0 }}% rate</div>
                </div>
                <div style="text-align: center; padding: 0.75rem; background: #d1fae5; border-radius: 0.5rem;">
                    <div style="font-size: 1.25rem; font-weight: bold; color: #047857;">{{ $funnel['won'] ?? 0 }}</div>
                    <div style="font-size: 0.7rem; color: #065f46;">Won</div>
                    <div style="font-size: 0.65rem; color: #10b981; margin-top: 0.25rem;">{{ $funnel['proposal_to_won_pct'] ?? 0 }}% rate</div>
                </div>
                <div style="text-align: center; padding: 0.75rem; background: #fef3c7; border-radius: 0.5rem;">
                    <div style="font-size: 1.25rem; font-weight: bold; color: #b45309;">{{ $funnel['avg_close_days'] ?? 0 }}</div>
                    <div style="font-size: 0.7rem; color: #92400e;">Avg days to close</div>
                </div>
            </div>
            @if(!empty($funnel['won_by_borough']) && $funnel['won_by_borough']->isNotEmpty())
            <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                <div style="font-size: 0.8rem; font-weight: 600; color: #4b5563; margin-bottom: 0.5rem;">Won by borough</div>
                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    @foreach($funnel['won_by_borough'] as $row)
                    <span style="background: #e0f2fe; color: #0369a1; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem;">{{ \App\Models\Quote::getBoroughs()[$row->borough] ?? $row->borough }}: {{ $row->total }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif

        <!-- Pipeline Stats -->
        @if(!empty($pipeline))
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; padding: 1.5rem; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 1rem 0;">Lead Pipeline</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap: 0.75rem;">
                <div style="text-align: center; padding: 0.75rem; background: #fef3c7; border-radius: 0.5rem;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #92400e;">{{ $pipeline['new'] ?? 0 }}</div>
                    <div style="font-size: 0.75rem; color: #78350f;">New</div>
                </div>
                <div style="text-align: center; padding: 0.75rem; background: #dbeafe; border-radius: 0.5rem;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #1e40af;">{{ $pipeline['contacted'] ?? 0 }}</div>
                    <div style="font-size: 0.75rem; color: #1e3a8a;">Contacted</div>
                </div>
                <div style="text-align: center; padding: 0.75rem; background: #dbeafe; border-radius: 0.5rem;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #1e40af;">{{ $pipeline['qualified'] ?? 0 }}</div>
                    <div style="font-size: 0.75rem; color: #1e3a8a;">Qualified</div>
                </div>
                <div style="text-align: center; padding: 0.75rem; background: #e0e7ff; border-radius: 0.5rem;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #3730a3;">{{ $pipeline['proposal_sent'] ?? 0 }}</div>
                    <div style="font-size: 0.75rem; color: #4338ca;">Proposal</div>
                </div>
                <div style="text-align: center; padding: 0.75rem; background: #d1fae5; border-radius: 0.5rem;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #047857;">{{ $pipeline['won'] ?? 0 }}</div>
                    <div style="font-size: 0.75rem; color: #065f46;">Won</div>
                </div>
                <div style="text-align: center; padding: 0.75rem; background: #f3f4f6; border-radius: 0.5rem;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #6b7280;">{{ $pipeline['lost'] ?? 0 }}</div>
                    <div style="font-size: 0.75rem; color: #4b5563;">Lost</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Top Leads by Score -->
        @if($topLeads->isNotEmpty())
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; padding: 1.5rem; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 1rem 0;">Priority leads (by score)</h3>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                @foreach($topLeads as $lead)
                <a href="{{ route('filament.admin.resources.quotes.edit', ['record' => $lead]) }}" style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; background: #f9fafb; border-radius: 0.5rem; text-decoration: none; color: inherit; border: 1px solid #e5e7eb;">
                    <div>
                        <span style="font-weight: 600;">{{ $lead->client_name }}</span>
                        <span style="font-size: 0.875rem; color: #6b7280; margin-left: 0.5rem;">{{ ucfirst($lead->service_type) }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="background: {{ $lead->lead_score >= 8 ? '#059669' : ($lead->lead_score >= 6 ? '#2563eb' : ($lead->lead_score >= 4 ? '#d97706' : '#6b7280')) }}; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">{{ $lead->lead_score }}/12 {{ \App\Models\Quote::getScoreLabel($lead->lead_score) }}</span>
                        <span style="font-size: 0.75rem; color: #9ca3af;">{{ \App\Models\Quote::getStages()[$lead->stage] ?? $lead->stage }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Analytics: By Source, Borough, Service -->
        @php
            $bySource = $data['bySource'] ?? collect();
            $byBorough = $data['byBorough'] ?? collect();
            $byService = $data['byService'] ?? collect();
        @endphp
        @if($bySource->isNotEmpty() || $byBorough->isNotEmpty() || $byService->isNotEmpty())
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
            @if($bySource->isNotEmpty())
            <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; padding: 1.25rem;">
                <h3 style="font-size: 1rem; font-weight: 600; color: #111827; margin: 0 0 0.75rem 0;">By source</h3>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @foreach($bySource as $row)
                    <div style="display: flex; justify-content: space-between; font-size: 0.875rem;">
                        <span style="color: #4b5563;">{{ $row->source ?? '—' }}</span>
                        <span style="font-weight: 600;">{{ $row->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @if($byBorough->isNotEmpty())
            <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; padding: 1.25rem;">
                <h3 style="font-size: 1rem; font-weight: 600; color: #111827; margin: 0 0 0.75rem 0;">By borough</h3>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @foreach($byBorough as $row)
                    <div style="display: flex; justify-content: space-between; font-size: 0.875rem;">
                        <span style="color: #4b5563;">{{ \App\Models\Quote::getBoroughs()[$row->borough] ?? $row->borough }}</span>
                        <span style="font-weight: 600;">{{ $row->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @if($byService->isNotEmpty())
            <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; padding: 1.25rem;">
                <h3 style="font-size: 1rem; font-weight: 600; color: #111827; margin: 0 0 0.75rem 0;">By service</h3>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @foreach($byService as $row)
                    <div style="display: flex; justify-content: space-between; font-size: 0.875rem;">
                        <span style="color: #4b5563;">{{ ucfirst($row->service_type) }}</span>
                        <span style="font-weight: 600;">{{ $row->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif

        <!-- Welcome Section -->
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1.5rem; margin-bottom: 1.5rem;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                <div style="flex-shrink: 0;">
                    <div style="width: 4rem; height: 4rem; background: #003366; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 style="font-size: 1.5rem; font-weight: bold; color: #111827; margin: 0;">
                        Welcome to Blue Draft Administration Panel
                    </h2>
                    <p style="color: #4b5563; margin-top: 0.5rem; margin: 0;">
                        Manage all your website content from one place
                    </p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
            <!-- Hero Settings -->
            <a href="{{ route('filament.admin.pages.hero-settings') }}" style="text-decoration: none; color: inherit;">
                <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1.5rem; transition: box-shadow 0.2s; cursor: pointer;" onmouseover="this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="flex-shrink: 0;">
                            <div style="width: 3rem; height: 3rem; background: #dbeafe; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 1.5rem; height: 1.5rem; color: #2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div style="flex: 1;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0;">
                                Hero Settings
                            </h3>
                            <p style="font-size: 0.875rem; color: #4b5563; margin-top: 0.25rem; margin: 0;">
                                Configure the main section of your site
                            </p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Projects -->
            <a href="{{ route('filament.admin.resources.projects.index') }}" style="text-decoration: none; color: inherit;">
                <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1.5rem; transition: box-shadow 0.2s; cursor: pointer;" onmouseover="this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="flex-shrink: 0;">
                            <div style="width: 3rem; height: 3rem; background: #d1fae5; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 1.5rem; height: 1.5rem; color: #059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        </div>
                        <div style="flex: 1;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0;">
                                Projects
                            </h3>
                            <p style="font-size: 0.875rem; color: #4b5563; margin-top: 0.25rem; margin: 0;">
                                Manage your project gallery
                            </p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Quotes -->
            <a href="{{ route('filament.admin.resources.quotes.index') }}" style="text-decoration: none; color: inherit;">
                <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1.5rem; transition: box-shadow 0.2s; cursor: pointer;" onmouseover="this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="flex-shrink: 0;">
                            <div style="width: 3rem; height: 3rem; background: #f3e8ff; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 1.5rem; height: 1.5rem; color: #9333ea;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div style="flex: 1;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0;">
                                Quotes
                            </h3>
                            <p style="font-size: 0.875rem; color: #4b5563; margin-top: 0.25rem; margin: 0;">
                                Review quote requests
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Information Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
            <!-- What is this Dashboard -->
            <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1.5rem;">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 0.75rem; margin-top: 0; display: flex; align-items: center;">
                    <svg style="width: 1.25rem; height: 1.25rem; color: #003366; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    What is this Dashboard?
                </h3>
                <p style="color: #4b5563; font-size: 0.875rem; line-height: 1.5; margin: 0;">
                    This is the administration panel for <strong>Blue Draft Corporation</strong>. From here you can manage all your website content without technical knowledge. You can update texts, images, projects, and review quote requests from your clients.
                </p>
            </div>

            <!-- Quick Guide -->
            <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1.5rem;">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 0.75rem; margin-top: 0; display: flex; align-items: center;">
                    <svg style="width: 1.25rem; height: 1.25rem; color: #003366; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Quick Guide
                </h3>
                <ul style="color: #4b5563; font-size: 0.875rem; list-style: none; padding: 0; margin: 0;">
                    <li style="display: flex; align-items: start; margin-bottom: 0.5rem;">
                        <span style="color: #003366; margin-right: 0.5rem;">•</span>
                        <span><strong>Site Settings:</strong> Configure the content of each site section</span>
                    </li>
                    <li style="display: flex; align-items: start; margin-bottom: 0.5rem;">
                        <span style="color: #003366; margin-right: 0.5rem;">•</span>
                        <span><strong>Projects:</strong> Add and manage your projects with before/after images</span>
                    </li>
                    <li style="display: flex; align-items: start;">
                        <span style="color: #003366; margin-right: 0.5rem;">•</span>
                        <span><strong>Quotes:</strong> Review your clients' requests</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Features Section -->
        <div style="background: linear-gradient(to right, #f0f9ff, #e0f2fe); border-radius: 0.5rem; border: 1px solid #bae6fd; padding: 1.5rem;">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem; margin-top: 0;">
                Panel Features
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <div style="display: flex; align-items: start; gap: 0.75rem;">
                    <div style="flex-shrink: 0;">
                        <div style="width: 2rem; height: 2rem; background: #003366; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 1.25rem; height: 1.25rem; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 style="font-weight: 500; color: #111827; margin: 0; margin-bottom: 0.25rem;">Easy Editing</h4>
                        <p style="font-size: 0.875rem; color: #4b5563; margin: 0;">
                            Update content without code
                        </p>
                    </div>
                </div>
                <div style="display: flex; align-items: start; gap: 0.75rem;">
                    <div style="flex-shrink: 0;">
                        <div style="width: 2rem; height: 2rem; background: #003366; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 1.25rem; height: 1.25rem; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 style="font-weight: 500; color: #111827; margin: 0; margin-bottom: 0.25rem;">Image Management</h4>
                        <p style="font-size: 0.875rem; color: #4b5563; margin: 0;">
                            Upload and organize images easily
                        </p>
                    </div>
                </div>
                <div style="display: flex; align-items: start; gap: 0.75rem;">
                    <div style="flex-shrink: 0;">
                        <div style="width: 2rem; height: 2rem; background: #003366; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 1.25rem; height: 1.25rem; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 style="font-weight: 500; color: #111827; margin: 0; margin-bottom: 0.25rem;">Secure & Private</h4>
                        <p style="font-size: 0.875rem; color: #4b5563; margin: 0;">
                            Restricted and protected access
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>

