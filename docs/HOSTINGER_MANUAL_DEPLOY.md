# 📤 Despliegue Manual en Hostinger — Blue Draft

Guía paso a paso para subir el proyecto a Hostinger manualmente (FTP o File Manager).

---

## Parte 1: Preparación Local (en tu PC)

### Paso 1.1 — Ejecutar el script de preparación

Abre PowerShell en la carpeta del proyecto y ejecuta:

```powershell
.\prepare-deploy.ps1
```

Esto hará:
- ✅ Compilar assets (`npm run build`)
- ✅ Crear carpeta `deploy/blue_draft_pro/` con todos los archivos necesarios
- ✅ Generar `deploy/blue_draft_pro_deploy.zip`

**Archivos excluidos automáticamente:** `.env`, `vendor/`, `node_modules/`, `.git/`, logs, cache.

### Paso 1.2 — Verificar el paquete

Comprueba que existan:
- `deploy/blue_draft_pro_deploy.zip` (o carpeta `deploy/blue_draft_pro/`)
- `public/build/manifest.json` dentro del paquete
- `.env.hostinger.example` dentro del paquete

---

## Parte 2: Subir a Hostinger

### Opción A: File Manager (recomendado)

1. Entra al **Panel de Hostinger** → **File Manager**
2. Navega a `domains/tudominio.com/public_html` (o `public_html` si es el dominio principal)
3. **Sube el ZIP** `blue_draft_pro_deploy.zip`
4. **Extrae** el ZIP (clic derecho → Extract)
5. Mueve el contenido de `blue_draft_pro/` al nivel de `public_html/`:
   - Selecciona todo dentro de `blue_draft_pro/`
   - Córtalo (Cut)
   - Ve a `public_html/`
   - Pégalo (Paste)
   - Elimina la carpeta vacía `blue_draft_pro/`

**Estructura final esperada en public_html:**
```
public_html/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/          ← Document Root debe apuntar aquí
│   ├── build/
│   ├── .htaccess
│   ├── index.php
│   └── ...
├── resources/
├── routes/
├── storage/
├── .env.hostinger.example
├── artisan
├── composer.json
├── composer.lock
└── ...
```

### Opción B: FTP (FileZilla, WinSCP, etc.)

1. Conecta por FTP con las credenciales de Hostinger
2. Navega a `public_html` (o `domains/tudominio.com/public_html`)
3. Sube **todo el contenido** de `deploy/blue_draft_pro/` (no la carpeta raíz si ya estás en public_html)
4. Asegúrate de subir en modo **binario** para archivos compilados

---

## Parte 3: Configuración en el Servidor

### Paso 3.1 — Crear base de datos MySQL

1. Panel Hostinger → **Bases de datos MySQL**
2. Crear nueva base de datos
3. Crear usuario con contraseña
4. Asignar el usuario a la base de datos
5. Anota: `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

### Paso 3.2 — Crear archivo .env

1. En File Manager, renombra `.env.hostinger.example` a `.env`
2. Edita `.env` y rellena:

```env
APP_NAME="Blue Draft"
APP_ENV=production
APP_KEY=                    # Se generará en el siguiente paso
APP_DEBUG=false
APP_URL=https://tudominio.com
ASSET_URL=https://tudominio.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_blue_draft    # Tu BD
DB_USERNAME=u123456789_user         # Tu usuario
DB_PASSWORD=tu_contraseña           # Tu contraseña

QUEUE_CONNECTION=sync
CACHE_STORE=file
SESSION_DRIVER=file

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=info@tudominio.com
MAIL_PASSWORD=contraseña_email
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@tudominio.com"
MAIL_FROM_NAME="${APP_NAME}"
ADMIN_NOTIFICATION_EMAIL=info@tudominio.com

RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=

EMAIL_SEQUENCE_ENABLED=true
BREVO_API_KEY=
BREVO_LIST_ID=

