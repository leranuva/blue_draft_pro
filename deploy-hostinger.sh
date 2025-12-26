#!/bin/bash

# Script de Despliegue Completo para Hostinger
# Ejecutar: bash deploy-hostinger.sh

echo "🚀 Iniciando despliegue en Hostinger..."
echo ""

# 1. Ir al directorio
echo "📁 Navegando al directorio del proyecto..."
cd ~/public_html || exit 1

# 2. Instalar dependencias
echo "📦 Instalando dependencias de Composer..."
composer install --optimize-autoloader --no-dev --no-interaction

if [ $? -ne 0 ]; then
    echo "❌ Error al instalar dependencias"
    exit 1
fi

# 3. Generar APP_KEY (si no existe)
echo "🔑 Generando APP_KEY..."
php artisan key:generate --force

# 4. Ejecutar migraciones
echo "🗄️  Ejecutando migraciones..."
php artisan migrate --force

if [ $? -ne 0 ]; then
    echo "❌ Error al ejecutar migraciones"
    exit 1
fi

# 5. Ejecutar seeders
echo "🌱 Ejecutando seeders..."
php artisan db:seed --force

if [ $? -ne 0 ]; then
    echo "❌ Error al ejecutar seeders"
    exit 1
fi

# 6. Crear directorios
echo "📂 Creando directorios necesarios..."
mkdir -p storage/app/public/images/projects
mkdir -p storage/app/public/images/hero
mkdir -p storage/app/public/images/about
mkdir -p storage/app/public/images/testimonials
mkdir -p storage/app/public/images/quotes

# 7. Crear enlace simbólico
echo "🔗 Creando enlace simbólico..."
rm -f public/storage
ln -s ../storage/app/public public/storage

# Verificar enlace
if [ -L public/storage ]; then
    echo "✅ Enlace simbólico creado correctamente"
else
    echo "❌ Error al crear enlace simbólico"
    exit 1
fi

# 8. Configurar permisos
echo "🔐 Configurando permisos..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# 9. Limpiar cache
echo "🧹 Limpiando cache..."
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 10. Regenerar cache
echo "💾 Regenerando cache..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 11. Verificar
echo "✅ Verificando instalación..."
php artisan projects:check

echo ""
echo "🎉 ¡Despliegue completado!"
echo ""
echo "📝 Próximos pasos:"
echo "1. Verifica que el sitio carga: https://leranuva.com"
echo "2. Accede al panel: https://leranuva.com/system-bd-access"
echo "3. Verifica que las imágenes se muestran correctamente"
echo ""

