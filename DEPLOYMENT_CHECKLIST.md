# ✅ Checklist de Despliegue - Blue Draft

**Nota:** Hostinger shared hosting usa MySQL por defecto. Usa `DB_CONNECTION=mysql` en `.env`. Para PostgreSQL (VPS), usa `DB_CONNECTION=pgsql`.

**Guía detallada:** [docs/DEPLOYMENT_HOSTINGER.md](docs/DEPLOYMENT_HOSTINGER.md) | **Despliegue manual (FTP):** [docs/HOSTINGER_MANUAL_DEPLOY.md](docs/HOSTINGER_MANUAL_DEPLOY.md) | **Pre-deploy:** [docs/PRE_DEPLOY.md](docs/PRE_DEPLOY.md)

Usa esta checklist para asegurarte de que todo esté listo antes y después del despliegue.

## 📋 Antes de Subir a Hostinger

### Preparación Local
- [ ] Assets compilados: `npm run build` ejecutado
- [ ] Archivos compilados en `public/build/` verificados
- [ ] `.env.example` actualizado con todas las variables necesarias
- [ ] Código commiteado y pusheado a GitHub
- [ ] `.gitignore` verificado (no excluye archivos necesarios)

### Archivos a Subir
- [ ] Todos los archivos del proyecto (excepto los del `.gitignore`)
- [ ] `public/build/` con assets compilados
- [ ] `public/.htaccess` presente
- [ ] `composer.json` y `composer.lock` presentes
- [ ] `package.json` y `package-lock.json` presentes

### Archivos que NO subir
- [ ] `.env` (se crea en el servidor)
- [ ] `vendor/` (se instala con composer)
- [ ] `node_modules/` (no necesario en producción)
- [ ] Archivos de desarrollo

## 🔧 En el Servidor (Hostinger)

### Configuración Inicial
- [ ] Archivos subidos al servidor
- [ ] Archivo `.env` creado con configuración de producción
- [ ] `APP_ENV=production` en `.env`
- [ ] `APP_DEBUG=false` en `.env`
- [ ] `APP_URL` configurado correctamente (https://tudominio.com)
- [ ] `APP_KEY` generado o copiado

### Base de Datos
- [ ] Base de datos MySQL creada en Hostinger (o PostgreSQL en VPS)
- [ ] Usuario de base de datos creado con permisos
- [ ] Credenciales de BD configuradas en `.env`
- [ ] Migraciones ejecutadas: `php artisan migrate --force`
- [ ] Seeders ejecutados: `php artisan db:seed --force`
- [ ] Usuario administrador creado (info@bluedraft.cc)

### Dependencias
- [ ] Composer instalado en el servidor
- [ ] Dependencias instaladas: `composer install --optimize-autoloader --no-dev`
- [ ] (Opcional) Si hay cambios en assets: `npm install && npm run build`
- [ ] Sin errores en la instalación

### Configuración del Servidor
- [ ] Document Root apunta a `public/` (o estructura alternativa configurada)
- [ ] `.htaccess` en el lugar correcto
- [ ] Permisos de `storage/` configurados (775)
- [ ] Permisos de `bootstrap/cache/` configurados (775)
- [ ] Enlace simbólico creado: `php artisan storage:link`

### Cola de trabajos y Cron
- [ ] **Hostinger shared:** `QUEUE_CONNECTION=sync` en .env (no se necesita queue:work)
- [ ] Cron configurado: `* * * * * cd /ruta/proyecto && php artisan schedule:run >> /dev/null 2>&1`

### Optimización
- [ ] Configuración cacheada: `php artisan config:cache`
- [ ] Rutas cacheadas: `php artisan route:cache`
- [ ] Vistas cacheadas: `php artisan view:cache`
- [ ] Cache limpiada: `php artisan cache:clear`

### Configuración de Email
- [ ] SMTP configurado en `.env`
- [ ] Credenciales de email de Hostinger configuradas
- [ ] Email de prueba enviado exitosamente

### reCAPTCHA
- [ ] `RECAPTCHA_SITE_KEY` configurado en `.env`
- [ ] `RECAPTCHA_SECRET_KEY` configurado en `.env`
- [ ] reCAPTCHA funciona en los formularios

## 🧪 Pruebas Post-Despliegue

### Sitio Principal
- [ ] Página principal carga correctamente
- [ ] Todas las secciones visibles (Hero, About, Projects, Services, Testimonials, Contact)
- [ ] Navegación funciona correctamente
- [ ] Menú móvil funciona
- [ ] Modo oscuro/claro funciona
- [ ] Imágenes se cargan correctamente
- [ ] Animaciones funcionan

### Formularios
- [ ] Formulario de contacto funciona
- [ ] Formulario de cotización funciona
- [ ] Validación de campos funciona
- [ ] reCAPTCHA funciona
- [ ] Emails se envían correctamente
- [ ] Subida de imágenes funciona (cotización)

### Panel de Administración
- [ ] Acceso a `/system-bd-access` funciona
- [ ] Login funciona con credenciales correctas
- [ ] Dashboard carga correctamente
- [ ] Todas las páginas de configuración accesibles
- [ ] Gestión de proyectos funciona
- [ ] Gestión de cotizaciones funciona
- [ ] Cambios se guardan correctamente

### Performance
- [ ] Página carga rápidamente
- [ ] Assets se cargan correctamente
- [ ] Sin errores en consola del navegador
- [ ] Sin errores en logs de Laravel

### Seguridad
- [ ] `APP_DEBUG=false` en producción
- [ ] `.env` no es accesible públicamente
- [ ] Panel de administración solo accesible con email @bluedraft.org o @bluedraft.cc
- [ ] Formularios tienen protección CSRF
- [ ] reCAPTCHA activo

## 📝 Información de Acceso

### Panel de Administración
- **URL**: `https://tudominio.com/system-bd-access`
- **Email**: `info@bluedraft.cc`
- **Contraseña**: `BlueDraft2024!`

### Base de Datos
- **Host**: (anotar)
- **Nombre**: (anotar)
- **Usuario**: (anotar)
- **Contraseña**: (anotar - guardar de forma segura)

### FTP/SSH
- **Host**: (anotar)
- **Usuario**: (anotar)
- **Contraseña**: (anotar - guardar de forma segura)

## 🔄 Actualizaciones Futuras

Cuando necesites actualizar el sitio:

1. [ ] Hacer cambios localmente
2. [ ] Probar cambios localmente
3. [ ] Commit y push a GitHub
4. [ ] En servidor: `git pull origin main`
5. [ ] En servidor: `composer install --optimize-autoloader --no-dev`
6. [ ] En servidor: `php artisan migrate --force` (si hay nuevas migraciones)
7. [ ] En servidor: `npm run build` (si hay cambios en assets)
8. [ ] En servidor: `php artisan optimize:clear && php artisan config:cache && php artisan route:cache && php artisan view:cache`
9. [ ] Verificar que todo funciona

## 🆘 Si Algo Sale Mal

1. [ ] Revisar logs: `storage/logs/laravel.log`
2. [ ] Verificar permisos de `storage/` y `bootstrap/cache/`
3. [ ] Verificar configuración en `.env`
4. [ ] Verificar que la base de datos esté accesible
5. [ ] Limpiar cache: `php artisan optimize:clear`
6. [ ] Verificar Document Root en Hostinger

---

**Fecha de despliegue**: _______________  
**Versión desplegada**: 1.2.0  
**Desplegado por**: _______________

