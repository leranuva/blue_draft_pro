<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Received</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #003366 0%, #336699 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; border-top: none; }
        .button { display: inline-block; padding: 14px 28px; background: #003366; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">We Received Your Request</h1>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Blue Draft Construction</p>
    </div>
    <div class="content">
        <p>Hi <?php echo e($quote->client_name); ?>,</p>
        <p>Thank you for reaching out! We've received your quote request and our team will review it within 24 hours.</p>
        <p><strong>What happens next:</strong></p>
        <ul>
            <li>We'll call you to discuss your project and schedule a free consultation</li>
            <li>We'll provide a detailed estimate based on your needs</li>
            <li>No obligation — we're here to help you make the right decision</li>
        </ul>
        <p>Prefer to schedule a call now? Reply to this email or give us a call:</p>
        <p style="font-size: 1.25rem; font-weight: 600; color: #003366;">+1.347.636.6128</p>
        <a href="tel:+13476366128" class="button">Schedule Your Free Call</a>
        <p>We look forward to speaking with you!</p>
        <p>— The Blue Draft Team</p>
    </div>
    <div class="footer">Blue Draft Construction — NYC's trusted construction partner</div>
</body>
</html>
<?php /**PATH C:\projects\blue_draft_pro\resources\views/emails/sequence/1-confirmation.blade.php ENDPATH**/ ?>