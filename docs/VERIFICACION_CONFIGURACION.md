# Verificación de Configuración — Blue Draft

**Última verificación:** Febrero 2025

---

## Estado General

| Componente | Estado | Notas |
|------------|--------|-------|
| Migraciones | OK | 17 migraciones ejecutadas |
| Rutas | OK | 49 rutas registradas |
| Storage link | OK | `public/storage` → `storage/app/public` |
| Middleware | OK | CaptureUtmParams, CacheHeaders |
| Configuración | OK | tracking, email_sequence, services.recaptcha |

---

## Correcciones Aplicadas

1. **APP_URL:** Actualizado a `http://127.0.0.1:8000` para desarrollo local (imágenes y assets).
2. **URLs de imágenes:** Post y Project usan `url('storage/...')` en lugar de `Storage::url()` para compatibilidad con host/puerto.
3. **Variables .env:** Añadidas ADMIN_NOTIFICATION_EMAIL, reCAPTCHA, EMAIL_SEQUENCE, BREVO, TRACKING (valores por defecto o vacíos).

---

## Variables de Entorno Requeridas

### Esenciales (ya configuradas)
- `APP_KEY` — Generada
- `APP_URL` — http://127.0.0.1:8000 (local) / https://tudominio.com (producción)
- `DB_*` — PostgreSQL configurado

### Opcionales (para producción)
- `RECAPTCHA_SITE_KEY` / `RECAPTCHA_SECRET_KEY` — Protección formularios
- `BREVO_API_KEY` / `BREVO_LIST_ID` — Secuencia de emails y contactos
- `GTM_ID` o `GA4_MEASUREMENT_ID` + `META_PIXEL_ID` — Tracking
- `MAIL_*` — SMTP para envío real de emails
- `ADMIN_NOTIFICATION_EMAIL` — Destino notificaciones internas

---

## Comandos de Verificación

```bash
# Estado migraciones
php artisan migrate:status

# Rutas
php artisan route:list

# Configuración
php artisan config:clear
php artisan about

# Storage link (si falta)
php artisan storage:link
```

---

## Checklist Pre-Despliegue

- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL` = dominio real
- [ ] SMTP configurado
- [ ] reCAPTCHA configurado
- [ ] Queue worker en ejecución
- [ ] Cron para `schedule:run`
- [ ] `php artisan storage:link`

---

*Documento de verificación — Blue Draft*
