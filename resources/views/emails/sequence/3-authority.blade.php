<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Our Work</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #003366 0%, #336699 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; border-top: none; }
        .testimonial { background: white; border-radius: 8px; padding: 20px; margin: 16px 0; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .button { display: inline-block; padding: 14px 28px; background: #003366; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">See Our Before/After Projects</h1>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Real results in NYC</p>
    </div>
    <div class="content">
        <p>Hi {{ $quote->client_name }},</p>
        <p>Don't just take our word for it — see what we've built for homeowners and businesses across New York City.</p>
        <p><strong>What our clients say:</strong></p>
        <div class="testimonial">
            "Blue Draft transformed our kitchen. On time, on budget, and the quality exceeded our expectations." — Brooklyn homeowner
        </div>
        <div class="testimonial">
            "We've used them for 3 projects. Professional, reliable, and they know NYC construction inside out." — Manhattan property manager
        </div>
        <p>View our full portfolio of before/after projects on our website — from kitchen remodels to commercial build-outs.</p>
        <a href="{{ config('app.url') }}/#projects" class="button">View Our Projects</a>
        <p>Ready to start yours? Reply to this email or call us.</p>
        <p>— The Blue Draft Team</p>
    </div>
    <div class="footer">Blue Draft Construction — 200+ projects completed in NYC</div>
</body>
</html>
