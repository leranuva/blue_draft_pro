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

> **Documentación:** Ver [docs/INDEX.md](docs/INDEX.md) — Orden de lectura profesional para el equipo. Guía maestra: [DOCUMENTACION_COMPLETA.md](docs/DOCUMENTACION_COMPLETA.md)

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
| `GET /construction-company-{city}` | Páginas pilar por borough (Manhattan, Brooklyn, Queens, Bronx, New Jersey) |
| `GET /free-renovation-guide` | Lead magnet (captura email) |
| `GET /cost-calculator` | Calculadora de costes NYC (soporta `?borough=manhattan` para pre-selección) |
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

- **Eventos:** form_submit, phone_click, scroll_75_percent, time_on_page_30s, service_view, lead_magnet_view, cost_calculator_view, calculator_estimate, calculator_step_1_completed, calculator_step_2_completed, calculator_cta_clicked
- **CTAs contextuales** por servicio y borough (`config/cta.php`)
- **Prefill** desde calculadora a formulario de quote
- **Lead scoring** dinámico 0–12+ (Cold 0–4, Warm 5–8, Hot 9–12): +2 base, +2 Manhattan, +2 Premium, +2 whole_house, +1 commercial, +1 sqft>500, +1 budget≥100k

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
├── cost_calculator.php  # Rangos, multiplicadores borough/finish, timelines, borough_insights
├── cta.php             # CTAs por servicio/borough
├── email_sequence.php  # Delays y contenido
├── pillar_cities.php   # Boroughs pilares (FAQs, building_regulations, calculator_borough)
├── tracking.php        # GTM, GA4, Meta Pixel
└── quotes.php          # Auto-asignación leads

docs/                    # Documentación (ver docs/INDEX.md para orden de lectura)
├── INDEX.md             # Índice principal — orden profesional
├── README.md            # Punto de entrada
├── DOCUMENTACION_COMPLETA.md
├── FASES_IMPLEMENTACION.md
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
| GET | `/construction-company-{city}` | Pilar por borough (manhattan, brooklyn, queens, bronx, new-jersey) |
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

## 📚 Documentación

| Documento | Contenido |
|-----------|-----------|
| [**docs/INDEX.md**](docs/INDEX.md) | **Índice principal** — Orden de lectura profesional para el equipo |
| [docs/README.md](docs/README.md) | Punto de entrada a la documentación |
| [DOCUMENTACION_COMPLETA.md](docs/DOCUMENTACION_COMPLETA.md) | Guía maestra — Todo implementado y usos recomendados |
| [COST_CALCULATOR.md](docs/COST_CALCULATOR.md) | Calculadora costes v2.1 — fórmula, scoring, borough insights |
| [PILAR_POR_DISTRITO_GUIA.md](docs/PILAR_POR_DISTRITO_GUIA.md) | Páginas pilar por borough — SEO y estructura |
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
