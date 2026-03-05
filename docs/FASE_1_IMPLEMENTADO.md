# Fase 1 — Fundación de Conversión (Implementado)

Resumen de los cambios realizados en la **Fase 1** de la estrategia de mejora.

---

## 1. Rediseño del Home

| Implementado | Dónde verlo |
|--------------|-------------|
| **Sección "How It Works"** (proceso en 4 pasos) | Entre Services y Testimonials |
| **Sección "100% Satisfaction Guarantee"** | Después del proceso, con CTA |
| **CTAs entre secciones** | Botones "Get Free Estimate" tras Projects, Services y Process |
| **Hero más directo** | Subtitle configurable (ej: "Free Estimates. On-Time Delivery. Guaranteed Quality.") |

**Archivos:** `resources/views/home.blade.php`, `app/Filament/Pages/HeroSettings.php`, `app/Http/Controllers/HomeController.php`

---

## 2. Formulario Quote simplificado (2 pasos)

| Paso | Campos |
|------|--------|
| **Paso 1** | Nombre, Email, Tipo de servicio (residential/commercial/renovation/other) |
| **Paso 2** | Teléfono, Dirección, Presupuesto (select), Mensaje, Fotos (opcional) |

- **Auto-guardado Step 1 (CRÍTICO):** Al completar el paso 1 se guarda en DB con `is_partial=true`. Si el usuario abandona, el lead se recupera.
- Validación: no se puede avanzar sin nombre, email y servicio
- reCAPTCHA en el paso 2
- Envío a `POST /quote/complete`

**Rutas:** `POST /quote/partial` (AJAX), `POST /quote/complete` (form submit)

**Archivos:** `resources/views/home.blade.php`, `app/Http/Controllers/QuoteController.php`, `app/Models/Quote.php`

---

## 3. Microcopy estratégica

Debajo del botón "Submit Request":
- "We usually respond in under 24 hours"
- "No obligation, completely free"

**Archivo:** `resources/views/home.blade.php`

---

## 4. Prueba social más agresiva

En la sección Testimonials se muestra:
- **X proyectos completados** (configurable en About Settings)
- **X años en el negocio** (configurable)
- **X/5 rating promedio** (nuevo campo `about_stat_rating`)

**Archivos:** `resources/views/home.blade.php`, `app/Filament/Pages/AboutSettings.php`, `app/Http/Controllers/HomeController.php`, `database/seeders/AboutSettingsSeeder.php`

---

## 5. CTAs omnipresentes

| Elemento | Descripción |
|----------|-------------|
| **Barra sticky móvil** | "Get Free Estimate" fija abajo en móvil, enlaza a `#quote` |
| **Botón WhatsApp** | Botón verde flotante (abajo derecha), configurable en Filament |
| **Widget flotante desktop** | Panel "Need Help?" con enlaces a Quote y Contact (solo desktop, oculto en móvil) |
| **Click-to-call** | Enlaces `tel:` en hero y en Contact |

**Archivos:** `resources/views/layouts/app.blade.php`, `app/Filament/Pages/ContactSettings.php`, `app/Http/Controllers/HomeController.php`

---

## 6. Optimización de velocidad

| Implementado | Detalle |
|--------------|---------|
| **Lazy loading** | `loading="lazy"` en imágenes de About y Projects (no en Hero) |

**Archivo:** `resources/views/home.blade.php`

---

## 7. Base de datos — Quotes parciales y tracking

**Migraciones:** `2026_02_23_000001_add_partial_fields_to_quotes_table.php`, `2026_02_23_000002_add_lead_tracking_to_quotes_table.php`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `is_partial` | boolean | true = solo Step 1, false = completado |
| `step` | integer nullable | 1 o 2 |
| `lead_score` | integer | 0–8. Reglas: Presupuesto alto +3, Comercial +2, Fotos +2, Mensaje >200 chars +1 |
| `abandoned_at` | timestamp nullable | Marcado por cron si is_partial y 24h sin completar |
| `source_url` | string nullable | Referer (URL de origen) |
| `user_agent` | string nullable | User-Agent del navegador |
| `ip_address` | string nullable | IP del visitante |

**Lead Score:** `Quote::calculateLeadScore()` — Presupuesto alto (50k-100k, over-100k) +3, Comercial +2, Adjunta fotos +2, Mensaje >200 chars +1.

**Command:** `php artisan quotes:mark-abandoned` — ejecuta diariamente (Schedule). Marca `abandoned_at` en quotes parciales con más de 24h.

**Panel Filament:** Orden por `lead_score` desc, columnas Score, Partial, Abandoned, filtros.

---

## Archivos modificados (resumen)

| Archivo | Cambios |
|---------|---------|
| `resources/views/home.blade.php` | Process, Guarantee, CTAs, formulario 2 pasos con auto-guardado, microcopy, prueba social, lazy loading, success message |
| `resources/views/layouts/app.blade.php` | Sticky CTA móvil, WhatsApp, widget flotante |
| `app/Http/Controllers/QuoteController.php` | **Nuevo** — savePartial, complete |
| `app/Http/Controllers/HomeController.php` | hero_subtitle, about stat_rating |
| `app/Models/Quote.php` | is_partial, step en fillable y casts |
| `app/Filament/Pages/ContactSettings.php` | Campo contact_whatsapp |
| `app/Filament/Pages/HeroSettings.php` | Campo hero_subtitle |
| `app/Filament/Pages/AboutSettings.php` | Campo about_stat_rating |
| `app/Filament/Resources/Quotes/*` | is_partial, step en form y table, filtro |
| `routes/web.php` | quote.partial, quote.complete |
| `database/migrations/2026_02_23_*` | add_partial_fields_to_quotes |
| `database/seeders/*` | hero_subtitle, about_stat_rating |

---

## Pendiente (Fase 1)

- Conversión de imágenes a WebP (spatie/laravel-image-optimizer o Intervention Image)
- Compresión Vite en build (minify ya activo en producción)
- Métricas: visitas, conversión, abandono Step 1 (requiere Analytics — Fase 4)

---

## KPIs objetivo al cerrar Fase 1

| Métrica | Objetivo mínimo |
|---------|-----------------|
| Conversión visita → lead | 3–7% |
| Conversión móvil | 2–5% |
| Abandono Step 1 | < 40% |

---

*Fase 1 — docs/ — Febrero 2025*
