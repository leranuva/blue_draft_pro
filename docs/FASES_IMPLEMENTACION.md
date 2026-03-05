# Documentación de Fases de Implementación — Blue Draft

Este documento registra el estado de implementación de cada fase definida en la estrategia de mejora del proyecto.

**Referencia:** `docs/estrategia_mejora_proyecto.md`

---

## Resumen de Estado

| Fase | Nombre | Estado | Progreso |
|------|--------|--------|----------|
| 1 | Fundación de Conversión | ✅ Completada | 100% |
| 2 | SEO & Estructura Escalable | ✅ Completada | 100% |
| 3 | Automatización Comercial | ✅ Completada | 100% |
| 4 | Tracking & Datos | ✅ Completada | 100% |
| 5 | Optimización & Remarketing | ✅ Completada | 100% |
| 6 | Escalado y Dominación Local | ✅ Completada | 100% |

---

## FASE 1 — Fundación de Conversión

**Objetivo:** Mejorar conversión inmediata sin cambiar arquitectura profunda.  
**Plazo estimado:** Semana 1–2

### 1️⃣ Rediseño estratégico del Home

| Item | Estado | Descripción |
|------|--------|-------------|
| Propuesta de valor clara en hero | ✅ | Hero configurable desde Filament (HeroSettings) con título, descripción, badge, CTA |
| CTA visible arriba | ✅ | Botón "Get Free Quote" en navbar + CTA principal en hero |
| Casos reales con resultados | ✅ | Sección Projects con slider before/after y Testimonials |
| Sección proceso en 4 pasos | ✅ | "How It Works" entre Services y Testimonials |
| Garantía fuerte | ✅ | Sección "100% Satisfaction Guarantee" con CTA |
| CTA repetido cada 2 secciones | ✅ | CTAs tras Projects, Services y Process |

**Archivos modificados:**
- `resources/views/home.blade.php` — Secciones Process, Guarantee, CTAs intermedios

---

### 2️⃣ Simplificar formulario Quote

| Item | Estado | Descripción |
|------|--------|-------------|
| Formulario en 2 pasos | ✅ | Paso 1: Nombre, Email, Tipo de servicio. Paso 2: Teléfono, Dirección, Presupuesto, Mensaje, Fotos |
| Validación por paso | ✅ | Paso 1 requiere nombre, email y servicio para continuar |
| Guardado provisional en DB | ✅ | Paso 1 → quote.partial (QuoteController::savePartial), Step 2 → quote.complete |

**Implementación actual:**
- Alpine.js multi-step (sin Livewire)
- Paso 1: `name`, `email`, `service` (required)
- Paso 2: `phone`, `address`, `budget` (select), `message`, `photos[]`
- reCAPTCHA en paso 2
- Paso 1: POST a `quote.partial` (guardado parcial). Paso 2: POST a `quote.complete` (completado)

**Archivos modificados:**
- `resources/views/home.blade.php` — Formulario quote (líneas ~520–775)

---

### 3️⃣ CTA omnipresente

| Item | Estado | Descripción |
|------|--------|-------------|
| Botón fijo "Get Free Estimate" | ✅ | Barra sticky en móvil (bottom), widget flotante en desktop |
| Botón WhatsApp flotante | ✅ | Botón verde fijo (bottom-right), configurable desde Contact Settings |
| Click-to-call móvil | ✅ | Enlace `tel:` en hero y en sección Contact |

**Archivos modificados:**
- `resources/views/layouts/app.blade.php` — Sticky bar móvil, WhatsApp, widget flotante
- `app/Filament/Pages/ContactSettings.php` — Campo `contact_whatsapp`
- `app/Http/Controllers/HomeController.php` — Pasa `whatsapp` en array `$contact`
- `database/seeders/ContactSettingsSeeder.php` — Seeder para `contact_whatsapp`

**Configuración:**
- WhatsApp: Filament → Site Settings → Contact Settings → `contact_whatsapp` (número sin espacios/guiones)
- Fallback: `13476366128`

---

### 4️⃣ Optimización básica de velocidad

