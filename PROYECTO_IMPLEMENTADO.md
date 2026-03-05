# Blue Draft - Documentación del Proyecto

## Índice
1. [Resumen](#resumen)
2. [Tecnologías](#tecnologías)
3. [Estructura del Proyecto](#estructura-del-proyecto)
4. [Funcionalidades Implementadas](#funcionalidades-implementadas)
5. [Base de Datos](#base-de-datos)
6. [Panel de Administración](#panel-de-administración)
7. [Configuración](#configuración)
8. [Comandos Útiles](#comandos-útiles)

> **Documentación de desarrollo:** Ver carpeta [docs/](docs/) — [FASES_IMPLEMENTACION.md](docs/FASES_IMPLEMENTACION.md), [ESTADO_ACTUAL_PROYECTO.md](docs/ESTADO_ACTUAL_PROYECTO.md).

---

## Resumen

**Blue Draft** es una aplicación web para una empresa de construcción que permite gestionar proyectos, cotizaciones y configurar el contenido del sitio de forma dinámica. Incluye un panel de administración con URL discreta, automatización de leads, secuencia de emails, tracking profesional y SEO local multi-ciudad.

---

## Tecnologías

### Backend
| Tecnología | Versión | Uso |
|------------|---------|-----|
| **PHP** | 8.2+ | Lenguaje del servidor |
| **Laravel** | 12.x | Framework PHP |
| **Filament** | 4.0 | Panel de administración |
| **PostgreSQL** | 18 | Base de datos (MySQL compatible) |
| **Livewire** | 3.x | Componentes dinámicos (via Filament) |

### Frontend
| Tecnología | Versión | Uso |
|------------|---------|-----|
| **Vite** | 7.x | Bundler y build tool |
| **Tailwind CSS** | 4.x | Framework CSS |
| **Alpine.js** | 3.x | Interactividad ligera |
| **Blade** | - | Motor de plantillas Laravel |

---

## Funcionalidades Implementadas

### Sitio Público

| Ruta | Descripción |
|------|-------------|
| `GET /` | Página principal (Hero, About, Services, Projects, Testimonials, Quote, Contact) |
| `POST /contact` | Formulario de contacto |
| `POST /quote/partial` | Guardado parcial Step 1 (nombre, email, servicio) |
| `POST /quote/complete` | Completado Step 2 (reCAPTCHA, detalles, fotos) |
| `GET /services` | Redirige a `/#services` (landing) |
| `GET /services/{slug}` | Detalle de servicio (slugs NYC) |
| `GET /construction-company-new-york` | Página pilar NYC |
| `GET /construction-company-{city}` | Páginas pilar distritos (Manhattan, Queens, Brooklyn, Bronx, NJ) |
| `GET /projects/{slug}` | Detalle de proyecto |
| `GET /blog` | Índice del blog |
| `GET /blog/{slug}` | Post individual |
| `GET /free-renovation-guide` | Lead magnet (captura email) |
| `GET /cost-calculator` | Calculadora de costes |
| `GET /sitemap.xml` | Sitemap XML dinámico |

### Panel de Administración (`/system-bd-access`)

| Ruta | Descripción |
|------|-------------|
| `/login` | Login (solo @bluedraft.org y @bluedraft.cc) |
| `/` | Dashboard con pipeline, alertas, top leads |
| `/projects` | CRUD proyectos |
| `/quotes` | CRUD cotizaciones (stages, UTM, asignación) |
| `/posts` | CRUD blog posts |
| Site Settings | Hero, About, Services, Testimonials, Contact, Footer |

### Automatización

- **Secuencia de emails:** 6 correos automáticos (0h, 24h, 3d, 7d, 10d, 14d) vía Laravel Mail
- **Brevo:** Contactos y SMTP cuando `BREVO_API_KEY` configurado
- **Recordatorios:** Leads 24h sin contactar → email admin; Propuestas 5d+ → follow-up
- **Comandos:** `leads:check-followups` (hourly), `quotes:mark-abandoned` (daily)

### Tracking (GTM, GA4, Meta Pixel)

- Eventos: `form_submit`, `phone_click`, `scroll_75_percent`, `time_on_page_30s`, `service_view`, `lead_magnet_view`, `cost_calculator_view`, `calculator_estimate`

### SEO

- Schema: LocalBusiness, Service, FAQ, Breadcrumb, AggregateRating (testimonials)
- Canonical, Open Graph
- Cache headers para CDN (Cloudflare)

---

## Base de Datos

### Tablas principales

| Tabla | Descripción |
|-------|-------------|
| `users` | Usuarios admin |
| `projects` | Proyectos (slug, categoría, imágenes) |
| `services` | Landing pages por servicio |
| `quotes` | Cotizaciones (stages, UTM, lead_score, borough) |
| `quote_attachments` | Adjuntos |
| `posts` | Blog |
| `lead_magnet_subscribers` | Suscriptores lead magnet |
| `quote_email_sequence_log` | Log secuencia emails |
| `settings` | Configuración dinámica |

---

## Configuración

### Variables de entorno (.env)

```env
# Base de datos
DB_CONNECTION=pgsql
DB_DATABASE=blue_draft_pro

# reCAPTCHA (opcional)
RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=

# Email sequence
EMAIL_SEQUENCE_ENABLED=true
BREVO_API_KEY=
BREVO_LIST_ID=

# Tracking
GTM_ID=
GA4_MEASUREMENT_ID=
META_PIXEL_ID=

# Notificaciones
ADMIN_NOTIFICATION_EMAIL=info@bluedraft.cc
```

---

## Comandos Útiles

```bash
composer install
npm install
npm run build

php artisan migrate
php artisan db:seed

php artisan leads:check-followups
php artisan quotes:mark-abandoned
```

---

*Documento actualizado — Blue Draft — Febrero 2026*
