# ✅ Proyecto Listo para Despliegue en Hostinger

**Fecha de preparación:** Febrero 2026  
**Proyecto:** Blue Draft

---

## Completado

- [x] **Assets compilados** — `npm run build` ejecutado
- [x] **public/build/** — manifest.json, app-*.js, app-*.css (+ .gz, .br)
- [x] **Caché limpiada** — config, routes, views
- [x] **Migraciones** — Todas ejecutadas (18 migraciones)
- [x] **Documentación** — PRE_DEPLOY.md, DEPLOYMENT_HOSTINGER.md, .env.hostinger.example

---

## Próximos pasos

### 1. Subir archivos
- Git: `git clone` en el servidor
- FTP: Subir todo excepto `.env`, `vendor/`, `node_modules/`

### 2. En el servidor Hostinger
```bash
cp .env.hostinger.example .env
# Editar .env con: dominio, BD, email, etc.
php artisan key:generate
composer install --optimize-autoloader --no-dev
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
chmod -R 775 storage bootstrap/cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Configurar cron
```
* * * * * cd /ruta/proyecto && php artisan schedule:run >> /dev/null 2>&1
```

### 4. Document Root
Debe apuntar a la carpeta **public/** del proyecto.

---

## Documentación

| Documento | Uso |
|-----------|-----|
| [PRE_DEPLOY.md](PRE_DEPLOY.md) | Pasos previos (ya ejecutados) |
| [DEPLOYMENT_HOSTINGER.md](DEPLOYMENT_HOSTINGER.md) | Guía completa paso a paso |
| [DEPLOYMENT_CHECKLIST.md](../DEPLOYMENT_CHECKLIST.md) | Checklist de verificación |
| [.env.hostinger.example](../.env.hostinger.example) | Plantilla .env |

---

## Acceso post-despliegue

- **Sitio:** https://bluedraft.cc
- **Panel:** https://bluedraft.cc/system-bd-access
- **Login:** info@bluedraft.cc (contraseña definida en AdminUserSeeder)
- **Importante:** Cambiar contraseña tras primer login
