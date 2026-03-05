<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Top Concerns — Answered</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #003366 0%, #336699 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; border-top: none; }
        .qa { background: white; border-left: 4px solid #003366; padding: 16px; margin: 16px 0; }
        .qa strong { color: #003366; }
        .button { display: inline-block; padding: 14px 28px; background: #003366; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">Permits, Delays, Hidden Costs — Answered</h1>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Blue Draft Construction</p>
    </div>
    <div class="content">
        <p>Hi {{ $quote->client_name }},</p>
        <p>We hear these questions a lot. Here are straight answers:</p>
        <div class="qa">
            <strong>Permits?</strong> We handle all NYC permits. You get a clear timeline — no surprises. Most residential projects: 2–4 weeks for approval.
        </div>
        <div class="qa">
            <strong>Delays?</strong> We build buffer into our schedules. If something unexpected comes up, we communicate immediately. No radio silence.
        </div>
        <div class="qa">
            <strong>Hidden costs?</strong> Our estimates include labor, materials, and permit fees. We call out anything that could change (e.g., asbestos, structural issues) before we start.
        </div>
        <div class="qa">
            <strong>Insurance?</strong> We're fully insured and bonded. Your property is protected. We can provide certificates on request.
        </div>
        <p>Ready to move forward? Get your free estimate — no obligation.</p>
        <a href="{{ config('app.url') }}#quote" class="button">Get Your Free Estimate</a>
        <p>— The Blue Draft Team</p>
    </div>
    <div class="footer">Blue Draft Construction — Quality you can trust</div>
</body>
</html>
