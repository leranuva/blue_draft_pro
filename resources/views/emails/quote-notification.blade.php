<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud de Cotización</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #003366 0%, #336699 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .info-box {
            background: white;
            padding: 20px;
            margin: 15px 0;
            border-left: 4px solid #336699;
            border-radius: 4px;
        }
        .label {
            font-weight: bold;
            color: #003366;
            display: inline-block;
            min-width: 120px;
        }
        .value {
            color: #666;
        }
        .message-box {
            background: white;
            padding: 20px;
            margin: 15px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: #003366;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Nueva Solicitud de Cotización</h1>
        <p>Blue Draft Construction Company</p>
    </div>
    
    <div class="content">
        <p>Has recibido una nueva solicitud de cotización a través del sitio web.</p>
        
        <div class="info-box">
            <h3 style="margin-top: 0; color: #003366;">Información del Cliente</h3>
            <p><span class="label">Nombre:</span> <span class="value">{{ $quote->client_name }}</span></p>
            <p><span class="label">Email:</span> <span class="value"><a href="mailto:{{ $quote->email }}">{{ $quote->email }}</a></span></p>
            @if($quote->phone)
            <p><span class="label">Teléfono:</span> <span class="value"><a href="tel:{{ $quote->phone }}">{{ $quote->phone }}</a></span></p>
            @endif
            @if($quote->address)
            <p><span class="label">Dirección:</span> <span class="value">{{ $quote->address }}</span></p>
            @endif
        </div>
        
        <div class="info-box">
            <h3 style="margin-top: 0; color: #003366;">Detalles del Proyecto</h3>
            <p><span class="label">Tipo de Servicio:</span> <span class="value">{{ ucfirst($quote->service_type) }}</span></p>
            @if($quote->estimated_budget)
            <p><span class="label">Presupuesto Estimado:</span> <span class="value">{{ $quote->estimated_budget }}</span></p>
            @endif
            <p><span class="label">Fecha de Solicitud:</span> <span class="value">{{ $quote->created_at->format('d/m/Y H:i') }}</span></p>
            <p><span class="label">ID de Cotización:</span> <span class="value">#{{ $quote->id }}</span></p>
        </div>
        
        @if($quote->message)
        <div class="message-box">
            <h3 style="margin-top: 0; color: #003366;">Mensaje del Cliente</h3>
            <p style="white-space: pre-wrap;">{{ $quote->message }}</p>
        </div>
        @endif
        
        @if($quote->attachments->count() > 0)
        <div class="info-box">
            <h3 style="margin-top: 0; color: #003366;">Archivos Adjuntos</h3>
            <p>El cliente ha adjuntado <strong>{{ $quote->attachments->count() }}</strong> foto(s) con esta solicitud.</p>
            <ul>
                @foreach($quote->attachments as $attachment)
                <li>{{ $attachment->original_name }} ({{ number_format($attachment->file_size / 1024, 2) }} KB)</li>
                @endforeach
            </ul>
            <p style="font-size: 12px; color: #666; margin-top: 10px;">Los archivos están adjuntos a este correo.</p>
        </div>
        @endif
        
        <p style="margin-top: 30px;">
            <strong>Próximos pasos:</strong><br>
            Revisa los detalles de la solicitud y contacta al cliente lo antes posible para proporcionar una cotización.
        </p>
    </div>
    
    <div class="footer">
        <p>Este es un correo automático generado por el sistema de Blue Draft Construction Company.</p>
        <p>No respondas directamente a este correo. Usa el botón "Responder" de tu cliente de correo.</p>
    </div>
</body>
</html>