GTM_ID=
GA4_MEASUREMENT_ID=
META_PIXEL_ID=
```

### Paso 3.3 — Acceder por SSH (o Terminal en Hostinger)

Si tienes SSH habilitado:

```bash
cd ~/domains/tudominio.com/public_html
# o: cd ~/public_html
```

Si usas **Terminal** desde el panel de Hostinger, navega a la carpeta del proyecto.

### Paso 3.4 — Comandos en el servidor

Ejecuta en orden:

```bash
# 1. Generar APP_KEY
php artisan key:generate

# 2. Instalar dependencias PHP (sin dev)
composer install --optimize-autoloader --no-dev

# 3. Migraciones y datos iniciales
php artisan migrate --force
php artisan db:seed --force

# 4. Enlace simbólico para storage
php artisan storage:link

# 5. Permisos (ajusta usuario si es necesario)
chmod -R 775 storage bootstrap/cache

# 6. Optimización
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Paso 3.5 — Document Root

En Hostinger → **Dominios** → tu dominio → **Configuración**:

- **Document Root** debe apuntar a la carpeta `public` del proyecto.
- Ejemplo: `public_html/public` o `domains/tudominio.com/public_html/public`

Si no puedes cambiar Document Root, consulta la sección alternativa en [DEPLOYMENT_HOSTINGER.md](DEPLOYMENT_HOSTINGER.md).

### Paso 3.6 — Cron (opcional pero recomendado)

Panel Hostinger → **Cron Jobs** → Añadir:

- **Frecuencia:** `* * * * *` (cada minuto)
- **Comando:**
```bash
cd /home/usuario/domains/tudominio.com/public_html && php artisan schedule:run >> /dev/null 2>&1
```

Reemplaza `usuario` y la ruta con la tuya (Hostinger suele mostrar la ruta al crear el cron).

---

## Parte 4: Verificación

| Prueba | URL |
|--------|-----|
| Sitio principal | https://tudominio.com |
| Panel admin | https://tudominio.com/system-bd-access |
| Evaluación proyecto | https://tudominio.com/evaluacion-proyecto |
| Calculadora | https://tudominio.com/cost-calculator |

**Credenciales admin por defecto:**
- Email: `info@bluedraft.cc` (o el configurado en AdminUserSeeder)
- Contraseña: Ver `database/seeders/AdminUserSeeder.php`

---

## 🆘 Solución de problemas

### Error 500
- Revisa `storage/logs/laravel.log`
- Verifica permisos: `chmod -R 775 storage bootstrap/cache`
- Comprueba que `APP_KEY` esté en `.env`

### Assets no cargan (CSS/JS)
- Verifica que `public/build/` esté subido
- Ejecuta: `php artisan optimize:clear`
- Comprueba `APP_URL` y `ASSET_URL` en `.env`

### No tengo SSH
- Usa **Terminal** desde el panel de Hostinger (si está disponible)
- O instala Composer localmente, ejecuta `composer install --no-dev`, y sube la carpeta `vendor/` por FTP (más lento pero posible)

### Base de datos no conecta
- Verifica `DB_HOST` (suele ser `localhost`)
- En Hostinger a veces el host es `localhost` o una IP interna; revisa el panel de BD

---

## 📋 Checklist rápido

- [ ] `.\prepare-deploy.ps1` ejecutado
- [ ] ZIP subido y extraído en public_html
- [ ] `.env` creado y configurado
- [ ] `php artisan key:generate`
- [ ] `composer install --optimize-autoloader --no-dev`
- [ ] `php artisan migrate --force`
- [ ] `php artisan db:seed --force`
- [ ] `php artisan storage:link`
- [ ] Document Root → `public/`
- [ ] Cron configurado (opcional)
- [ ] Sitio carga correctamente

---

**Guía relacionada:** [DEPLOYMENT_HOSTINGER.md](DEPLOYMENT_HOSTINGER.md) (detalle técnico completo)
