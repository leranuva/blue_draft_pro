<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Follow-up propuesta</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #d97706; color: white; padding: 24px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #fffbeb; padding: 24px; border: 1px solid #fcd34d; border-top: none; }
        .info-box { background: white; padding: 16px; margin: 12px 0; border-left: 4px solid #d97706; border-radius: 4px; }
        .label { font-weight: bold; color: #92400e; }
        .button { display: inline-block; padding: 12px 24px; background: #003366; color: white; text-decoration: none; border-radius: 4px; margin-top: 16px; }
        .footer { text-align: center; padding: 16px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>📋 Follow-up propuesta (5+ días)</h1>
        <p>Blue Draft — Recordatorio automático</p>
    </div>
    <div class="content">
        <p>Este lead tiene propuesta enviada hace <strong>más de 5 días</strong> sin seguimiento.</p>
        <div class="info-box">
            <p><span class="label">Cliente:</span> {{ $quote->client_name }}</p>
            <p><span class="label">Email:</span> <a href="mailto:{{ $quote->email }}">{{ $quote->email }}</a></p>
            @if($quote->phone)<p><span class="label">Teléfono:</span> <a href="tel:{{ $quote->phone }}">{{ $quote->phone }}</a></p>@endif
            <p><span class="label">Último contacto:</span> {{ ($quote->last_contacted_at ?? $quote->updated_at)->format('d/m/Y') }}</p>
        </div>
        <a href="{{ config('app.url') }}/system-bd-access/quotes/{{ $quote->id }}/edit" class="button">Ver en panel →</a>
    </div>
    <div class="footer">Blue Draft — Sistema de seguimiento de leads</div>
</body>
</html>
