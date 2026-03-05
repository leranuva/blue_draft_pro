<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead sin contactar</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #dc2626; color: white; padding: 24px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #fef2f2; padding: 24px; border: 1px solid #fecaca; border-top: none; }
        .info-box { background: white; padding: 16px; margin: 12px 0; border-left: 4px solid #dc2626; border-radius: 4px; }
        .label { font-weight: bold; color: #991b1b; }
        .button { display: inline-block; padding: 12px 24px; background: #003366; color: white; text-decoration: none; border-radius: 4px; margin-top: 16px; }
        .footer { text-align: center; padding: 16px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>⚠️ Lead sin contactar (24+ horas)</h1>
        <p>Blue Draft — Recordatorio automático</p>
    </div>
    <div class="content">
        <p>Este lead lleva <strong>más de 24 horas</strong> sin ser contactado.</p>
        <div class="info-box">
            <p><span class="label">Cliente:</span> {{ $quote->client_name }}</p>
            <p><span class="label">Email:</span> <a href="mailto:{{ $quote->email }}">{{ $quote->email }}</a></p>
            @if($quote->phone)<p><span class="label">Teléfono:</span> <a href="tel:{{ $quote->phone }}">{{ $quote->phone }}</a></p>@endif
            <p><span class="label">Servicio:</span> {{ ucfirst($quote->service_type) }}</p>
            <p><span class="label">Score:</span> {{ $quote->lead_score }}/12 ({{ \App\Models\Quote::getScoreLabel($quote->lead_score) }})</p>
            <p><span class="label">Recibido:</span> {{ $quote->created_at->diffForHumans() }}</p>
        </div>
        <a href="{{ config('app.url') }}/system-bd-access/quotes/{{ $quote->id }}/edit" class="button">Ver en panel →</a>
    </div>
    <div class="footer">Blue Draft — Sistema de seguimiento de leads</div>
</body>
</html>
