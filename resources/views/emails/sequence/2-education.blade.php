<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How NYC Construction Works</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #003366 0%, #336699 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; border-top: none; }
        .tip { background: #eff6ff; border-left: 4px solid #2563eb; padding: 16px; margin: 16px 0; }
        .button { display: inline-block; padding: 14px 28px; background: #003366; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">How NYC Construction Works</h1>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">What you need to know</p>
    </div>
    <div class="content">
        <p>Hi {{ $quote->client_name }},</p>
        <p>Construction in New York City is different from anywhere else. Here's what you should know:</p>
        <div class="tip">
            <strong>Permits & Codes:</strong> NYC has strict building codes. We handle all permits and ensure your project complies with DOB requirements.
        </div>
        <div class="tip">
            <strong>Co-ops & Condos:</strong> If you're in a co-op or condo, board approval may be required. We've navigated hundreds of these — we know the process.
        </div>
        <div class="tip">
            <strong>Timeline:</strong> Most projects take 4–12 weeks depending on scope. We'll give you a clear timeline during our consultation.
        </div>
        <p>Ready to discuss your {{ ucfirst($quote->service_type) }} project? We serve Manhattan, Brooklyn, Queens, and all five boroughs.</p>
        <a href="tel:+13476366128" class="button">Call for Free Consultation</a>
        <p>— The Blue Draft Team</p>
    </div>
    <div class="footer">Blue Draft Construction — Serving NYC since 2009</div>
</body>
</html>
