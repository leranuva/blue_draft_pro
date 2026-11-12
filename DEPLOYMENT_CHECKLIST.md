# ✅ Checklist de Despliegue - Blue Draft

**Nota:** Hostinger shared hosting usa MySQL por defecto. Usa `DB_CONNECTION=mysql` en `.env`. Para PostgreSQL (VPS), usa `DB_CONNECTION=pgsql`.

**Guía detallada:** [docs/DEPLOYMENT_HOSTINGER.md](docs/DEPLOYMENT_HOSTINGER.md) | **Despliegue manual (FTP):** [docs/HOSTINGER_MANUAL_DEPLOY.md](docs/HOSTINGER_MANUAL_DEPLOY.md) | **Pre-deploy:** [docs/PRE_DEPLOY.md](docs/PRE_DEPLOY.md)

Usa esta checklist para asegurarte de que todo esté listo antes y después del despliegue.

## Actualización de seguridad

1. En Hostinger, confirma que el directorio web sea `public/`, que HTTP redirija a HTTPS y que `APP_DEBUG=false`, `SESSION_SECURE_COOKIE=true` y `expose_php=Off`. Comprueba de forma privada si se usaron la contraseña inicial o la antigua clave de aplicación publicada en la documentación. Rota las credenciales expuestas, revoca sesiones y revisa los accesos. Antes de rotar `APP_KEY`, identifica los datos cifrados que deban preservarse.
2. En una ventana de mantenimiento, instala el código y los recursos compilados, ejecuta `php artisan migrate --force` y aprovisiona cada administrador con `php artisan admin:provision correo`. Valida el registro MFA antes de reabrir el panel.
3. Bloquea `/storage/quotes/` en el servidor y en cualquier CDN que sirva archivos directamente. Ejecuta `php artisan quotes:privatize-attachments` y confirma que termina correctamente. Purga del CDN las fotos antiguas, las páginas internas, los diagnósticos y el HTML con sesión. Excluye del caché compartido todas las rutas dinámicas y conserva la caché para los recursos estáticos versionados.
4. Verifica que los diagnósticos y las URL antiguas de adjuntos devuelvan 404, que el HTML con sesión envíe `private, no-store`, que los adjuntos se descarguen desde el panel autenticado y que las notificaciones sigan incluyendo las fotos.
5. Prueba una política más estricta mediante `CSP_REPORT_ONLY` en preproducción. Incluye las integraciones activas de reCAPTCHA, analítica y fuentes en las pruebas. Pasa a aplicación obligatoria mediante `CSP_ENFORCE` después de verificar los scripts de la web y del panel. Amplía HSTS tras verificar HTTPS y cualquier subdominio que se quiera incluir.

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
- [ ] Administradores aprobados aprovisionados con `php artisan admin:provision correo`
- [ ] Acceso al panel verificado con MFA

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
- Usa las credenciales individuales aprovisionadas y el código MFA.

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

