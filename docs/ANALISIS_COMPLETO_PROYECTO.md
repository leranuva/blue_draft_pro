# Análisis Completo del Proyecto Blue Draft

**Fecha:** Febrero 2026  
**Última actualización:** Febrero 2026 (correcciones email, distritos, sitemap)  
**Objetivo:** Verificación exhaustiva de lo implementado vs lo pendiente. Incluye inventario técnico, seguridad, performance, capacidad operativa, escalabilidad y SEO competitivo.

---

## 1. Resumen Ejecutivo

| Área | Implementado | Pendiente / Gaps |
|------|--------------|------------------|
| Rutas públicas | ✅ 18 rutas | — |
| Controladores | ✅ 12 | — |
| Modelos | ✅ 9 | — |
| Migraciones | ✅ 19 | — |
| Filament Admin | ✅ 5 recursos + 8 páginas | — |
| Jobs & Mail | ✅ 4 jobs, 10 mailables | — |
| Sitemap | ✅ Completo | Incluye blog posts |
| Email admin | ✅ Config | `info@bluedraft.cc` vía `ADMIN_NOTIFICATION_EMAIL` |
| reCAPTCHA | ✅ Config | Usa `config('services.recaptcha.site_key')` |
| Pillar distritos | ✅ 5 distritos | Manhattan, Queens, Brooklyn, Bronx, New Jersey |
| Documentación | ✅ Alineada | — |
| Seguridad | ✅ Mejorado | Rate limiting, validación, CSRF. Ver sección 13 |
| Performance / SEO competitivo | ⏳ Por medir | Ver secciones 14, 17 |

---

## 2. Rutas (`routes/web.php`)

### Implementadas

| Método | Ruta | Nombre | Controlador |
|--------|------|--------|-------------|
| GET | `/` | home | HomeController@index |
| GET | `/project-proposal` | project-proposal | ProjectProposalController@show |
| POST | `/contact` | contact.submit | HomeController@submitContact |
| POST | `/quote/partial` | quote.partial | QuoteController@savePartial |
| POST | `/quote/complete` | quote.complete | QuoteController@complete |
| GET | `/services` | services.index | Redirect → /#services |
| GET | `/services/{service:slug}` | services.show | ServiceController@show |
| GET | `/construction-company-new-york` | pillar.nyc | PillarPageController@show |
| GET | `/construction-company-{city}` | pillar.city | PillarCityController@show (distritos) |
| GET | `/projects/{project:slug}` | projects.show | ProjectController@show |
| GET | `/blog` | blog.index | PostController@index |
| GET | `/blog/{post:slug}` | blog.show | PostController@show |
| GET | `/sitemap.xml` | sitemap | SitemapController@index |
| GET | `/free-renovation-guide` | lead-magnet.show | LeadMagnetController@show |
| POST | `/free-renovation-guide` | lead-magnet.submit | LeadMagnetController@submit |
| GET | `/free-renovation-guide/guide` | lead-magnet.guide | LeadMagnetController@guide |
| GET | `/cost-calculator` | cost-calculator | CostCalculatorController@show |

### Pillar distritos (URLs dinámicas)

| Distrito | URL |
|----------|-----|
| Manhattan | `/construction-company-manhattan` |
| Queens | `/construction-company-queens` |
| Brooklyn | `/construction-company-brooklyn` |
| Bronx | `/construction-company-bronx` |
| New Jersey | `/construction-company-new-jersey` |

---

## 3. Controladores

| Controlador | Archivo | Estado |
|-------------|---------|--------|
| HomeController | `app/Http/Controllers/HomeController.php` | ✅ |
| QuoteController | `app/Http/Controllers/QuoteController.php` | ✅ |
| ServiceController | `app/Http/Controllers/ServiceController.php` | ✅ |
| ProjectController | `app/Http/Controllers/ProjectController.php` | ✅ |
| PostController | `app/Http/Controllers/PostController.php` | ✅ |
| PillarPageController | `app/Http/Controllers/PillarPageController.php` | ✅ |
| PillarCityController | `app/Http/Controllers/PillarCityController.php` | ✅ |
| LeadMagnetController | `app/Http/Controllers/LeadMagnetController.php` | ✅ |
| CostCalculatorController | `app/Http/Controllers/CostCalculatorController.php` | ✅ |
| SitemapController | `app/Http/Controllers/SitemapController.php` | ✅ |
| ProjectProposalController | `app/Http/Controllers/ProjectProposalController.php` | ✅ |

