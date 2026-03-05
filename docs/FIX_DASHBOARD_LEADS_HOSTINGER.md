# 🔧 Dashboard no muestra leads — Hostinger

Si el dashboard muestra ceros pero tienes leads en la base de datos, sigue estos pasos.

---

## Causa más probable

Las migraciones no se ejecutaron tras subir la actualización, o la columna `stage` no existe o tiene valores NULL en los leads.

---

## Solución (ejecutar en el servidor por SSH o Terminal)

### Paso 1 — Ejecutar migraciones

```bash
cd ~/domains/tudominio.com/public_html
# o: cd ~/public_html

php artisan migrate --force
```

Esto crea/actualiza las columnas necesarias (`stage`, `is_partial`, etc.) y rellena `stage` en los leads existentes.

### Paso 2 — Limpiar caché

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Paso 3 — Verificar en la base de datos

Si tienes acceso a phpMyAdmin o similar, revisa la tabla `quotes`:

- Debe existir la columna `stage`
- Los 3 leads deben tener `stage = 'new'` (o contacted, qualified, etc.)
- La columna `is_partial` debe existir (`0` = completo, `1` = solo paso 1)

### Paso 4 — Si sigue sin funcionar: backfill manual

Si las migraciones ya estaban ejecutadas pero los leads tienen `stage` NULL:

```bash
php artisan tinker
```

Dentro de tinker:

```php
\DB::table('quotes')->whereNull('stage')->orWhere('stage', '')->update(['stage' => 'new']);
exit
```

---

## Verificación rápida

1. Entra al panel: `/system-bd-access`
2. Ve a **Quotes** (Cotizaciones)
3. ¿Ves los 3 leads? Si sí, el problema es solo el dashboard.
4. Edita un lead y verifica que el campo **Stage** exista y tenga valor (New, Contacted, etc.)
5. Si no existe el campo Stage, las migraciones no se han ejecutado.

---

## Checklist

- [ ] `php artisan migrate --force` ejecutado
- [ ] `php artisan optimize:clear` ejecutado
- [ ] Columna `stage` existe en tabla `quotes`
- [ ] Los leads tienen `stage` con valor (no NULL)
- [ ] Refrescar el dashboard (Ctrl+F5 o Cmd+Shift+R)
