#!/bin/bash

# Script para crear archivo .env en el servidor Hostinger
# Ejecutar: bash create-env.sh

echo "Creando archivo .env para producción..."

cat > .env << 'EOF'
APP_NAME="Blue Draft"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://tudominio.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=usuario_de_base_de_datos
DB_PASSWORD=contraseña_de_base_de_datos

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=tu_email@tudominio.com
MAIL_PASSWORD=tu_contraseña_email
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@tudominio.com"
MAIL_FROM_NAME="${APP_NAME}"

RECAPTCHA_SITE_KEY=tu_site_key_de_google_recaptcha
RECAPTCHA_SECRET_KEY=tu_secret_key_de_google_recaptcha
EOF

echo "✅ Archivo .env creado!"
echo ""
echo "⚠️  IMPORTANTE: Edita el archivo .env y reemplaza:"
echo "   - DB_DATABASE con el nombre de tu base de datos"
echo "   - DB_USERNAME con tu usuario de base de datos"
echo "   - DB_PASSWORD con tu contraseña de base de datos"
echo "   - APP_URL con tu dominio (https://tudominio.com)"
echo "   - MAIL_USERNAME y MAIL_PASSWORD con tus credenciales de email"
echo "   - RECAPTCHA_SITE_KEY y RECAPTCHA_SECRET_KEY con tus claves de reCAPTCHA"
echo ""
echo "Luego ejecuta: php artisan key:generate"

