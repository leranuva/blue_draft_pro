# ✅ Completar Archivo .env en Hostinger

Tu archivo `.env` está bien formateado, pero necesitas completar estos valores:

## 📝 Valores que Necesitas Actualizar

### 1. Configuración de Email (MAIL)

Reemplaza estos valores con tus credenciales reales de Hostinger:

```env
MAIL_USERNAME=tu_email@tudominio.com
MAIL_PASSWORD=tu_contraseña_email
MAIL_FROM_ADDRESS="noreply@tudominio.com"
```

**Ejemplo con tu dominio:**
```env
MAIL_USERNAME=noreply@leranuva.com
MAIL_PASSWORD=TuContraseñaDeEmail123
MAIL_FROM_ADDRESS="noreply@leranuva.com"
```

**Cómo obtener las credenciales:**
1. Accede al panel de Hostinger
2. Ve a "Correo Electrónico" o "Email Accounts"
3. Crea una cuenta de email (ej: noreply@leranuva.com)
4. Usa esas credenciales en el .env

### 2. Google reCAPTCHA

Reemplaza estos valores con tus claves reales de reCAPTCHA:

```env
RECAPTCHA_SITE_KEY=tu_site_key_de_google_recaptcha
RECAPTCHA_SECRET_KEY=tu_secret_key_de_google_recaptcha
```

**Cómo obtener las claves:**
1. Ve a https://www.google.com/recaptcha/admin
2. Crea un nuevo sitio (reCAPTCHA v2 "I'm not a robot" Checkbox)
3. Agrega tu dominio: `leranuva.com`
4. Copia la **Site Key** y **Secret Key**
5. Péguelas en el .env

**Si no tienes reCAPTCHA aún, puedes usar claves de prueba:**
```env
RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```
*(Estas son claves de prueba de Google, funcionan pero no ofrecen protección real)*

## ✅ Tu .env Completo Debería Verse Así:

```env
APP_NAME="Blue Draft"
APP_ENV=production
APP_KEY=base64:MASzB2jL6ZrU1cI4QHMZSh+xjpwKuLzCW4HgKrTfvfI=
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
MAIL_PASSWORD=TuContraseñaDeEmailReal
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@leranuva.com"
MAIL_FROM_NAME="Blue Draft"

RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

## 🔧 Comandos para Actualizar

```bash
# Editar el .env
nano .env

# Después de editar, verificar que funciona
php artisan config:clear
php artisan config:cache
```

## ⚠️ Notas Importantes

1. **LOG_LEVEL**: Cambia de `debug` a `error` en producción:
   ```env
   LOG_LEVEL=error
   ```

2. **MAIL_FROM_ADDRESS**: Debe coincidir con tu dominio:
   ```env
   MAIL_FROM_ADDRESS="noreply@leranuva.com"
   ```

3. **Contraseñas con @**: Si tu contraseña tiene el símbolo `@`, está bien, pero asegúrate de que no tenga espacios.

4. **Sin comillas en valores simples**: Valores como `APP_ENV=production` no necesitan comillas.

## ✅ Verificar que Todo Funciona

Después de actualizar el .env:

```bash
# 1. Limpiar cache
php artisan config:clear

# 2. Verificar configuración
php artisan tinker
>>> config('app.name')
# Debería mostrar: "Blue Draft"
>>> config('app.url')
# Debería mostrar: "https://leranuva.com"
>>> exit

# 3. Ejecutar migraciones
php artisan migrate --force

# 4. Ejecutar seeders
php artisan db:seed --force
```

---

**Una vez que completes estos valores, el proyecto debería funcionar correctamente en Hostinger.**

