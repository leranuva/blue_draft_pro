#!/bin/bash

# Script de despliegue para Hostinger
# Ejecutar en el servidor después de subir los archivos

echo "🚀 Iniciando despliegue de Blue Draft Web..."

# Colores para output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Verificar que estamos en el directorio correcto
if [ ! -f "artisan" ]; then
    echo -e "${RED}❌ Error: No se encontró el archivo artisan. Asegúrate de estar en el directorio raíz del proyecto.${NC}"
    exit 1
fi

echo -e "${YELLOW}📦 Instalando dependencias de Composer...${NC}"
composer install --optimize-autoloader --no-dev --no-interaction

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Error al instalar dependencias de Composer${NC}"
    exit 1
fi

echo -e "${YELLOW}🔑 Verificando APP_KEY...${NC}"
if ! grep -q "APP_KEY=base64:" .env 2>/dev/null; then
    echo -e "${YELLOW}⚠️  APP_KEY no encontrado. Generando...${NC}"
    php artisan key:generate --force
fi

echo -e "${YELLOW}🗄️  Ejecutando migraciones...${NC}"
php artisan migrate --force

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Error al ejecutar migraciones${NC}"
    exit 1
fi

echo -e "${YELLOW}🌱 Ejecutando seeders...${NC}"
php artisan db:seed --force

echo -e "${YELLOW}🔗 Creando enlace simbólico de storage...${NC}"
php artisan storage:link

echo -e "${YELLOW}⚡ Optimizando para producción...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo -e "${YELLOW}🧹 Limpiando cache...${NC}"
php artisan cache:clear
php artisan optimize:clear

echo -e "${GREEN}✅ Despliegue completado exitosamente!${NC}"
echo -e "${GREEN}📝 Verifica los permisos de storage/ y bootstrap/cache/${NC}"
echo -e "${GREEN}🔐 Asegúrate de que APP_DEBUG=false en .env${NC}"