| Item | Estado | Descripción |
|------|--------|-------------|
| Lazy loading imágenes | ✅ | `loading="lazy"` en About, Projects (before/after y cards) |
| Convertir imágenes a WebP | ⏳ | Opcional — requiere pipeline de subida/conversión |
| Compresión Vite | ✅ | Plugin `vite-plugin-compression` en build de producción |

**Imágenes con lazy loading:**
- `resources/views/home.blade.php`: About image, project images (slider y cards)
- Hero: sin lazy (above the fold)

**Archivos modificados:**
- `resources/views/home.blade.php` — Atributo `loading="lazy"` en `<img>`

---

### Resumen Fase 1 — Archivos tocados

> **Detalle completo:** Ver [FASE_1_IMPLEMENTADO.md](FASE_1_IMPLEMENTADO.md)

| Archivo | Cambios |
|---------|---------|
| `resources/views/home.blade.php` | Process, Guarantee, CTAs, formulario 2 pasos, lazy loading |
| `resources/views/layouts/app.blade.php` | Sticky CTA móvil, WhatsApp, widget flotante, fallback `$hero` |
| `app/Filament/Pages/ContactSettings.php` | Campo `contact_whatsapp` |
| `app/Http/Controllers/HomeController.php` | `whatsapp` en `$contact` |
| `database/seeders/ContactSettingsSeeder.php` | `contact_whatsapp` en seeder |

---

## FASE 2 — SEO & Estructura Escalable

**Objetivo:** Que Google trabaje para ti.  
**Plazo estimado:** Semana 3–5

### 1️⃣ Landing Pages por servicio

| Item | Estado | Descripción |
|------|--------|-------------|
| Tabla `services` | ✅ | id, title, slug, hero_title, hero_subtitle, seo_title, seo_description, content, faq_json, is_active |
| Ruta `/services/{slug}` | ✅ | Páginas dinámicas por servicio (slugs NYC: kitchen-remodeling-new-york, etc.) |
| Contenido 1200–2000 palabras | ⏳ | Por landing (editable en Filament) |
| FAQs por servicio | ✅ | Campo `faq_json` |
| Proyectos relacionados | ✅ | Relación services ↔ projects |
| Internal linking | ✅ | 2 servicios relacionados, 2 proyectos, pilar NYC por landing |

### 2️⃣ Página pilar NYC

| Item | Estado | Descripción |
|------|--------|-------------|
| Ruta `/construction-company-new-york` | ✅ | Página pilar para SEO local NYC |
| Enlaces a servicios y proyectos | ✅ | Grid de servicios, grid de proyectos |
| Menciones boroughs | ✅ | Manhattan, Brooklyn, Queens, Bronx, Staten Island |

### 3️⃣ Proyectos con slug SEO

| Item | Estado | Descripción |
|------|--------|-------------|
| Ruta `/projects/{slug}` | ✅ | Página individual por proyecto |
| Internal linking | ✅ | 2 servicios, pilar NYC |
| Antes/después | ✅ | Slider before/after en página de proyecto |
| Optimización por borough en slug | ⏳ | Sugerencia: luxury-kitchen-remodel-manhattan-loft |

### 4️⃣ Sitemap automático

| Item | Estado | Descripción |
|------|--------|-------------|
| Generación dinámica | ✅ | Home, pillar NYC, servicios, proyectos |

### 5️⃣ Schema Markup (JSON-LD)

| Item | Estado | Descripción |
|------|--------|-------------|
| LocalBusiness | ✅ | En layout cuando existe `$contact` |
| Service | ✅ | En páginas de servicio |
| FAQ | ✅ | En páginas de servicio con FAQs |
| Breadcrumb | ✅ | En pilar, servicios y proyectos |
| Review | ✅ | Schema AggregateRating en schema-local-business (testimonials) |

### 6️⃣ SEO técnico

| Item | Estado | Descripción |
|------|--------|-------------|
| Canonical tags | ✅ | En pilar, servicios y proyectos |
| Open Graph | ✅ | og:title, og:description, og:url, og:image, og:type |

---

## FASE 3 — Automatización Comercial

