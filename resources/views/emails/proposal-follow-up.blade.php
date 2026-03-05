<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal follow-up</title>
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
        <h1>📋 Proposal follow-up (5+ days)</h1>
        <p>Blue Draft — Automatic reminder</p>
    </div>
    <div class="content">
        <p>This lead has had a proposal sent <strong>over 5 days ago</strong> with no follow-up.</p>
        <div class="info-box">
            <p><span class="label">Client:</span> {{ $quote->client_name }}</p>
            <p><span class="label">Email:</span> <a href="mailto:{{ $quote->email }}">{{ $quote->email }}</a></p>
            @if($quote->phone)<p><span class="label">Phone:</span> <a href="tel:{{ $quote->phone }}">{{ $quote->phone }}</a></p>@endif
            <p><span class="label">Last contact:</span> {{ ($quote->last_contacted_at ?? $quote->updated_at)->format('m/d/Y') }}</p>
        </div>
        <a href="{{ config('app.url') }}/system-bd-access/quotes/{{ $quote->id }}/edit" class="button">View in panel →</a>
    </div>
    <div class="footer">Blue Draft — Lead tracking system</div>
</body>
</html>
