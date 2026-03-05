# 🚀 Guía de Despliegue en Hostinger — Blue Draft

Guía para desplegar Blue Draft en Hostinger (shared hosting o VPS).

**Versión:** 1.2.0 — Febrero 2026

---

## 📋 Requisitos Previos

- Cuenta Hostinger (shared o VPS)
- Acceso SSH (recomendado) o File Manager
- Base de datos MySQL creada en Hostinger
- Dominio configurado y apuntando a Hostinger

---

## 🔧 Paso 1: Preparación Local (Antes de Subir)

### 1.1 Compilar Assets

```bash
npm run build
```

Esto genera archivos optimizados en `public/build/` (incluye .gz y .br para CDN).

### 1.2 Verificar Archivos

- ✅ `public/.htaccess` existe
- ✅ `public/build/` con manifest.json y assets
- ✅ `composer.json` y `composer.lock`
- ✅ `package.json` y `package-lock.json`

### 1.3 Archivos que NO subir

- `.env` (se crea en el servidor)
- `vendor/` (se instala con composer)
- `node_modules/`
- `storage/*.key`, `storage/pail`

---

## 📤 Paso 2: Subir Archivos

### Opción A: Git (si tienes SSH)

```bash
cd public_html  # o domains/bluedraft.cc/public_html
git clone https://github.com/tu-repo/blue_draft_pro.git .
```

### Opción B: FTP / File Manager (despliegue manual)

**Recomendado:** Ejecuta `.\prepare-deploy.ps1` localmente para generar `deploy/blue_draft_pro_deploy.zip`.  
Sube el ZIP a Hostinger, extráelo en `public_html` y sigue [HOSTINGER_MANUAL_DEPLOY.md](HOSTINGER_MANUAL_DEPLOY.md).

O sube todo el proyecto excepto `.env`, `vendor/`, `node_modules/`.

---

## 🔐 Paso 3: Configuración en el Servidor

### 3.1 Crear .env

Copia `.env.hostinger.example` a `.env` y rellena los valores:

```bash
cp .env.hostinger.example .env
# Editar .env con tus datos
```

O crea `.env` manualmente con:

```env
APP_NAME="Blue Draft"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://bluedraft.cc

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nombre_bd
DB_USERNAME=usuario_bd
DB_PASSWORD=contraseña_bd

SESSION_DRIVER=file
QUEUE_CONNECTION=sync

CACHE_STORE=file

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=info@bluedraft.cc
MAIL_PASSWORD=contraseña_email
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@bluedraft.cc"
MAIL_FROM_NAME="${APP_NAME}"
ADMIN_NOTIFICATION_EMAIL=info@bluedraft.cc

RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=

EMAIL_SEQUENCE_ENABLED=true
BREVO_API_KEY=
BREVO_LIST_ID=

GTM_ID=
GA4_MEASUREMENT_ID=
META_PIXEL_ID=
```

### 3.2 Generar APP_KEY

```bash
php artisan key:generate
```

### 3.3 Instalar Dependencias

```bash
composer install --optimize-autoloader --no-dev
```

---

## 🗄️ Paso 4: Base de Datos

### 4.1 Crear BD en Hostinger

Panel Hostinger → Bases de datos MySQL → Crear BD y usuario.

### 4.2 Migraciones y Seeders

```bash
php artisan migrate --force
php artisan db:seed --force
```

Esto crea: usuario admin (info@bluedraft.cc), settings, servicios, proyectos de ejemplo, páginas pilar distritos.

---

## 🔗 Paso 5: Enlaces y Permisos

```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

**Nota:** En Hostinger el usuario puede ser `u123456789` en lugar de `www-data`. Verifica con `whoami`.

---

## 🌐 Paso 6: Document Root

El Document Root debe apuntar a la carpeta **`public`** del proyecto.

- **Correcto:** `/home/usuario/domains/bluedraft.cc/public_html/public`
- O configura en Hostinger: Document Root → `public_html/public`

### Si no puedes cambiar Document Root

Mueve el contenido de `public/` a `public_html/` y actualiza `index.php` para que apunte al directorio padre. Ver [Hostinger docs](https://support.hostinger.com) para la estructura alternativa.

---

## ⚡ Paso 7: Cron (Importante)

Hostinger usa `QUEUE_CONNECTION=sync`, así que los jobs se ejecutan cuando el cron corre. Configura:

**Frecuencia:** Cada minuto  
**Comando:**
```bash
cd /home/usuario/domains/bluedraft.cc/public_html && php artisan schedule:run >> /dev/null 2>&1
```

En el panel de Hostinger: Cron Jobs → Añadir → `* * * * *` (cada minuto).

Esto ejecuta:
- `quotes:mark-abandoned` (diario)
- `leads:check-followups` (cada hora)

---

## 🔧 Paso 8: Optimización

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🧪 Paso 9: Verificación

| Prueba | URL / Acción |
|--------|--------------|
| Sitio principal | https://bluedraft.cc |
| Panel admin | https://bluedraft.cc/system-bd-access |
| Login | info@bluedraft.cc (contraseña en AdminUserSeeder) |
| Formulario contacto | Enviar y verificar email |
| Formulario cotización | Completar Step 1 y Step 2 |
| Imágenes | Verificar que cargan en proyectos |

---

## 🔒 Seguridad

- [ ] `APP_DEBUG=false`
- [ ] `APP_ENV=production`
- [ ] Cambiar contraseña admin tras primer login
- [ ] reCAPTCHA configurado (recomendado)
- [ ] `.env` con permisos 600 o 640

---

## 🆘 Solución de Problemas

### Error 500
- Revisar `storage/logs/laravel.log`
- Verificar permisos `storage/` y `bootstrap/cache/`
- Verificar `APP_KEY` y credenciales BD

### Assets no cargan
- Verificar que `public/build/` esté subido
- `php artisan optimize:clear`
- Verificar `APP_URL` en `.env`

### Emails no se envían
- Verificar SMTP en `.env`
- Usar credenciales de email de Hostinger
- Probar: `php artisan tinker` → `Mail::raw('test', fn($m) => $m->to('info@bluedraft.cc')->subject('Test'));`

### Formularios sin reCAPTCHA
- Si no configuras `RECAPTCHA_SECRET_KEY`, los formularios funcionan sin reCAPTCHA (menos seguro).

---

## 📝 Checklist Rápido

- [ ] `npm run build` ejecutado
- [ ] Archivos subidos (sin .env, vendor, node_modules)
- [ ] .env creado con datos de producción
- [ ] `php artisan key:generate`
- [ ] `composer install --optimize-autoloader --no-dev`
- [ ] `php artisan migrate --force`
- [ ] `php artisan db:seed --force`
- [ ] `php artisan storage:link`
- [ ] Permisos 775 en storage y bootstrap/cache
- [ ] Document Root → public/
- [ ] Cron configurado (* * * * * schedule:run)
- [ ] config:cache, route:cache, view:cache
- [ ] Sitio y panel funcionando

---

**Última actualización:** Febrero 2026
