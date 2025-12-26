# 📤 Guía para Subir el Proyecto a Hostinger vía FTP/File Manager

Esta guía te ayudará a subir el proyecto completo a Hostinger sin usar Git.

## 📋 Checklist Pre-Upload

### ✅ Verificar que Todo Esté Listo

- [ ] Assets compilados (`npm run build` ejecutado)
- [ ] Archivos compilados en `public/build/` verificados
- [ ] `.env` NO está en el proyecto (se crea en el servidor)
- [ ] `vendor/` NO está en el proyecto (se instala en el servidor)
- [ ] `node_modules/` NO está en el proyecto (no es necesario)

## 📁 Archivos y Carpetas a SUBIR

### ✅ Debes Subir TODO lo siguiente:

```
blue_draft_web/
├── app/                          ✅ SUBIR TODO
├── bootstrap/                    ✅ SUBIR TODO
├── config/                       ✅ SUBIR TODO
├── database/                     ✅ SUBIR TODO
├── docs/                         ✅ SUBIR TODO (opcional, pero útil)
├── public/                       ✅ SUBIR TODO
│   ├── .htaccess                 ✅ IMPORTANTE
│   ├── build/                    ✅ IMPORTANTE (assets compilados)
│   ├── images/                   ✅ SUBIR TODO
│   └── index.php                 ✅ IMPORTANTE
├── resources/                    ✅ SUBIR TODO
├── routes/                       ✅ SUBIR TODO
├── storage/                      ✅ SUBIR (pero NO storage/*.key)
│   ├── app/                      ✅ SUBIR
│   ├── framework/                ✅ SUBIR
│   └── logs/                     ✅ SUBIR (puede estar vacío)
├── artisan                       ✅ SUBIR
├── composer.json                 ✅ SUBIR
├── composer.lock                ✅ SUBIR
├── package.json                  ✅ SUBIR
├── package-lock.json             ✅ SUBIR
├── README.md                     ✅ SUBIR
├── DEPLOYMENT_CHECKLIST.md       ✅ SUBIR
├── deploy.sh                     ✅ SUBIR
├── create-env.sh                 ✅ SUBIR
├── env-production-template.txt   ✅ SUBIR
└── .gitignore                    ✅ SUBIR (para referencia)
```

## ❌ Archivos y Carpetas que NO Subir

### ❌ NO subir estos:

```
blue_draft_web/
├── .env                          ❌ NO SUBIR (se crea en el servidor)
├── .env.backup                   ❌ NO SUBIR
├── .env.production               ❌ NO SUBIR
├── vendor/                       ❌ NO SUBIR (se instala con composer)
├── node_modules/                 ❌ NO SUBIR (no es necesario)
├── storage/*.key                 ❌ NO SUBIR (archivos de claves)
├── public/hot                    ❌ NO SUBIR (si existe)
├── public/storage                ❌ NO SUBIR (enlace simbólico, se crea en servidor)
└── .git/                         ❌ NO SUBIR (si existe)
```

## 📦 Paso 1: Preparar Archivos Localmente

### 1.1 Compilar Assets

```bash
npm run build
```

Verifica que los archivos estén en `public/build/assets/`:
- `app-*.js`
- `app-*.css`
- `manifest.json`

### 1.2 Verificar Estructura

Asegúrate de que estos archivos existan:
- ✅ `public/.htaccess`
- ✅ `public/index.php`
- ✅ `composer.json`
- ✅ `composer.lock`
- ✅ `artisan`

## 📤 Paso 2: Subir Archivos a Hostinger

### Opción A: Usando File Manager de Hostinger

1. Accede al panel de Hostinger
2. Ve a **"File Manager"**
3. Navega a `public_html` (o el directorio de tu dominio)
4. **Sube las carpetas y archivos** uno por uno o en lotes:

**Orden recomendado:**
1. Primero sube `public/` (es lo más importante)
2. Luego `app/`, `bootstrap/`, `config/`, `database/`, `resources/`, `routes/`
3. Después `storage/` (sin los archivos .key)
4. Finalmente los archivos raíz: `artisan`, `composer.json`, etc.

### Opción B: Usando FTP (FileZilla, WinSCP, etc.)

1. Conecta a tu servidor Hostinger vía FTP
2. Navega a `public_html`
3. Arrastra y suelta las carpetas y archivos
4. Asegúrate de mantener la estructura de carpetas

## 🔧 Paso 3: Configuración en el Servidor

### 3.1 Crear Archivo .env

Usa el archivo `env-production-template.txt` como base:

1. En el servidor, copia `env-production-template.txt` a `.env`
2. Edita `.env` con tus datos reales:
   - Base de datos
   - Credenciales de email
   - reCAPTCHA keys
   - APP_URL

### 3.2 Ejecutar Comandos SSH

Después de subir los archivos, conecta por SSH y ejecuta:

```bash
# 1. Instalar dependencias
composer install --optimize-autoloader --no-dev --no-interaction

# 2. Generar APP_KEY
php artisan key:generate

# 3. Ejecutar migraciones
php artisan migrate --force

# 4. Ejecutar seeders
php artisan db:seed --force

# 5. Crear directorios para imágenes
mkdir -p storage/app/public/images/projects
mkdir -p storage/app/public/images/hero
mkdir -p storage/app/public/images/about
mkdir -p storage/app/public/images/testimonials

# 6. Crear enlace simbólico (IMPORTANTE para que las imágenes se muestren)
rm -f public/storage
ln -s ../storage/app/public public/storage

# 7. Verificar que el enlace se creó correctamente
ls -la public/storage

# 8. Permisos
chmod -R 775 storage bootstrap/cache

# 9. Optimizar
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

**⚠️ IMPORTANTE:** El enlace simbólico `public/storage` es **CRÍTICO** para que las imágenes se muestren. Si no se crea, las imágenes no cargarán.

## 📝 Lista de Verificación Post-Upload

- [ ] Todos los archivos subidos correctamente
- [ ] Estructura de carpetas mantenida
- [ ] `.env` creado y configurado
- [ ] `composer install` ejecutado sin errores
- [ ] `APP_KEY` generado
- [ ] Migraciones ejecutadas
- [ ] Seeders ejecutados
- [ ] Directorios de imágenes creados (`storage/app/public/images/*`)
- [ ] Enlace simbólico `public/storage` creado y verificado
- [ ] Permisos configurados (775 en storage y bootstrap/cache)
- [ ] Cache regenerado
- [ ] Sitio carga correctamente
- [ ] Panel de administración accesible
- [ ] **Imágenes de proyectos se muestran correctamente**

## 🎯 Archivos Críticos (Verificar que se Subieron)

Estos archivos son **esenciales**:

1. ✅ `public/.htaccess` - Configuración de Apache
2. ✅ `public/index.php` - Punto de entrada de Laravel
3. ✅ `public/build/assets/*` - Assets compilados (CSS/JS)
4. ✅ `artisan` - CLI de Laravel
5. ✅ `composer.json` y `composer.lock` - Dependencias
6. ✅ `app/` - Código de la aplicación
7. ✅ `config/` - Configuración
8. ✅ `routes/` - Rutas
9. ✅ `resources/views/` - Vistas Blade

## 📊 Tamaño Aproximado

El proyecto completo (sin vendor y node_modules) debería ser aproximadamente:
- **Sin compilar**: ~5-10 MB
- **Con assets compilados**: ~10-15 MB

## ⚠️ Notas Importantes

1. **Mantén la estructura**: Las carpetas deben mantener su estructura relativa
2. **Permisos**: Después de subir, configura permisos en `storage/` y `bootstrap/cache/`
3. **Document Root**: Asegúrate de que apunte a `public/` o configura `.htaccess` en `public_html`
4. **Tiempo de subida**: Puede tardar varios minutos dependiendo de tu conexión

## 🔄 Si Algo Sale Mal

1. Verifica que todos los archivos se subieron
2. Verifica permisos de carpetas
3. Revisa logs: `storage/logs/laravel.log`
4. Verifica que `.env` esté configurado correctamente
5. Ejecuta `php artisan optimize:clear` y regenera cache

## 🖼️ Problema: Imágenes No Se Cargan

Si las imágenes de los proyectos no se muestran:

1. **Verifica el enlace simbólico:**
   ```bash
   ls -la public/storage
   ```
   Debe mostrar: `public/storage -> ../storage/app/public`

2. **Verifica que los directorios existen:**
   ```bash
   ls -la storage/app/public/images/
   ```

3. **Verifica permisos:**
   ```bash
   chmod -R 775 storage/app/public
   ```

4. **Verifica APP_URL en .env:**
   ```bash
   grep APP_URL .env
   ```
   Debe ser: `APP_URL=https://leranuva.com` (sin `/` al final)

5. **Consulta la guía completa:**
   - `docs/FIX_IMAGES_NOT_LOADING.md` - Diagnóstico completo
   - `docs/SSH_FIX_IMAGES.md` - Comandos SSH rápidos

---

**Después de subir todos los archivos y ejecutar los comandos SSH, tu sitio debería estar funcionando en Hostinger.**