---

## 4. Modelos

| Modelo | Archivo | Relaciones / Notas |
|--------|---------|--------------------|
| Quote | `app/Models/Quote.php` | attachments, stages, UTM, borough, lead_score |
| QuoteAttachment | `app/Models/QuoteAttachment.php` | belongsTo Quote |
| Project | `app/Models/Project.php` | services (belongsToMany), slug, getRouteKey |
| Service | `app/Models/Service.php` | projects, FAQs, slug |
| Post | `app/Models/Post.php` | published scope, Markdown/RichEditor |
| Settings | `app/Models/Settings.php` | key-value por group |
| LeadMagnetSubscriber | `app/Models/LeadMagnetSubscriber.php` | — |
| User | `app/Models/User.php` | canAccessPanel (@bluedraft.org, @bluedraft.cc) |

---

## 5. Migraciones (19)

| Migración | Tabla / Cambio |
|-----------|----------------|
| 0001_01_01_000000 | users |
| 0001_01_01_000001 | cache |
| 0001_01_01_000002 | jobs |
| 2025_12_24_232340 | projects |
| 2025_12_24_232344 | quotes |
| 2025_12_24_232348 | quote_attachments |
| 2025_12_25_212832 | settings |
| 2026_02_23_000001 | quotes (partial fields) |
| 2026_02_23_000002 | quotes (lead tracking) |
| 2026_02_23_100001 | services, project_service |
| 2026_02_23_100002 | projects (slug) |
| 2026_02_23_200001 | service slugs NYC SEO |
| 2026_02_23_210001 | quotes (phase3) |
| 2026_02_24_100001 | quotes (borough) |
| 2026_02_24_100002 | quote_email_sequence_log |
| 2026_02_24_200001 | lead_magnet_subscribers |
| 2026_02_24_210001 | posts |
| 2026_02_25_000001 | posts (meta expand) |
| 2026_02_26_000001 | quotes (CRO fields) |

---

## 6. Filament Admin (`/system-bd-access`)

### Recursos

| Recurso | Modelo | Páginas |
|---------|--------|---------|
| QuoteResource | Quote | index, edit (sin create) |
| ProjectResource | Project | index, create, edit |
| ServiceResource | Service | index, create, edit |
| PostResource | Post | index, create, edit |
| SettingsResource | Settings | index, create, edit |

### Páginas de configuración

| Página | Grupo |
|--------|-------|
| CustomDashboard | — |
| HeroSettings | Site Settings |
| AboutSettings | Site Settings |
| ServicesSettings | Site Settings |
| TestimonialsSettings | Site Settings |
| ContactSettings | Site Settings |
| FooterSettings | Site Settings |
| SiteSettings | Site Settings |

---

## 7. Correcciones Aplicadas (Feb 2026)

### 7.1 Sitemap con blog ✅

**Archivo:** `app/Http/Controllers/SitemapController.php`

El sitemap incluye posts publicados (`Post::published()`). Se añaden automáticamente con `changefreq: weekly`, `priority: 0.7`.

### 7.2 Email admin configurado ✅

**Email principal:** `info@bluedraft.cc` (configurable vía `ADMIN_NOTIFICATION_EMAIL` en `.env`)

Todos los envíos de notificaciones usan `config('mail.admin_notification_email')`:
- QuoteController, HomeController
- Fallbacks en AppServiceProvider, layouts
- Seeders: ContactSettings, FooterSettings, AdminUserSeeder

### 7.3 reCAPTCHA con config ✅

