# 📂 Actualización de Carpetas en Hostinger — Blue Draft

Guía para actualizar un proyecto ya desplegado subiendo solo las carpetas modificadas.

---

## Antes de subir

Compila los assets localmente:

```bash
npm run build
```

---

## Carpetas a subir (sobrescribir en el servidor)

Sube estas carpetas **completas** desde tu proyecto local, reemplazando las que existen en el servidor:

| Carpeta | Origen | Destino en servidor |
|---------|--------|---------------------|
| `app/` | `app/` | `public_html/app/` |
| `config/` | `config/` | `public_html/config/` |
| `database/` | `database/` | `public_html/database/` |
| `public/` | `public/` | `public_html/public/` |
| `resources/` | `resources/` | `public_html/resources/` |
| `routes/` | `routes/` | `public_html/routes/` |
| `bootstrap/` | `bootstrap/` | `public_html/bootstrap/` |

---

## Archivos sueltos en la raíz

Sube también estos archivos (sobrescribir):

- `artisan`
- `composer.json`
- `composer.lock`
- `package.json`
- `package-lock.json`
- `vite.config.js`

---

## Después de subir

Conecta por SSH o usa el Terminal de Hostinger y ejecuta:

```bash
cd ~/domains/tudominio.com/public_html
# o: cd ~/public_html

composer install --optimize-autoloader --no-dev
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

**Importante:** `php artisan migrate --force` es necesario para que el dashboard muestre los leads (columna `stage`). Si el dashboard muestra ceros, ver [FIX_DASHBOARD_LEADS_HOSTINGER.md](FIX_DASHBOARD_LEADS_HOSTINGER.md).

---

## No subir

- `.env` (mantener el del servidor)
- `vendor/` (se instala con composer)
- `node_modules/`
- `storage/logs/` (opcional, mantén los logs del servidor si quieres)
- `storage/framework/` (cache, sessions, views - se regeneran)

---

## Resumen rápido

1. `npm run build` local
2. Subir: `app`, `config`, `database`, `public`, `resources`, `routes`, `bootstrap`
3. Subir: `artisan`, `composer.json`, `composer.lock`, `package.json`, `package-lock.json`, `vite.config.js`
4. En servidor: `composer install --no-dev`, `migrate --force`, `config:cache`, `route:cache`, `view:cache`