**Objetivo:** Que cada lead entre en un sistema de seguimiento.  
**Plazo estimado:** Semana 6–8

> **Detalle completo:** Ver [FASE_3_IMPLEMENTADO.md](FASE_3_IMPLEMENTADO.md)

### 1️⃣ Mejorar modelo Quote

| Item | Estado | Descripción |
|------|--------|-------------|
| Campos UTM / lead_source | ✅ | lead_source, utm_source, utm_medium, utm_campaign |
| Stages avanzados | ✅ | new, contacted, qualified, proposal_sent, won, lost |
| Campos de seguimiento | ✅ | last_contacted_at, assigned_to |

### 2️⃣ Secuencia automática de emails

| Item | Estado | Descripción |
|------|--------|-------------|
| Estructura config/servicio | ✅ | config/email_sequence.php, EmailSequenceService (placeholder) |
| Job AddLeadToEmailSequence | ✅ | Se despacha al completar quote |
| Integración Brevo API | ✅ | Contactos y SMTP vía Brevo cuando BREVO_API_KEY configurado |
| Flujo 4 emails | ✅ | Inmediato, 24h, 3 días, 7 días (Laravel Mail + SendSequenceEmailJob) |

### 3️⃣ Recordatorios internos

| Item | Estado | Descripción |
|------|--------|-------------|
| Laravel Jobs | ✅ | NotifyNewLeadAfter24Hours, FollowUpProposalSent |
| Comando leads:check-followups | ✅ | Programado hourly |
| Notificaciones reales (email/Slack) | ✅ | LeadNotContactedNotification, ProposalFollowUpNotification |

---

## FASE 4 — Tracking Profesional

**Objetivo:** Medir todo.  
**Plazo estimado:** Semana 9

> **Detalle completo:** Ver [FASE_4_IMPLEMENTADO.md](FASE_4_IMPLEMENTADO.md)

| Item | Estado | Descripción |
|------|--------|-------------|
| Google Analytics 4 | ✅ | GA4 directo o vía GTM |
| Eventos: form submit, phone click, scroll 75%, time 30s, service view | ✅ | dataLayer + gtag/fbq |
| Google Tag Manager | ✅ | Contenedor opcional |
| Meta Pixel | ✅ | Lead, Contact, ViewContent |

---

## FASE 5 — Optimización y Remarketing

**Objetivo:** Convertir tráfico que no compró.  
**Plazo estimado:** Semana 10–12

> **Detalle completo:** Ver [FASE_5_IMPLEMENTADO.md](FASE_5_IMPLEMENTADO.md)

| Item | Estado | Descripción |
|------|--------|-------------|
| Campañas remarketing | ✅ | ViewContent en servicios, lead magnet, cost calculator; audiencias en Meta Ads |
| Lead Magnet `/free-renovation-guide` | ✅ | Captura email, guía en HTML, integración secuencia emails |
| Calculadora `/cost-calculator` | ✅ | Alpine.js: sq ft, tipo, rango estimado NYC |

---

## FASE 6 — Escalado

**Objetivo:** Sistema autosuficiente.  
**Plazo estimado:** Mes 4+

| Item | Estado | Descripción |
|------|--------|-------------|
| SEO Local NYC | ✅ | Página pilar `/construction-company-new-york`, slugs con ubicación en servicios |
| SEO Local distritos | ✅ | 5 distritos activos: Manhattan, Queens, Brooklyn, Bronx, New Jersey |
| Blog estratégico | ✅ | Blog en `/blog`, Filament PostResource, 2 artículos/mes mínimo |
| CDN (Cloudflare) | ✅ | Cache headers middleware, documentación `docs/CLOUDFLARE_SETUP.md` |

---

## Cronograma de referencia

| Mes | Objetivo |
|-----|----------|
| 1 | Conversión base + SEO estructura |
| 2 | Automatización + tracking |
| 3 | Remarketing + lead magnets |
| 4 | Escalado local + blog |
| 5–6 | Optimización basada en datos |

---

*Documento actualizado — Blue Draft — Febrero 2026*
