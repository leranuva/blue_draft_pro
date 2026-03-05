# Estado Actual del Proyecto — Blue Draft

**Fecha de actualización:** Febrero 2026  
**Versión:** 1.2.0

Este documento describe el estado completo del proyecto después de las correcciones realizadas.

---

## Resumen Ejecutivo

El proyecto **Blue Draft** está **completamente implementado** según la estrategia de 6 fases. Todas las funcionalidades planificadas están operativas. Las correcciones recientes han resuelto documentación desactualizada, reCAPTCHA opcional, configuración de base de datos y seeders para ciudades pilares.

---

## Estado por Fase

| Fase | Nombre | Estado | Notas |
|------|--------|--------|-------|
| 1 | Fundación de Conversión | ✅ 100% | Formulario 2 pasos, guardado parcial, CTAs, lazy loading |
| 2 | SEO & Estructura Escalable | ✅ 100% | Servicios, proyectos, pilares, sitemap, Schema (incl. AggregateRating) |
| 3 | Automatización Comercial | ✅ 100% | Pipeline, UTM, secuencia emails, recordatorios, Brevo |
| 4 | Tracking & Datos | ✅ 100% | GTM, GA4, Meta Pixel, eventos personalizados |
| 5 | Optimización & Remarketing | ✅ 100% | Lead magnet, calculadora, ViewContent/Lead |
| 6 | Escalado y Dominación Local | ✅ 100% | Pilar NYC, 5 distritos (Manhattan, Queens, Brooklyn, Bronx, NJ), blog, CDN, compresión Vite |

---

## Correcciones Aplicadas (Última Actualización — Feb 2026)

### 1. Email y notificaciones
- **Email principal:** `info@bluedraft.cc` (configurable vía `ADMIN_NOTIFICATION_EMAIL` en `.env`).
- **QuoteController, HomeController:** Usan `config('mail.admin_notification_email')`.
- **AppServiceProvider, layouts:** Fallbacks con config.
- **Seeders:** ContactSettings, FooterSettings, AdminUserSeeder usan info@bluedraft.cc.
- **User model:** `canAccessPanel()` acepta @bluedraft.org y @bluedraft.cc.

### 2. Pillar distritos (SEO local)
- **Config:** `pillar_cities.php` — 5 boroughs con FAQs, building_regulations, context, calculator_borough.
- **Ruta:** `GET /construction-company-{city}` (pillar.city).
- **Secciones:** Hero (2 CTAs), Services, Typical Renovation Costs, Building Regulations, Borough Insights, FAQs (schema FAQPage).
- **Cost Calculator:** Enlace con `?borough=` para pre-selección.
- **PillarCitySeeder:** `php artisan db:seed --class=PillarCitySeeder` — títulos "Apartment Renovation Contractor in [Borough]".

### 3. Sitemap y reCAPTCHA
- **SitemapController:** Incluye posts publicados (`Post::published()`).
- **reCAPTCHA:** Usa `config('services.recaptcha.site_key')` en layouts (compatible con config:cache).

### 4. Documentación y configuración
- **.env.example:** ADMIN_NOTIFICATION_EMAIL=info@bluedraft.cc, comentario "6 emails".
- **config/services.php:** Sección `recaptcha` (site_key, secret).

### 5. Optimizaciones previas
- **vite-plugin-compression:** .gz y .br en build.
- **Schema AggregateRating:** En schema-local-business con testimonials.

---

## Estructura de Archivos Relevante

```
app/
├── Console/Commands/
│   ├── CheckLeadFollowUps.php      # leads:check-followups
│   ├── MarkAbandonedQuotes.php     # quotes:mark-abandoned
│   └── ...
├── Http/Controllers/
│   ├── CostCalculatorController.php
│   ├── LeadMagnetController.php
│   ├── PillarCityController.php
│   ├── PostController.php
│   └── ...
├── Jobs/
│   ├── AddLeadToEmailSequence.php
│   ├── FollowUpProposalSent.php
│   ├── NotifyNewLeadAfter24Hours.php
│   └── SendSequenceEmailJob.php
├── Mail/
│   ├── LeadNotContactedNotification.php
│   ├── ProposalFollowUpNotification.php
│   ├── SequenceEmail1Confirmation.php ... SequenceEmail6ObjectionCrusher.php
│   └── ...
├── Services/
│   └── EmailSequenceService.php
└── ...

config/
├── cost_calculator.php  # Rangos, borough_insights, typical_ranges, timelines_dynamic
├── email_sequence.php
├── pillar_cities.php    # FAQs, building_regulations, calculator_borough
├── services.php        # + recaptcha
└── tracking.php

database/seeders/
├── PillarCitySeeder.php   # Nuevo
└── ...
```

---

## Rutas Públicas

| Método | Ruta | Controlador |
|--------|------|-------------|
| GET | / | HomeController@index |
| POST | /contact | HomeController@submitContact |
| POST | /quote/partial | QuoteController@savePartial |
| POST | /quote/complete | QuoteController@complete |
| GET | /services | Redirect → /#services |
| GET | /services/{slug} | ServiceController@show |
| GET | /construction-company-new-york | PillarPageController@show |
| GET | /construction-company-{city} | PillarCityController@show |
| GET | /projects/{slug} | ProjectController@show |
| GET | /blog | PostController@index |
| GET | /blog/{slug} | PostController@show |
| GET | /free-renovation-guide | LeadMagnetController@show |
| POST | /free-renovation-guide | LeadMagnetController@submit |
| GET | /free-renovation-guide/guide | LeadMagnetController@guide |
| GET | /cost-calculator | CostCalculatorController@show (soporta ?borough=manhattan) |
| GET | /sitemap.xml | SitemapController@index |

---

## Comandos Programados (Cron)

```php
// routes/console.php
Schedule::command('quotes:mark-abandoned')->daily();
Schedule::command('leads:check-followups')->hourly();
```

---

## Configuración Requerida para Producción

1. **Base de datos:** PostgreSQL (o MySQL con `DB_CONNECTION=mysql`).
2. **reCAPTCHA:** Opcional; si no se configura, formularios funcionan sin protección anti-spam.
3. **Email:** SMTP en `.env` para notificaciones y secuencia.
4. **Brevo:** `BREVO_API_KEY` y `BREVO_LIST_ID` para contactos y SMTP alternativo.
5. **Tracking:** `GTM_ID` o `GA4_MEASUREMENT_ID` + `META_PIXEL_ID`.
6. **Cola:** `php artisan queue:work` (o Supervisor) para jobs.
7. **Cron:** `* * * * * php artisan schedule:run` para comandos programados.

---

## Mejoras Recientes (v1.2+)

- **Cost Calculator v2.1:** Contexto mercado, timeline dinámico, borough insights, proyecto similar, disclaimer, scoring dinámico (+2 whole_house, +1 commercial, etc.).
- **Páginas pilar:** Typical Costs, Building Regulations, Borough Insights, FAQs con schema, enlace calculadora con ?borough=.
- **Documentación:** [COST_CALCULATOR.md](COST_CALCULATOR.md), [PILAR_POR_DISTRITO_GUIA.md](PILAR_POR_DISTRITO_GUIA.md).

## Próximos Pasos Opcionales

- Publicar 2+ artículos/mes en el blog (los posts se incluyen automáticamente en el sitemap).
- Configurar Cloudflare siguiendo `docs/CLOUDFLARE_SETUP.md`.
- Pipeline de conversión de imágenes a WebP (requiere más desarrollo).

---

*Documento generado — Blue Draft — Febrero 2026*
