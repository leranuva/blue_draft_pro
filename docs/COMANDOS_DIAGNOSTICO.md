# Comandos de Diagnóstico — Blue Draft

Comandos de consola para verificación y diagnóstico del proyecto.

---

## Comandos de Automatización (producción)

| Comando | Propósito | Programación |
|---------|-----------|--------------|
| `php artisan leads:check-followups` | Verifica leads sin contactar 24h y propuestas pendientes 5d+ | Hourly (cron) |
| `php artisan quotes:mark-abandoned` | Marca cotizaciones parciales abandonadas | Daily (cron) |

---

## Comandos de Diagnóstico

### images:test-urls

Verifica que las URLs de imágenes de proyectos y el enlace simbólico de storage funcionen correctamente.

```bash
php artisan images:test-urls
```

**Uso:** Diagnóstico cuando las imágenes no se muestran en el sitio.

---

### projects:check

Verifica proyectos en la base de datos, existencia de imágenes en storage y coherencia de datos.

```bash
php artisan projects:check
```

**Uso:** Diagnóstico de proyectos y storage antes/después de migraciones o cambios.

---

## Otros Comandos Útiles

```bash
# Limpiar caché
php artisan optimize:clear

# Ver rutas
php artisan route:list

# Ver cola de trabajos
php artisan queue:work --once

# Ejecutar programador manualmente
php artisan schedule:run
```

---

*Documento — Blue Draft — Febrero 2026*
