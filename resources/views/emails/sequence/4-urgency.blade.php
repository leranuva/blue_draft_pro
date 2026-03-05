<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Limited Availability</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #003366 0%, #336699 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; border-top: none; }
        .urgency { background: #fef3c7; border: 2px solid #d97706; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center; }
        .button { display: inline-block; padding: 14px 28px; background: #dc2626; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">Limited Availability This Month</h1>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Blue Draft Construction</p>
    </div>
    <div class="content">
        <p>Hi {{ $quote->client_name }},</p>
        <p>We wanted to follow up — we've had a lot of interest in {{ ucfirst($quote->service_type) }} projects this season.</p>
        <div class="urgency">
            <strong>We have limited slots available for new projects this month.</strong><br>
            Book your free consultation now to secure your spot and get your project started.
        </div>
        <p>Don't put your renovation on hold. Get your free estimate and lock in your timeline before our schedule fills up.</p>
        <a href="tel:+13476366128" class="button">Call Now — Free Estimate</a>
        <p>Or reply to this email and we'll call you within 24 hours.</p>
        <p>— The Blue Draft Team</p>
    </div>
    <div class="footer">Blue Draft Construction — Quality you can trust, availability you need</div>
</body>
</html>
