# 🔧 Solución: Error "Failed to parse dotenv file"

## Problema

Si ves este error:
```
The environment file is invalid!
Failed to parse dotenv file. Encountered an invalid name at [```].
```

Significa que el archivo `.env` tiene un formato incorrecto o caracteres especiales no válidos.

## ✅ Solución Rápida

### Opción 1: Crear .env desde cero (Recomendado)

1. **Elimina el archivo .env actual** (si existe):
```bash
rm .env
```

2. **Crea un nuevo archivo .env** usando el script:
```bash
bash create-env.sh
```

3. **Edita el archivo .env** con tus datos reales:
```bash
nano .env
```

O usando el editor de Hostinger File Manager.

4. **Reemplaza los valores**:
   - `DB_DATABASE=nombre_de_tu_base_de_datos` → Tu nombre de BD real
   - `DB_USERNAME=usuario_de_base_de_datos` → Tu usuario de BD real
   - `DB_PASSWORD=contraseña_de_base_de_datos` → Tu contraseña de BD real
   - `APP_URL=https://tudominio.com` → Tu dominio real
   - `MAIL_USERNAME=tu_email@tudominio.com` → Tu email de Hostinger
   - `MAIL_PASSWORD=tu_contraseña_email` → Tu contraseña de email
   - `RECAPTCHA_SITE_KEY=...` → Tu clave de reCAPTCHA
   - `RECAPTCHA_SECRET_KEY=...` → Tu clave secreta de reCAPTCHA

5. **Genera APP_KEY**:
```bash
php artisan key:generate
```

### Opción 2: Crear .env manualmente

Crea un archivo `.env` con este contenido (sin backticks ni caracteres especiales):

```env
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
DB_DATABASE=tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=tu_email@tudominio.com
MAIL_PASSWORD=tu_contraseña
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@tudominio.com"
MAIL_FROM_NAME="Blue Draft"

RECAPTCHA_SITE_KEY=tu_site_key
RECAPTCHA_SECRET_KEY=tu_secret_key
```

## ⚠️ Reglas Importantes para .env

1. **NO uses backticks** (```) en el archivo
2. **NO uses comillas simples** para valores simples
3. **Usa comillas dobles** solo cuando sea necesario (valores con espacios)
4. **NO dejes líneas vacías** con espacios o tabs
5. **NO uses caracteres especiales** como `$`, `{`, `}` a menos que sea para variables
6. **Cada variable en una línea** separada
7. **Sin espacios** antes o después del signo `=`

## ✅ Verificar que .env es válido

Después de crear el archivo, verifica:

```bash
php artisan config:clear
php artisan key:generate
```

Si no hay errores, el archivo está correcto.

## 🔍 Comandos Útiles

```bash
# Ver el contenido del .env (sin mostrar contraseñas)
cat .env | grep -v PASSWORD

# Verificar sintaxis
php artisan config:clear

# Generar APP_KEY
php artisan key:generate

# Verificar que Laravel puede leer el .env
php artisan tinker
>>> config('app.name')
```

## 📝 Ejemplo de .env Correcto

```env
APP_NAME="Blue Draft"
APP_ENV=production
APP_KEY=base64:tu_clave_generada_aqui
APP_DEBUG=false
APP_URL=https://bluedraft.org

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u671466050_blue_draft
DB_USERNAME=u671466050_admin
DB_PASSWORD=TuContraseñaSegura123

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=noreply@bluedraft.org
MAIL_PASSWORD=TuContraseñaEmail
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@bluedraft.org"
MAIL_FROM_NAME="Blue Draft"

RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

---

**Nota**: Reemplaza todos los valores de ejemplo con tus datos reales de Hostinger.

