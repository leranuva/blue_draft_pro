# Fase 5 — Optimización y Remarketing (Implementado)

Resumen de los cambios realizados en la **Fase 5**.

---

## 1. Lead Magnet — Free Renovation Guide

### Rutas
- `GET /free-renovation-guide` — Página de captura de email
- `POST /free-renovation-guide` — Envío del formulario
- `GET /free-renovation-guide/guide` — Contenido de la guía (tras captura)

### Flujo
1. Usuario visita `/free-renovation-guide`
2. Introduce email (y opcionalmente nombre)
3. Submit → se guarda en `lead_magnet_subscribers` y se crea `Quote` con `lead_source=lead_magnet_free_guide`
4. Si es nuevo: se añade a la secuencia de emails (AddLeadToEmailSequence)
5. Redirect a `/free-renovation-guide/guide` con la guía en HTML
6. Acceso a la guía protegido por sesión (solo tras captura)

### Modelo y migración
- `LeadMagnetSubscriber`: email, name, downloaded_at
- Tabla: `lead_magnet_subscribers`

### Archivos
| Archivo | Descripción |
|---------|-------------|
| `app/Models/LeadMagnetSubscriber.php` | Modelo |
| `app/Http/Controllers/LeadMagnetController.php` | Controlador |
| `database/migrations/..._create_lead_magnet_subscribers_table.php` | Migración |
| `resources/views/pages/lead-magnet.blade.php` | Formulario de captura |
| `resources/views/pages/lead-magnet-guide.blade.php` | Contenido de la guía |

---

## 2. Calculadora de Costes

### Ruta
- `GET /cost-calculator`

### Funcionalidad
- Input: metros cuadrados (sq ft), tipo de remodelación
- Tipos: Kitchen, Bathroom, Basement, Whole House, Commercial
- Salida: rango estimado en USD (min–max)
- Implementado con Alpine.js (sin Livewire)

### Rangos de precio por sq ft (NYC)
| Tipo | Min $/sqft | Max $/sqft |
|------|------------|------------|
| Kitchen | 150 | 350 |
| Bathroom | 100 | 250 |
| Basement | 50 | 150 |
| Whole House | 80 | 200 |
| Commercial | 60 | 180 |

### Archivos
| Archivo | Descripción |
|---------|-------------|
| `app/Http/Controllers/CostCalculatorController.php` | Controlador |
| `resources/views/pages/cost-calculator.blade.php` | Vista con Alpine.js |

---

## 3. Remarketing y Tracking

### Eventos añadidos
| Evento | Cuándo | dataLayer | Meta Pixel |
|--------|--------|-----------|------------|
| `lead_magnet_view` | Visita `/free-renovation-guide` | ✓ | ViewContent |
| `cost_calculator_view` | Visita `/cost-calculator` | ✓ | ViewContent |
| `form_submit` (form_type: lead_magnet) | Submit formulario lead magnet | ✓ | Lead |
| `calculator_estimate` | Usuario obtiene estimación | ✓ | — |

### Audiencias para Meta Ads
El Meta Pixel ya envía:
- **PageView** en todas las páginas
- **ViewContent** en: servicios, lead magnet, cost calculator
- **Lead** en: quote, contact, lead magnet
- **Contact** en: click tel:

**Crear audiencias en Meta Ads Manager:**
1. Audiences → Create Custom Audience → Website
2. **Remarketing servicios sin conversión:** Visitó URL que contiene `/services/` Y NO realizó evento Lead
3. **Visitantes lead magnet:** Visitó URL que contiene `free-renovation-guide` Y NO Lead
4. **Visitantes calculadora:** Visitó URL que contiene `cost-calculator` Y NO Lead

---

## 4. Sitemap y Navegación

- `/free-renovation-guide` y `/cost-calculator` añadidos al sitemap.xml
- Enlaces en footer (Quick Links): Free Renovation Guide, Cost Calculator
- Enlace cruzado: calculadora → lead magnet

---

## 5. Archivos modificados/creados

| Archivo | Cambios |
|---------|---------|
| `routes/web.php` | Rutas lead-magnet, cost-calculator |
| `app/Http/Controllers/LeadMagnetController.php` | Nuevo |
| `app/Http/Controllers/CostCalculatorController.php` | Nuevo |
| `app/Models/LeadMagnetSubscriber.php` | Nuevo |
| `database/migrations/..._create_lead_magnet_subscribers_table.php` | Nuevo |
| `resources/views/pages/lead-magnet.blade.php` | Nuevo |
| `resources/views/pages/lead-magnet-guide.blade.php` | Nuevo |
| `resources/views/pages/cost-calculator.blade.php` | Nuevo |
| `resources/js/tracking.js` | lead_magnet_view, cost_calculator_view, form_type lead_magnet, calculator_estimate |
| `app/Http/Controllers/SitemapController.php` | URLs lead-magnet y cost-calculator |
| `resources/views/layouts/app.blade.php` | Enlaces footer |

---

## 6. Migración

```bash
php artisan migrate
```

Crea la tabla `lead_magnet_subscribers`.

---

*Fase 5 — docs/ — Febrero 2025*
