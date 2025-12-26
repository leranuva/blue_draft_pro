# 🚨 Solución Rápida: Error de .env en Hostinger

## Problema
```
The environment file is invalid!
Failed to parse dotenv file. Encountered an invalid name at [```].
```

## ✅ Solución Paso a Paso

### Opción 1: Usar el archivo template (Más Fácil)

1. **Elimina el .env actual**:
```bash
rm -f .env
```

2. **Copia el template**:
```bash
cp env-production-template.txt .env
```

3. **Edita el .env** con tus datos:
```bash
nano .env
```

4. **Reemplaza estos valores**:
   - `DB_DATABASE=nombre_de_tu_base_de_datos` → Tu BD real
   - `DB_USERNAME=usuario_de_base_de_datos` → Tu usuario real
   - `DB_PASSWORD=contraseña_de_base_de_datos` → Tu contraseña real
   - `APP_URL=https://tudominio.com` → Tu dominio real
   - `MAIL_USERNAME=tu_email@tudominio.com` → Tu email
   - `MAIL_PASSWORD=tu_contraseña_email` → Tu contraseña de email
   - `RECAPTCHA_SITE_KEY=...` → Tu clave de reCAPTCHA
   - `RECAPTCHA_SECRET_KEY=...` → Tu clave secreta

5. **Guarda y sal** (en nano: Ctrl+X, luego Y, luego Enter)

6. **Genera APP_KEY**:
```bash
php artisan key:generate
```

### Opción 2: Crear .env manualmente con echo

```bash
# Elimina el .env actual
rm -f .env

# Crea el .env línea por línea
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
EOF

# Edita con tus datos reales
nano .env

# Genera APP_KEY
php artisan key:generate
```

### Opción 3: Usar File Manager de Hostinger

1. Accede al File Manager de Hostinger
2. Navega a `public_html`
3. **Elimina** el archivo `.env` si existe
4. **Crea un nuevo archivo** llamado `.env`
5. **Copia y pega** el contenido del archivo `env-production-template.txt`
6. **Edita** los valores con tus datos reales
7. **Guarda** el archivo

## 🔍 Verificar que el .env es válido

```bash
# Limpiar cache
php artisan config:clear

# Verificar que puede leer el .env
php artisan tinker
>>> config('app.name')
# Debería mostrar: "Blue Draft"
>>> exit
```

## ⚠️ Errores Comunes

### ❌ NO hagas esto:
- NO uses backticks (```) en ningún lugar
- NO uses comillas simples para valores simples
- NO dejes espacios antes o después del `=`
- NO uses caracteres especiales como `$`, `{`, `}` a menos que sea necesario

### ✅ SÍ haz esto:
- Usa comillas dobles solo cuando el valor tenga espacios
- Cada variable en una línea separada
- Sin líneas vacías con espacios
- Valores simples sin comillas

## 📝 Ejemplo de .env Correcto

```env
APP_NAME="Blue Draft"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://bluedraft.org
LOG_CHANNEL=stack
LOG_LEVEL=error
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u671466050_blue_draft
DB_USERNAME=u671466050_admin
DB_PASSWORD=MiContraseña123
BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=noreply@bluedraft.org
MAIL_PASSWORD=MiContraseñaEmail
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@bluedraft.org"
MAIL_FROM_NAME="Blue Draft"
RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

## 🎯 Después de crear el .env correcto

```bash
# 1. Generar APP_KEY
php artisan key:generate

# 2. Limpiar cache
php artisan config:clear

# 3. Ejecutar migraciones
php artisan migrate --force

# 4. Ejecutar seeders
php artisan db:seed --force
```

---

**Si el error persiste**, verifica que el archivo `.env` no tenga:
- Caracteres invisibles
- Encoding incorrecto (debe ser UTF-8)
- Líneas con solo espacios
- Backticks o caracteres especiales

