# 🚀 Guía de Despliegue en Hostinger

Esta guía te ayudará a desplegar el proyecto Blue Draft Web en Hostinger.

## 📋 Requisitos Previos

- Cuenta de Hostinger con hosting compartido o VPS
- Acceso SSH (recomendado) o File Manager
- Base de datos MySQL creada en Hostinger
- Dominio configurado y apuntando a Hostinger

## 🔧 Paso 1: Preparación Local

### 1.1 Compilar Assets para Producción

```bash
npm run build
```

Esto generará los archivos optimizados en `public/build/`.

### 1.2 Verificar Archivos

Asegúrate de que estos archivos estén en el repositorio:
- ✅ `public/.htaccess` (ya existe)
- ✅ `composer.json` y `composer.lock`
- ✅ `package.json` y `package-lock.json`
- ✅ Todos los archivos del proyecto excepto los listados en `.gitignore`

### 1.3 Verificar .gitignore

El archivo `.gitignore` debe excluir:
- `.env`
- `vendor/`
- `node_modules/`
- `storage/*.key`
- `public/storage` (el enlace simbólico)

## 📤 Paso 2: Subir Archivos a Hostinger

### Opción A: Usando Git (Recomendado si tienes SSH)

1. Conecta por SSH a tu servidor Hostinger
2. Navega al directorio público (generalmente `public_html` o `domains/tudominio.com/public_html`)
3. Clona el repositorio:

```bash
cd public_html
git clone https://github.com/leranuva/blue_draft_project.git .
```

### Opción B: Usando File Manager o FTP

1. Accede al File Manager de Hostinger
2. Navega a `public_html` (o el directorio de tu dominio)
3. Sube todos los archivos del proyecto EXCEPTO:
   - `.env` (lo crearás en el servidor)
   - `vendor/` (se instalará con composer)
   - `node_modules/` (no es necesario en producción)

## 🔐 Paso 3: Configuración en el Servidor

### 3.1 Crear Archivo .env

En el servidor, crea el archivo `.env` basándote en `.env.example`:

```env
APP_NAME="Blue Draft"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://tudominio.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

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
```

### 3.2 Generar APP_KEY

Por SSH, ejecuta:

```bash
cd public_html
php artisan key:generate
```

O manualmente, copia el valor de `APP_KEY` de tu entorno local.

### 3.3 Instalar Dependencias

```bash
# Instalar dependencias de PHP
composer install --optimize-autoloader --no-dev

# Si necesitas compilar assets en el servidor (generalmente no es necesario)
# npm install
# npm run build
```

## 🗄️ Paso 4: Configurar Base de Datos

### 4.1 Crear Base de Datos en Hostinger

1. Accede al panel de Hostinger
2. Ve a "Bases de datos MySQL"
3. Crea una nueva base de datos
4. Crea un usuario y asígnale todos los privilegios
5. Anota las credenciales (host, nombre de BD, usuario, contraseña)

### 4.2 Ejecutar Migraciones

```bash
php artisan migrate --force
```

### 4.3 Ejecutar Seeders

```bash
php artisan db:seed --force
```

Esto creará:
- Usuario administrador (marcin@bluedraft.org / BlueDraft2024!)
- Configuraciones iniciales del sitio
- Proyectos de ejemplo

## 🔗 Paso 5: Configurar Enlaces y Permisos

### 5.1 Crear Enlace Simbólico de Storage

```bash
php artisan storage:link
```

### 5.2 Configurar Permisos

```bash
# Permisos para storage y cache
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

**Nota**: En Hostinger, el usuario puede ser diferente a `www-data`. Verifica con `whoami` o consulta la documentación de Hostinger.

## 🌐 Paso 6: Configurar el Servidor Web

### 6.1 Verificar .htaccess

El archivo `public/.htaccess` ya está configurado correctamente. Asegúrate de que esté en el directorio correcto.

### 6.2 Configurar Document Root

En Hostinger, asegúrate de que el Document Root apunte a la carpeta `public` del proyecto:

- **Ruta correcta**: `/public_html/public` (si el proyecto está en public_html)
- **O**: Configura el Document Root en el panel de Hostinger para que apunte a `public`

### 6.3 Configuración Alternativa (si no puedes cambiar Document Root)

Si Hostinger no te permite cambiar el Document Root, puedes:

1. Mover el contenido de `public/` a `public_html/`
2. Mover el resto de archivos a un nivel superior
3. Actualizar las rutas en `index.php`

**Estructura alternativa:**
```
public_html/
├── index.php (desde public/index.php)
├── .htaccess (desde public/.htaccess)
├── assets/ (desde public/build/)
└── ... (otros archivos de public/)