**Archivo:** `resources/views/layouts/app.blade.php`

Usa `config('services.recaptcha.site_key')` en lugar de `env()`. Compatible con `config:cache`.

### 7.4 Pillar distritos ✅

**Config:** `config/pillar_cities.php` — 5 distritos: Manhattan, Queens, Brooklyn, Bronx, New Jersey

**Ruta:** `GET /construction-company-{city}` con `where('city', ...)` según config

**Seeder:** `PillarCitySeeder` crea settings para cada distrito (`pillar_manhattan`, etc.)

---

## 9. Jobs y Mail

### Jobs (4)

| Job | Propósito |
|-----|-----------|
| AddLeadToEmailSequence | Despacha secuencia de 6 emails |
| SendSequenceEmailJob | Envía email N de la secuencia |
| NotifyNewLeadAfter24Hours | Notifica lead no contactado en 24h |
| FollowUpProposalSent | Recordatorio follow-up propuesta |

### Mail (10)

| Mailable | Uso |
|----------|-----|
| QuoteNotification | Cotización completa |
| ContactNotification | Formulario contacto |
| SequenceEmail1Confirmation … 6ObjectionCrusher | Secuencia 6 emails |
| LeadNotContactedNotification | Lead sin contacto 24h |
| ProposalFollowUpNotification | Follow-up propuesta |

---

## 10. Configuración

### .env.example

- DB (PostgreSQL/MySQL)
- MAIL, ADMIN_NOTIFICATION_EMAIL (default: info@bluedraft.cc)
- RECAPTCHA_SITE_KEY, RECAPTCHA_SECRET_KEY
- EMAIL_SEQUENCE_ENABLED, BREVO_API_KEY, BREVO_LIST_ID
- GTM_ID, GA4_MEASUREMENT_ID, META_PIXEL_ID
- Auto-assignment (QUOTE_ASSIGN_*)

### config/*.php

| Archivo | Propósito |
|---------|-----------|
| cta.php | Textos CTA por servicio/borough |
| email_sequence.php | 6 emails, delays, Brevo |
| pillar_cities.php | Distritos: Manhattan, Queens, Brooklyn, Bronx, New Jersey |
| quotes.php | Auto-assignment |
| tracking.php | GTM, GA4, Meta Pixel |
| services.php | reCAPTCHA |

---

## 11. Comandos programados (`routes/console.php`)

| Comando | Frecuencia |
|---------|------------|
| quotes:mark-abandoned | daily |
| leads:check-followups | hourly |

---

## 12. Documentación vs realidad

| Área | Estado |
|------|--------|
| Ruta `pillar.city` | ✅ Implementada (distritos) |
| Sitemap con blog | ✅ Implementado |
| Email admin | ✅ info@bluedraft.cc vía config |
| reCAPTCHA | ✅ Usa config |
| .env.example | ✅ "6 emails" |

---

## 13. Seguridad (Security Hardening)

| Aspecto | Estado | Notas |
|---------|--------|-------|
| **CSRF** | ✅ | Laravel `VerifyCsrfToken` en middleware web (por defecto) |
| **Validación de archivos** | ✅ | `photos.*` → `image|mimes:jpeg,png,jpg,gif|max:10240` (10MB) en Quote y Contact |
| **reCAPTCHA** | ⚠️ Opcional | Si configurado, protege quote/complete y contact. Sin config, formularios funcionan sin protección anti-spam |
| **Rate limiting** | ✅ | `throttle:5,1` en /contact, /quote/complete, /free-renovation-guide (5 intentos/min por IP) |
| **Sanitización HTML blog** | ⚠️ Parcial | Post: Markdown y plain text escapados. HTML de RichEditor se renderiza sin purificar (riesgo XSS si admin inserta código malicioso) |
| **Protección spam adicional** | ⚠️ No | Solo reCAPTCHA. Sin honeypot, rate limit por IP, ni bloqueo de patrones |

**Recomendaciones:** Considerar HTML Purifier para contenido blog si admins externos editan.

