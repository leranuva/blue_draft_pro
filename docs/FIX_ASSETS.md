# Arreglar estilos no cargados en producción

## Causa probable
La carpeta `public/build/` no está completa en el servidor o las rutas de los assets son incorrectas.

---

## Solución 1: Subir la carpeta build completa

En tu PC local, la carpeta `public/build/` debe contener:

```
public/build/
├── manifest.json
├── assets/
│   ├── app-5QzCCB6Y.js
│   ├── app-5QzCCB6Y.js.gz
│   ├── app-5QzCCB6Y.js.br
│   ├── app-Cs7v0JuJ.css
│   ├── app-Cs7v0JuJ.css.gz
│   └── app-Cs7v0JuJ.css.br
```

**Sube toda la carpeta `public/build/`** al servidor en:
`public_html/public/build/`

---

## Solución 2: Verificar en el servidor

Por SSH:

```bash
cd ~/domains/bluedraft.cc/public_html/public
ls -la build/
ls -la build/assets/
```

Debes ver `manifest.json` y los archivos `app-*.js` y `app-*.css`.

---

## Solución 3: APP_URL y ASSET_URL

En el `.env` del servidor:

```env
APP_URL=https://bluedraft.cc
ASSET_URL=https://bluedraft.cc
```

Luego:

```bash
php artisan config:clear
php artisan config:cache
```

---

## Solución 4: Recompilar y subir (si cambiaste código)

En tu PC local:

```bash
npm run build
```

Sube de nuevo la carpeta `public/build/` al servidor.

---

## Solución 5: Panel Filament (admin)

Si solo fallan los estilos del panel admin (`/system-bd-access`), verifica que existan:

```bash
ls -la ~/domains/bluedraft.cc/public_html/public/css/filament/
ls -la ~/domains/bluedraft.cc/public_html/public/js/filament/
```

Si no existen, ejecuta:

```bash
cd ~/domains/bluedraft.cc/public_html
php artisan filament:upgrade
```