../blue_draft_web/
├── app/
├── bootstrap/
├── config/
└── ... (resto de archivos)
```

Y actualizar `index.php`:
```php
require __DIR__.'/../blue_draft_web/vendor/autoload.php';
$app = require_once __DIR__.'/../blue_draft_web/bootstrap/app.php';
```

## ⚡ Paso 7: Optimizar para Producción

```bash
# Cache de configuración
php artisan config:cache

# Cache de rutas
php artisan route:cache

# Cache de vistas
php artisan view:cache

# Limpiar cache de aplicación
php artisan cache:clear
```

## 🔒 Paso 8: Verificaciones de Seguridad

### 8.1 Verificar .env

- ✅ `APP_DEBUG=false`
- ✅ `APP_ENV=production`
- ✅ `APP_URL` configurado correctamente

### 8.2 Verificar Permisos

- ✅ `storage/` y `bootstrap/cache/` tienen permisos de escritura
- ✅ `.env` tiene permisos restrictivos (600 o 640)

### 8.3 Verificar reCAPTCHA

Asegúrate de que las claves de reCAPTCHA estén configuradas en `.env`.

## 🧪 Paso 9: Pruebas

### 9.1 Verificar Sitio Principal

1. Visita `https://tudominio.com`
2. Verifica que todas las secciones se carguen correctamente
3. Prueba el formulario de contacto
4. Verifica que las imágenes se muestren

### 9.2 Verificar Panel de Administración

1. Visita `https://tudominio.com/system-bd-access`
2. Inicia sesión con:
   - Email: `marcin@bluedraft.org`
   - Contraseña: `BlueDraft2024!`
3. Verifica que puedas acceder a todas las secciones

### 9.3 Verificar Funcionalidades

- ✅ Formulario de contacto funciona
- ✅ Formulario de cotización funciona
- ✅ Subida de imágenes funciona
- ✅ Emails se envían correctamente
- ✅ Panel de administración funciona

## 🔧 Solución de Problemas Comunes

### Error 500 - Internal Server Error

1. Verifica los logs en `storage/logs/laravel.log`
2. Verifica permisos de `storage/` y `bootstrap/cache/`
3. Verifica que `APP_KEY` esté configurado
4. Verifica que la base de datos esté configurada correctamente

### Assets no se cargan

1. Verifica que `npm run build` se haya ejecutado
2. Verifica que los archivos en `public/build/` existan
3. Verifica que `APP_URL` en `.env` sea correcto
4. Limpia la caché: `php artisan optimize:clear`

### Error de permisos

```bash
chmod -R 775 storage bootstrap/cache
chown -R usuario:grupo storage bootstrap/cache
```

### Base de datos no conecta

1. Verifica las credenciales en `.env`
2. Verifica que el host sea correcto (puede ser `localhost` o una IP específica)
3. Verifica que el usuario tenga permisos en la base de datos

### Panel de administración no accesible

1. Verifica que el usuario tenga email `@bluedraft.org`
2. Verifica que el usuario esté creado: `php artisan db:seed --class=AdminUserSeeder`
3. Verifica la URL: debe ser `/system-bd-access`

## 📝 Checklist Final

- [ ] Assets compilados (`npm run build`)
- [ ] Archivo `.env` configurado con datos de producción
- [ ] `APP_KEY` generado
- [ ] Base de datos creada y configurada
- [ ] Migraciones ejecutadas
- [ ] Seeders ejecutados
- [ ] Enlace simbólico de storage creado
- [ ] Permisos configurados correctamente
- [ ] Document Root apunta a `public/`
- [ ] Configuración cacheada (`config:cache`, `route:cache`, `view:cache`)
- [ ] `APP_DEBUG=false` en producción
- [ ] reCAPTCHA configurado
- [ ] Emails configurados
- [ ] Sitio principal funciona
- [ ] Panel de administración funciona
- [ ] Formularios funcionan
- [ ] Imágenes se muestran correctamente

## 🔄 Actualizaciones Futuras

Para actualizar el proyecto en producción:

```bash
# Conectar por SSH
cd public_html

# Actualizar código
git pull origin main

# Actualizar dependencias
composer install --optimize-autoloader --no-dev

# Ejecutar migraciones (si hay nuevas)
php artisan migrate --force

# Recompilar assets (si hay cambios)
npm run build

# Limpiar y recachear
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 📞 Soporte

Si encuentras problemas durante el despliegue:

1. Revisa los logs en `storage/logs/laravel.log`
2. Verifica la documentación de Hostinger
3. Consulta la sección de "Solución de Problemas" en el README.md

---

**Última actualización**: Diciembre 2025  
**Versión del proyecto**: 1.1.0

