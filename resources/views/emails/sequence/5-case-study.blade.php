<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Study — Brooklyn Kitchen</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #003366 0%, #336699 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; border-top: none; }
        .case-box { background: white; border: 2px solid #003366; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .case-box h3 { margin: 0 0 12px 0; color: #003366; font-size: 1.1rem; }
        .case-box ul { margin: 0; padding-left: 20px; }
        .case-box li { margin-bottom: 8px; }
        .result { background: #d1fae5; border-left: 4px solid #047857; padding: 16px; margin: 20px 0; }
        .button { display: inline-block; padding: 14px 28px; background: #003366; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">Real Project: Brooklyn Kitchen Renovation</h1>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Blue Draft Construction</p>
    </div>
    <div class="content">
        <p>Hi {{ $quote->client_name }},</p>
        <p>We thought you'd like to see a real example of how we work — with actual numbers.</p>
        <div class="case-box">
            <h3>Project: Full Kitchen Remodel, Park Slope</h3>
            <ul>
                <li><strong>Problem:</strong> Outdated 1980s kitchen, poor layout, no island</li>
                <li><strong>Budget:</strong> $45,000–$55,000</li>
                <li><strong>Timeline:</strong> 6 weeks from permit approval</li>
                <li><strong>Scope:</strong> Cabinets, countertops, flooring, plumbing, electrical</li>
            </ul>
        </div>
        <div class="result">
            <strong>Result:</strong> Delivered in 5.5 weeks, final cost $52,400. Client loved the new island and open flow. Permits handled by us — no surprises.
        </div>
        <p>Every project is different, but we give you clear timelines and transparent pricing from the start.</p>
        <a href="{{ config('app.url') }}#quote" class="button">Get Your Free Estimate</a>
        <p>— The Blue Draft Team</p>
    </div>
    <div class="footer">Blue Draft Construction — Quality you can trust</div>
</body>
</html>
