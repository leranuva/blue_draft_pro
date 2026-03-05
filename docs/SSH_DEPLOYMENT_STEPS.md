# 🚀 Pasos de Implementación en Hostinger vía SSH

Guía paso a paso para completar el despliegue usando SSH.

## 📋 Checklist Pre-Implementación

- [x] Archivos subidos a Hostinger
- [x] Acceso SSH configurado
- [ ] Archivo `.env` creado y configurado
- [ ] Base de datos MySQL creada en Hostinger
- [ ] Credenciales de base de datos anotadas

## 🔧 Paso 1: Verificar Ubicación y Archivos

```bash
# Verificar que estás en el directorio correcto
pwd
# Debería mostrar algo como: /home/u671466050/domains/leranuva.com/public_html

# Verificar que los archivos estén presentes
ls -la
# Deberías ver: artisan, composer.json, app/, public/, etc.
```

## 🔐 Paso 2: Configurar Archivo .env

```bash
# Verificar si existe .env
ls -la .env

# Si no existe o está mal formateado, créalo
nano .env
```

**Copia este contenido en el .env** (reemplaza con tus datos reales):

```env
APP_NAME="Blue Draft"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://leranuva.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u671466050_blue_draft
DB_USERNAME=u671466050_bluedraft
DB_PASSWORD=Blue@Draft@2026

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
MAIL_USERNAME=noreply@leranuva.com
MAIL_PASSWORD=tu_contraseña_email
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@leranuva.com"
MAIL_FROM_NAME="Blue Draft"

RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

**En nano**: 
- Pega el contenido
- Edita los valores de email y reCAPTCHA
- Guarda: `Ctrl+X`, luego `Y`, luego `Enter`

## 📦 Paso 3: Instalar Dependencias de Composer

```bash
# Verificar que composer está disponible
composer --version

# Instalar dependencias (esto puede tardar varios minutos)
composer install --optimize-autoloader --no-dev --no-interaction

# Si composer no está disponible globalmente, usa:
php composer.phar install --optimize-autoloader --no-dev --no-interaction
```

**Espera a que termine** (puede tardar 5-10 minutos).

## 🔑 Paso 4: Generar APP_KEY

```bash
# Generar la clave de aplicación
php artisan key:generate

# Verificar que se generó
grep APP_KEY .env
# Debería mostrar: APP_KEY=base64:...
```

## 🗄️ Paso 5: Configurar Base de Datos

### 5.1 Verificar Conexión a Base de Datos

```bash
# Probar conexión (esto mostrará errores si hay problemas)
php artisan migrate:status
```

Si hay errores de conexión, verifica:
- Que la base de datos existe en Hostinger
- Que el usuario tiene permisos
- Que las credenciales en `.env` son correctas

### 5.2 Ejecutar Migraciones

```bash
# Ejecutar todas las migraciones
php artisan migrate --force
```

**Espera a que termine**. Deberías ver mensajes como:
```
Migrating: 2025_12_24_232340_create_projects_table
Migrated:  2025_12_24_232340_create_projects_table
...
```

### 5.3 Ejecutar Seeders

```bash
# Ejecutar todos los seeders
php artisan db:seed --force
```

Esto creará:
- ✅ Usuario administrador (info@bluedraft.cc)
- ✅ Configuraciones iniciales del sitio
- ✅ Proyectos de ejemplo

## 🔗 Paso 6: Crear Enlace Simbólico de Storage

```bash
# Crear enlace simbólico
php artisan storage:link

# Verificar que se creó
ls -la public/storage
# Debería mostrar un enlace simbólico a ../storage/app/public
```

## 🔒 Paso 7: Configurar Permisos

```bash
# Verificar usuario actual
whoami

# Configurar permisos para storage y cache
chmod -R 775 storage bootstrap/cache

# En Hostinger, el usuario suele ser tu usuario (u671466050)
# No necesitas chown, solo chmod
```

## ⚡ Paso 8: Optimizar para Producción

```bash
# Limpiar cache anterior
php artisan optimize:clear

# Cachear configuración
php artisan config:cache

# Cachear rutas
php artisan route:cache

# Cachear vistas
php artisan view:cache
```

## 🌐 Paso 9: Verificar Document Root

En Hostinger, asegúrate de que el **Document Root** apunte a la carpeta `public`:

**Opción A: Si puedes cambiar Document Root**
- Document Root debe ser: `/home/u671466050/domains/leranuva.com/public_html/public`

**Opción B: Si NO puedes cambiar Document Root**
Necesitas mover archivos. Consulta la sección "Configuración Alternativa" en `docs/DEPLOYMENT_HOSTINGER.md`

## 🧪 Paso 10: Verificar que Todo Funciona

### 10.1 Verificar Sitio Principal

```bash
# Verificar que no hay errores en los logs
tail -n 50 storage/logs/laravel.log
```

Visita en el navegador:
- `https://leranuva.com` - Debería cargar el sitio

### 10.2 Verificar Panel de Administración

Visita:
- `https://leranuva.com/system-bd-access`

Credenciales:
- Email: `info@bluedraft.cc`
- Contraseña: `BlueDraft2024!`

## 🔍 Comandos de Verificación

```bash
# Verificar configuración
php artisan config:show app.name
php artisan config:show app.url
php artisan config:show database.connections.mysql.database

# Verificar rutas
php artisan route:list | head -20

# Verificar que storage link existe
ls -la public/storage

# Ver logs recientes
tail -n 20 storage/logs/laravel.log
```

## 🐛 Solución de Problemas

### Error: "Class not found"
```bash
# Limpiar y regenerar autoload
composer dump-autoload --optimize
php artisan optimize:clear
```

### Error: "Permission denied"
```bash
# Ajustar permisos
chmod -R 775 storage bootstrap/cache
```

### Error: "Storage link already exists"
```bash
# Eliminar y recrear
rm public/storage
php artisan storage:link
```

### Error: "No application encryption key"
```bash
# Generar APP_KEY
php artisan key:generate
php artisan config:clear
```

### Error 500 en el navegador
```bash
# Ver logs
tail -n 50 storage/logs/laravel.log

# Limpiar todo
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## ✅ Checklist Final

- [ ] `.env` configurado correctamente
- [ ] `composer install` ejecutado sin errores
- [ ] `APP_KEY` generado
- [ ] Migraciones ejecutadas
- [ ] Seeders ejecutados
- [ ] Enlace simbólico de storage creado
- [ ] Permisos configurados (775 en storage y bootstrap/cache)
- [ ] Configuración cacheada
- [ ] Document Root apunta a `public/`
- [ ] Sitio principal carga correctamente
- [ ] Panel de administración accesible
- [ ] Formularios funcionan
- [ ] No hay errores en logs

## 📝 Comandos Rápidos (Copia y Pega)

```bash
# Secuencia completa de comandos
composer install --optimize-autoloader --no-dev --no-interaction
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
chmod -R 775 storage bootstrap/cache
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

**Después de completar estos pasos, tu sitio debería estar funcionando en https://leranuva.com**

