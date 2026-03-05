# Blue Draft — Expert Construction Solutions

Sitio web corporativo para Blue Draft Construction Company (NYC), desarrollado con Laravel 12, Filament 4 y optimizado para conversión, SEO local y automatización de leads.

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=flat-square&logo=tailwind-css)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=flat-square&logo=alpine.js)
![Filament](https://img.shields.io/badge/Filament-4.0-FFB02B?style=flat-square&logo=filament)

## 📋 Descripción

**Blue Draft** es una aplicación web completa para una empresa de construcción en Nueva York. Incluye:

- **Landing page** con secciones: Hero, About, Projects, Services, Process, Testimonials, Quote, Contact
- **Blog** independiente en `/blog` con soporte Markdown y RichEditor
- **Servicios** integrados en la landing (`/#services`); detalle por slug en `/services/{slug}`
- **Automatización**: secuencia de 6 emails, recordatorios de leads sin contactar, follow-up de propuestas
- **Tracking**: GTM, GA4, Meta Pixel con eventos personalizados
- **CRO**: CTAs contextuales, lead scoring, prefill desde calculadora, dashboard de conversión
- **Panel Filament** con pipeline de cotizaciones, gestión de proyectos, servicios, posts y settings

> **Documentación detallada:** Ver [docs/DOCUMENTACION_COMPLETA.md](docs/DOCUMENTACION_COMPLETA.md) — Guía de todo lo implementado y usos recomendados. También: [ESTADO_ACTUAL_PROYECTO.md](docs/ESTADO_ACTUAL_PROYECTO.md), [FASES_IMPLEMENTACION.md](docs/FASES_IMPLEMENTACION.md), [PROYECTO_IMPLEMENTADO.md](PROYECTO_IMPLEMENTADO.md)

---

## ✨ Características Principales

### 🏠 Sitio Público

| Ruta | Descripción |
|------|-------------|
| `GET /` | Landing page (Hero, About, Projects, Services, Process, Testimonials, Quote, Contact) |
| `GET /services` | Redirige a `/#services` |
| `GET /services/{slug}` | Detalle de servicio (kitchen-remodeling-new-york, etc.) |
| `GET /blog` | Índice del blog |
| `GET /blog/{slug}` | Post individual |
| `GET /projects/{slug}` | Detalle de proyecto |
| `GET /construction-company-new-york` | Página pilar NYC |
| `GET /free-renovation-guide` | Lead magnet (captura email) |
| `GET /cost-calculator` | Calculadora de costes NYC |
| `GET /sitemap.xml` | Sitemap XML dinámico |

### 🛡️ Panel de Administración (`/system-bd-access`)

- **Dashboard** con métricas de funnel (parcial→completo, completo→proposal, etc.)
- **Quotes** con pipeline (new, contacted, qualified, proposal_sent, won, lost), lead score (Cold/Warm/Hot), UTM
- **Projects** con slug, categoría, imágenes antes/después
- **Services** con FAQs, CTA personalizado, proyectos relacionados
- **Posts** con RichEditor, Markdown auto-render, SEO
- **Site Settings** (Hero, About, Services, Testimonials, Contact, Footer)

### ⚡ Automatización

- **Secuencia de emails:** 6 correos (0h, 24h, 3d, 7d, 10d, 14d) vía Laravel Mail
- **Brevo:** Contactos y SMTP cuando `BREVO_API_KEY` configurado
- **Recordatorios:** Leads 24h sin contactar → email admin; Propuestas 5d+ → follow-up
- **Comandos:** `leads:check-followups` (hourly), `quotes:mark-abandoned` (daily)

### 📊 Tracking y CRO

- **Eventos:** form_submit, phone_click, scroll_75_percent, time_on_page_30s, service_view, lead_magnet_view, cost_calculator_view, calculator_estimate
- **CTAs contextuales** por servicio y borough (`config/cta.php`)
- **Prefill** desde calculadora a formulario de quote
- **Lead scoring** 0–12 (Cold 0–4, Warm 5–8, Hot 9–12)

### 🔍 SEO

- **Schema:** LocalBusiness, Service, FAQ, Breadcrumb, AggregateRating
- **Canonical, Open Graph**
- **Cache headers** para CDN (Cloudflare)
- **@tailwindcss/typography** para contenido del blog

---

## 🛠️ Tecnologías

| Componente | Tecnología |
|------------|------------|
| Backend | PHP 8.2+, Laravel 12.x |
| Admin | Filament 4.0 |
| Base de datos | PostgreSQL / MySQL |
| Frontend | Tailwind CSS 4.x, Alpine.js 3.x, Vite 7.x |
| Animaciones | Motion One |
| Email | Laravel Mail, Brevo (opcional) |
| Tracking | GTM, GA4, Meta Pixel |

---

## 📦 Requisitos

- **PHP** >= 8.2 (extensiones: `intl`, `gd`, `zip`)
- **Composer** >= 2.0
- **Node.js** >= 18.0
- **Base de datos** PostgreSQL o MySQL

---

## 🚀 Instalación

```bash
# Clonar e instalar dependencias
git clone <repository-url>
cd blue_draft_pro
composer install
npm install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Base de datos
php artisan migrate
php artisan db:seed

# Assets
npm run build
php artisan storage:link
```

### Variables de entorno (.env)

```env
# Base de datos (PostgreSQL o MySQL)
DB_CONNECTION=pgsql  # o mysql
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

## 🎯 Uso

### Desarrollo

```bash
php artisan serve
npm run dev
```

Sitio: `http://localhost:8000`  
Panel: `http://localhost:8000/system-bd-access` (solo usuarios `@bluedraft.org` o `@bluedraft.cc`)

### Comandos programados (Cron)

```bash
# Añadir al crontab
* * * * * cd /ruta/proyecto && php artisan schedule:run >> /dev/null 2>&1
```

```php
// routes/console.php
Schedule::command('quotes:mark-abandoned')->daily();
Schedule::command('leads:check-followups')->hourly();
Schedule::command('report:monthly', ['--email'])->monthlyOn(1, '06:00');
```

### Cola de trabajos

```bash
php artisan queue:work
# O configurar Supervisor en producción
```

---

## 📁 Estructura del Proyecto

```
app/
├── Console/Commands/     # CheckLeadFollowUps, MarkAbandonedQuotes
├── Filament/
│   ├── Pages/            # Hero, About, Contact, Footer, CustomDashboard
│   └── Resources/       # Quotes, Projects, Services, Posts
├── Http/Controllers/    # Home, Quote, Service, Project, Post, LeadMagnet, CostCalculator, etc.
├── Jobs/                # AddLeadToEmailSequence, SendSequenceEmailJob, NotifyNewLeadAfter24Hours, etc.
├── Mail/                # Secuencia 1-6, LeadNotContacted, ProposalFollowUp
├── Models/              # Quote, Project, Service, Post, Settings, LeadMagnetSubscriber
└── Services/            # EmailSequenceService

config/
├── cta.php             # CTAs por servicio/borough
├── email_sequence.php  # Delays y contenido
├── pillar_cities.php    # Ciudades pilares (NYC focus)
├── tracking.php        # GTM, GA4, Meta Pixel
└── quotes.php          # Auto-asignación leads

docs/                    # Documentación detallada
├── ESTADO_ACTUAL_PROYECTO.md
├── FASES_IMPLEMENTACION.md
├── CRO_IMPLEMENTADO.md
├── CLOUDFLARE_SETUP.md
├── DEPLOYMENT_HOSTINGER.md
└── ...
```

---

## 📄 Rutas Públicas

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/` | Landing page |
| POST | `/contact` | Formulario contacto |
| POST | `/quote/partial` | Guardado parcial Step 1 |
| POST | `/quote/complete` | Completado Step 2 |
| GET | `/services` | → Redirige a `/#services` |
| GET | `/services/{slug}` | Detalle servicio |
| GET | `/construction-company-new-york` | Pilar NYC |
| GET | `/projects/{slug}` | Detalle proyecto |
| GET | `/blog` | Índice blog |
| GET | `/blog/{slug}` | Post individual |
| GET | `/free-renovation-guide` | Lead magnet |
| GET | `/cost-calculator` | Calculadora costes |
| GET | `/sitemap.xml` | Sitemap |

---

## 🔧 Comandos Útiles

```bash
# Limpiar caché
php artisan optimize:clear

# Producción
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Automatización (cron)
php artisan leads:check-followups
php artisan quotes:mark-abandoned
php artisan report:monthly --email

# Testing / desarrollo
php artisan leads:create-sample        # Crea lead de prueba
php artisan test                       # Tests automatizados

# Diagnóstico (ver docs/COMANDOS_DIAGNOSTICO.md)
php artisan images:test-urls
php artisan projects:check
```

---

## 🌐 Despliegue

- **[Pre-Deploy](docs/PRE_DEPLOY.md)** — Pasos antes de subir (npm run build, etc.)
- **[Checklist](DEPLOYMENT_CHECKLIST.md)** — Verificación pre/post despliegue
- **[Hostinger](docs/DEPLOYMENT_HOSTINGER.md)** — Guía paso a paso
- **[.env.hostinger.example](.env.hostinger.example)** — Plantilla .env para producción
- **[Cloudflare](docs/CLOUDFLARE_SETUP.md)** — CDN y cache

---

## 📚 Documentación Adicional

| Documento | Contenido |
|-----------|-----------|
| [DOCUMENTACION_COMPLETA.md](docs/DOCUMENTACION_COMPLETA.md) | **Guía maestra** — Todo implementado y usos recomendados |
| [SISTEMA_METRICAS_EJECUTIVAS.md](docs/SISTEMA_METRICAS_EJECUTIVAS.md) | KPIs, reporte mensual, revenue pipeline |
| [TESTING_CHECKLIST.md](docs/TESTING_CHECKLIST.md) | Verificación pre-producción |
| [ESTADO_ACTUAL_PROYECTO.md](docs/ESTADO_ACTUAL_PROYECTO.md) | Estado por fase, correcciones, rutas |
| [FASES_IMPLEMENTACION.md](docs/FASES_IMPLEMENTACION.md) | Detalle de las 6 fases |
| [CRO_IMPLEMENTADO.md](docs/CRO_IMPLEMENTADO.md) | Mejoras de conversión |
| [COMANDOS_DIAGNOSTICO.md](docs/COMANDOS_DIAGNOSTICO.md) | Comandos images:test-urls, projects:check |
| [PROYECTO_IMPLEMENTADO.md](PROYECTO_IMPLEMENTADO.md) | Resumen funcionalidades |
| [Project Proposal](/project-proposal) | Professional proposal & usage guide (English) |

---

## 📞 Contacto

- **Dirección:** 358 Amboy St, Brooklyn, NY 11212, USA
- **Teléfono:** +1.3476366128
- **Email:** info@bluedraft.cc

---

## 📄 Licencia

Proyecto privado — Blue Draft Construction Company. Todos los derechos reservados.

---

**Versión:** 1.2.0  
**Última actualización:** Febrero 2026