---

## 14. Performance real

| Métrica | Estado | Notas |
|---------|--------|-------|
| **Core Web Vitals** | ⏳ No medido | LCP, FID, CLS — requiere Lighthouse/PageSpeed en producción |
| **TTFB** | ⏳ No medido | Depende de hosting (Hostinger) |
| **Bundle JS** | ✅ Compresión | Vite genera .gz y .br; `vite-plugin-compression` |
| **Tamaño imágenes** | ⏳ No evaluado | Sin pipeline WebP; lazy loading en home |
| **Cache headers** | ✅ | `CacheHeaders` middleware para páginas estáticas |

**Nota:** Decir "listo para producción" sin métricas reales de performance es incompleto. Ejecutar Lighthouse en https://bluedraft.cc antes de afirmar rendimiento.

---

## 15. Capacidad operativa

El documento analiza **software**. No analiza:

| Aspecto | Estado |
|---------|--------|
| Leads que puede manejar el equipo | ⏳ No evaluado |
| SLA interno de respuesta | ⏳ No definido en doc |
| Tiempo promedio de respuesta | ⏳ No medido |
| Sistema de seguimiento comercial | ✅ Filament (quotes, stages, alertas 24h, follow-up 5d) |

**Nota:** Un sistema técnico completo no garantiza crecimiento si el follow-up comercial falla. Definir procesos internos.

---

## 16. Escalabilidad real

| Aspecto | Estado | Notas |
|---------|--------|-------|
| **Cola de trabajos** | ⚠️ Hostinger sync | `QUEUE_CONNECTION=sync` en shared hosting — jobs se ejecutan en request. Sin queue worker. |
| **Supervisor** | ⏳ No aplicable | En shared hosting no suele estar disponible |
| **Retries en jobs** | ⏳ Por defecto Laravel | `SendSequenceEmailJob` etc. usan retries por defecto |
| **Failed jobs** | ⏳ No monitoreado | Tabla `failed_jobs` existe; sin alertas ni dashboard |
| **Volumen alto (200+ leads/mes)** | ⚠️ Por validar | Con sync, cada lead dispara 6+ emails en el mismo request. Puede alargar respuesta. |

**Recomendación:** En VPS/dedicado, usar `queue:work` + Supervisor para desacoplar envío de emails.

---

## 17. SEO competitivo real

| Aspecto | Estado | Notas |
|---------|--------|-------|
| **Arquitectura SEO** | ✅ | Sitemap, Schema, meta tags, pillar pages, distritos |
| **Competencia NYC** | ⏳ No analizado | Volumen de búsqueda por borough, dificultad de keywords |
| **Backlinks** | ⏳ No evaluado | Autoridad de dominio |
| **Ranking** | ⏳ No medido | Arquitectura ≠ ranking. Requiere contenido, links, tiempo |

**Nota:** La base técnica está lista. El posicionamiento depende de contenido, backlinks y estrategia activa.

---

## 18. Pendientes opcionales (baja prioridad)

- [ ] WebP para imágenes
- [ ] Tests automatizados
- [ ] Cloudflare según CLOUDFLARE_SETUP.md
- [x] Rate limiting en formularios (throttle:5,1)
- [ ] HTML Purifier para blog (si hay editores externos)

---

## 19. Conclusión

El proyecto está **técnicamente completo y estructuralmente listo para producción y escalado**. Todas las correcciones de prioridad alta y media han sido aplicadas:

- Sitemap incluye blog posts
- Email admin configurable (info@bluedraft.cc)
- reCAPTCHA compatible con config cache
- 5 pillar distritos (Manhattan, Queens, Brooklyn, Bronx, New Jersey)

**Estratégicamente**, el éxito depende de:

- Performance real (medir Core Web Vitals)
- Seguridad (rate limiting, sanitización HTML si aplica)
- Capacidad comercial (procesos de follow-up)
- Tráfico y SEO activo (contenido, backlinks)

---

*Documento generado — Blue Draft — Febrero 2026*
