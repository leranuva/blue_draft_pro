<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte Ejecutivo {{ $period }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; margin: 40px; }
        h1 { color: #003366; font-size: 22px; margin-bottom: 8px; }
        h2 { color: #336699; font-size: 14px; margin-top: 24px; margin-bottom: 8px; border-bottom: 1px solid #ccc; }
        .period { color: #666; font-size: 12px; margin-bottom: 24px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f5f5f5; font-weight: 600; color: #003366; }
        .kpi-value { font-weight: bold; font-size: 18px; color: #047857; }
        .footer { margin-top: 40px; font-size: 9px; color: #999; }
    </style>
</head>
<body>
    <h1>Blue Draft — Reporte Ejecutivo</h1>
    <p class="period">{{ $period }}</p>

    <h2>Resumen Ejecutivo</h2>
    <table>
        <tr><th>KPI</th><th>Valor</th></tr>
        <tr><td>Leads totales</td><td class="kpi-value">{{ $data['leads_total'] }}</td></tr>
        <tr><td>Leads contactados &lt;24h (%)</td><td>{{ $data['contacted_24h_pct'] }}%</td></tr>
        <tr><td>Propuestas enviadas</td><td>{{ $data['proposals_sent'] }}</td></tr>
        <tr><td>Close rate (%)</td><td>{{ $data['close_rate_pct'] }}%</td></tr>
        <tr><td>Tiempo promedio cierre (días)</td><td>{{ $data['avg_close_days'] }}</td></tr>
        <tr><td>Revenue ganado</td><td class="kpi-value">${{ number_format($data['revenue_won'], 0) }}</td></tr>
        <tr><td>Pipeline potencial</td><td>${{ number_format($data['revenue_pipeline'], 0) }}</td></tr>
        <tr><td>Borough dominante</td><td>{{ $data['top_borough'] }}</td></tr>
        <tr><td>Servicio dominante</td><td>{{ $data['top_service'] }}</td></tr>
    </table>

    @if($data['by_borough']->isNotEmpty())
    <h2>Leads por Borough</h2>
    <table>
        <tr><th>Borough</th><th>Total</th></tr>
        @foreach($data['by_borough'] as $row)
        <tr><td>{{ $boroughs[$row->borough] ?? $row->borough }}</td><td>{{ $row->total }}</td></tr>
        @endforeach
    </table>
    @endif

    @if($data['by_service']->isNotEmpty())
    <h2>Leads por Servicio</h2>
    <table>
        <tr><th>Servicio</th><th>Total</th></tr>
        @foreach($data['by_service'] as $row)
        <tr><td>{{ ucfirst($row->service_type) }}</td><td>{{ $row->total }}</td></tr>
        @endforeach
    </table>
    @endif

    @if(isset($data['revenue_by_source']) && $data['revenue_by_source']->isNotEmpty())
    <h2>Revenue por Fuente (ROI)</h2>
    <table>
        <tr><th>Fuente</th><th>Leads</th><th>Won</th><th>Close %</th><th>Revenue</th><th>Ticket prom.</th></tr>
        @foreach($data['revenue_by_source'] as $row)
        <tr>
            <td>{{ $row->source ?? '—' }}</td>
            <td>{{ $row->leads }}</td>
            <td>{{ $row->won }}</td>
            <td>{{ $row->close_rate_pct }}%</td>
            <td>${{ number_format($row->revenue, 0) }}</td>
            <td>${{ number_format($row->avg_ticket, 0) }}</td>
        </tr>
        @endforeach
    </table>
    @endif

    @if(isset($data['borough_deep']) && $data['borough_deep']->isNotEmpty())
    <h2>Análisis por Borough</h2>
    <table>
        <tr><th>Borough</th><th>Leads</th><th>Won</th><th>Close %</th><th>Revenue</th><th>Ticket</th><th>Días cierre</th></tr>
        @foreach($data['borough_deep'] as $row)
        <tr>
            <td>{{ $boroughs[$row->borough] ?? $row->borough }}</td>
            <td>{{ $row->leads }}</td>
            <td>{{ $row->won }}</td>
            <td>{{ $row->close_rate_pct }}%</td>
            <td>${{ number_format($row->revenue, 0) }}</td>
            <td>${{ number_format($row->avg_ticket, 0) }}</td>
            <td>{{ $row->avg_days }}d</td>
        </tr>
        @endforeach
    </table>
    @endif

    <p class="footer">Generado automáticamente por Blue Draft CRM — {{ now()->format('Y-m-d H:i') }}</p>
</body>
</html>
