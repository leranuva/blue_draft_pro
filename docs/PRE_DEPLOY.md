# ⚡ Pre-Deploy — Pasos Antes de Subir a Hostinger

Ejecuta estos pasos **localmente** antes de subir el proyecto.

---

## 1. Compilar assets

```bash
npm run build
```

Verifica que existan:
- `public/build/manifest.json`
- `public/build/assets/*.js`
- `public/build/assets/*.css`

---

## 2. Verificar que no hay errores

```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan migrate:status
```

---

## 3. Probar en local (opcional)

```bash
php artisan serve
# Visitar http://localhost:8000
# Probar formularios, panel admin
```

---

## 4. Preparar .env para el servidor

- Usa `.env.hostinger.example` como plantilla
- En el servidor, crea `.env` con los datos reales (BD, email, dominio)
- **Nunca** subas tu `.env` local

---

## 5. Commit y push (si usas Git)

```bash
git add .
git status   # Verificar que public/build/ está incluido
git commit -m "Prepare for Hostinger deployment"
git push origin main
```

---

## 6. Listo para subir

Sigue la guía completa: [DEPLOYMENT_HOSTINGER.md](DEPLOYMENT_HOSTINGER.md)
