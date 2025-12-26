# 🔧 Solución: Error 403 Forbidden en Hostinger

El error 403 generalmente ocurre porque el Document Root no apunta a la carpeta `public/` de Laravel.

## 🔍 Diagnóstico

Primero, verifica dónde están tus archivos:

```bash
# Verificar ubicación actual
pwd
# Debería mostrar: /home/u671466050/domains/leranuva.com/public_html

# Verificar estructura
ls -la
# Deberías ver: app/, bootstrap/, public/, artisan, etc.
```

## ✅ Solución 1: Cambiar Document Root (Recomendado)

### En el Panel de Hostinger:

1. Accede al panel de Hostinger
2. Ve a **"Dominios"** o **"Manage"**
3. Selecciona tu dominio (`leranuva.com`)
4. Busca **"Document Root"** o **"Public HTML Path"**
5. Cambia de: `/public_html` 
6. A: `/public_html/public`

**O en algunos paneles:**
- Document Root: `public_html/public`
- O: `domains/leranuva.com/public_html/public`

### Verificar después del cambio:

Espera unos minutos y prueba de nuevo en el navegador.

## ✅ Solución 2: Mover Archivos (Si no puedes cambiar Document Root)

Si Hostinger no te permite cambiar el Document Root, mueve los archivos:

```bash
# 1. Verificar ubicación actual
pwd
# Debería estar en: /home/u671466050/domains/leranuva.com/public_html

# 2. Mover contenido de public/ a public_html/
mv public/* public_html/ 2>/dev/null || true
mv public/.htaccess public_html/ 2>/dev/null || true

# 3. Mover el resto de archivos a un nivel superior
cd ..
mkdir -p blue_draft_web
cd public_html

# Mover archivos del proyecto (excepto public/)
mv app ../blue_draft_web/
mv bootstrap ../blue_draft_web/
mv config ../blue_draft_web/
mv database ../blue_draft_web/
mv resources ../blue_draft_web/
mv routes ../blue_draft_web/
mv storage ../blue_draft_web/
mv artisan ../blue_draft_web/
mv composer.json ../blue_draft_web/
mv composer.lock ../blue_draft_web/
mv package.json ../blue_draft_web/
mv package-lock.json ../blue_draft_web/
mv .env ../blue_draft_web/
mv vendor ../blue_draft_web/ 2>/dev/null || true

# 4. Actualizar index.php para apuntar a la nueva ubicación
nano public_html/index.php
```

**Reemplaza el contenido de `index.php` con:**

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../blue_draft_web/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../blue_draft_web/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../blue_draft_web/bootstrap/app.php';

$app->handleRequest(Request::capture());
```

## ✅ Solución 3: Crear .htaccess en public_html (Alternativa Simple)

Si prefieres no mover archivos, crea un `.htaccess` en `public_html` que redirija a `public/`:

```bash
# Crear .htaccess en public_html
cat > public_html/.htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L]
</IfModule>
EOF
```

**O más completo:**

```bash
cat > public_html/.htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Redirect to public folder
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ /public/$1 [L]
</IfModule>
EOF
```

## ✅ Solución 4: Verificar Permisos

Asegúrate de que los permisos sean correctos:

```bash
# Permisos para directorios
find public_html -type d -exec chmod 755 {} \;

# Permisos para archivos
find public_html -type f -exec chmod 644 {} \;

# Permisos especiales para Laravel
chmod -R 775 storage bootstrap/cache
chmod 644 public_html/.htaccess
```

## 🔍 Verificar que Funciona

```bash
# Verificar que .htaccess existe en public/
ls -la public/.htaccess

# Verificar que index.php existe en public/
ls -la public/index.php

# Verificar permisos
ls -ld public_html public_html/public
```

## 📝 Estructura Correcta

**Opción A (Document Root = public_html/public):**
```
public_html/
├── app/
├── bootstrap/
├── config/
├── public/          ← Document Root apunta aquí
│   ├── index.php
│   ├── .htaccess
│   └── build/
└── ...
```

**Opción B (Document Root = public_html, con .htaccess redirect):**
```
public_html/        ← Document Root apunta aquí
├── .htaccess       ← Redirige a public/
├── index.php       ← Desde public/index.php
├── build/          ← Desde public/build/
└── ...

../blue_draft_web/
├── app/
├── bootstrap/
└── ...
```

## 🐛 Si el Error Persiste

1. **Verificar logs del servidor:**
   ```bash
   tail -n 50 storage/logs/laravel.log
   ```

2. **Verificar que mod_rewrite está habilitado:**
   - En Hostinger generalmente está habilitado por defecto
   - Si no, contacta al soporte

3. **Verificar permisos del .htaccess:**
   ```bash
   ls -la public/.htaccess
   chmod 644 public/.htaccess
   ```

4. **Probar acceso directo:**
   - `https://leranuva.com/public/` - Debería funcionar
   - Si funciona, el problema es el Document Root

## ✅ Comandos Rápidos (Solución 3 - Más Simple)

```bash
# Crear .htaccess en public_html que redirija a public/
cat > public_html/.htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L]
</IfModule>
EOF

# Verificar
cat public_html/.htaccess
```

---

**Después de aplicar una de estas soluciones, el error 403 debería resolverse.**

