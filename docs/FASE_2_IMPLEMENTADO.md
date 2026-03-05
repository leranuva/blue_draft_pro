# Fase 2 — SEO & Estructura Escalable (Implementado)

Resumen de los cambios realizados en la **Fase 2** de la estrategia de mejora.

---

## 1. Landing Pages por servicio

### Tabla `services`
| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| title | string | Título |
| slug | string | URL único con ubicación NYC (ej: kitchen-remodeling-new-york) |
| hero_title | string | Título del hero |
| hero_subtitle | string | Subtítulo |
| seo_title | string | Meta title |
| seo_description | string | Meta description (500 chars) |
| content | longtext | Contenido principal (1200-2000 palabras) |
| faq_json | json | Array de {question, answer} |
| is_active | boolean | Visible en frontend |
| sort_order | integer | Orden en listados |

### Tabla `project_service` (pivot)
- Relación many-to-many entre projects y services.
- Un proyecto puede aparecer en varias landing pages de servicio.

### Rutas
- `GET /services` → `ServiceController::index()`
- `GET /services/{slug}` → `ServiceController::show()`

### Vista
- `resources/views/services/show.blade.php` — Hero, contenido, FAQs (acordeón), internal linking (2 servicios relacionados, 2 proyectos, pilar NYC), proyectos relacionados, CTA. Incluye canonical, Open Graph y Breadcrumb Schema.

### Filament
- **ServiceResource** — CRUD completo en Site Settings → Services (Landing Pages)
- Form: título, slug (auto), hero, SEO, content, FAQs (Repeater), proyectos relacionados (Select multiple)

### Seeder
- `ServiceSeeder` — 3 servicios con slugs NYC: Kitchen Remodeling New York, Bathroom Renovation New York, Commercial Construction Manhattan

### Migración de slugs NYC
- `2026_02_23_200001_update_service_slugs_for_nyc_seo.php` — Migra slugs antiguos a versiones con ubicación explícita para SEO local en NYC.

---

## 2. Página pilar NYC

### Ruta
- `GET /construction-company-new-york` → `PillarPageController::show()`

### Objetivo
- Página más fuerte del sitio para SEO local en New York City
- Enlaza a todos los servicios y proyectos
- Menciones de boroughs: Manhattan, Brooklyn, Queens, Bronx, Staten Island

### Vista
- `resources/views/pages/pillar-nyc.blade.php` — Hero, contenido HTML, grid de servicios, grid de proyectos, CTA

### Seeder
- `PillarPageSeeder` — Settings en grupo `pillar_nyc`: título, meta, hero, contenido con boroughs

### Sitemap
- Incluida con prioridad 0.95

---

## 3. Proyectos con slug SEO

### Migración
- `add_slug_to_projects_table` — columna `slug` única, auto-poblada desde `title` para proyectos existentes.

### Ruta
- `GET /projects/{slug}` → `ProjectController::show()`

### Vista
- `resources/views/projects/show.blade.php` — Slider before/after, descripción, internal linking (2 servicios, pilar NYC), proyectos relacionados, CTA. Incluye canonical, Open Graph y Breadcrumb Schema.

### Modelo Project
- `slug` en fillable
- `booted()` — auto-genera slug desde title al guardar
- `getRouteKeyName()` → 'slug'

### Filament
- Campo `slug` en ProjectForm (editable, auto desde título)

### Home
- Cards de proyectos enlazan a `route('projects.show', $project->slug)`.

---

## 4. Sitemap automático

### Ruta
- `GET /sitemap.xml` → `SitemapController::index()`

### Contenido
- Home (priority 1.0)
- Página pilar NYC (priority 0.95)
- Servicios index (priority 0.9)
- Servicios activos (priority 0.8)
- Proyectos con slug (priority 0.7)

### Layout
- `<link rel="sitemap" href="/sitemap.xml">` en el head.

---

## 5. Schema Markup (JSON-LD)

### LocalBusiness
- Incluido en layout cuando existe `$contact`.
- Componente: `resources/views/components/schema-local-business.blade.php`

### Service
- En páginas de servicio.
- Componente: `resources/views/components/schema-service.blade.php`

### FAQ
- En páginas de servicio con FAQs.
- Componente: `resources/views/components/schema-faq.blade.php`

### Breadcrumb
- En pilar, servicios y proyectos.
- Componente: `resources/views/components/schema-breadcrumb.blade.php`

---

## 6. SEO técnico (Canonical, Open Graph)

- **Canonical:** `<link rel="canonical">` en pilar, servicios y proyectos
- **Open Graph:** `og:title`, `og:description`, `og:url`, `og:image`, `og:type` en todas las landings
- **Layout:** `@stack('meta')` en `layouts/app.blade.php` para inyectar meta dinámicos

---

## Archivos creados/modificados

| Archivo | Cambios |
|---------|---------|
| `database/migrations/2026_02_23_100001_create_services_table.php` | Tabla services + project_service |
| `database/migrations/2026_02_23_100002_add_slug_to_projects_table.php` | Slug en projects |
| `database/migrations/2026_02_23_200001_update_service_slugs_for_nyc_seo.php` | Migración slugs NYC |
| `app/Models/Service.php` | Nuevo modelo |
| `app/Models/Project.php` | slug, services(), getRouteKeyName |
| `app/Http/Controllers/ServiceController.php` | show(), relatedServices, relatedProjects |
| `app/Http/Controllers/ProjectController.php` | show(), relatedServices |
| `app/Http/Controllers/PillarPageController.php` | Página pilar NYC |
| `app/Http/Controllers/SitemapController.php` | index(), incluye pillar |
| `app/Filament/Resources/Services/*` | ServiceResource completo |
| `app/Filament/Resources/Projects/Schemas/ProjectForm.php` | Campo slug |
| `resources/views/services/show.blade.php` | Landing, internal linking, meta, schema |
| `resources/views/projects/show.blade.php` | Detalle, internal linking, meta, schema |
| `resources/views/pages/pillar-nyc.blade.php` | Página pilar NYC |
| `resources/views/components/schema-*.blade.php` | LocalBusiness, Service, FAQ, Breadcrumb |
| `resources/views/home.blade.php` | Enlaces a projects.show |
| `resources/views/layouts/app.blade.php` | meta_description, @stack('meta'), schema, sitemap, footer pillar link |
| `routes/web.php` | services, projects, pillar.nyc, sitemap |
| `database/seeders/ServiceSeeder.php` | 3 servicios con slugs NYC |
| `database/seeders/PillarPageSeeder.php` | Settings página pilar |

---

## URLs nuevas

| URL | Descripción |
|-----|-------------|
| `/services` | Índice de servicios |
| `/services/kitchen-remodeling-new-york` | Landing Kitchen Remodeling NYC |
| `/services/bathroom-renovation-new-york` | Landing Bathroom Renovation NYC |
| `/services/commercial-construction-manhattan` | Landing Commercial Manhattan |
| `/construction-company-new-york` | Página pilar NYC |
| `/projects/{slug}` | Detalle de proyecto |
| `/sitemap.xml` | Sitemap XML |

---

## Internal linking (implementado)

- **En cada landing de servicio:** 2 servicios relacionados, 2 proyectos relevantes, enlace a página pilar NYC
- **En cada proyecto:** 2 servicios relacionados, enlace a página pilar NYC
- **En página pilar:** Enlaces a todos los servicios y proyectos recientes
- **Footer:** Enlace "Construction Company NYC" en Quick Links

## Pendiente (Fase 2)

- Contenido 1200-2000 palabras por landing (editable en Filament)
- Contenido 2000+ palabras en página pilar (opcional: Filament para pillar)
- Schema Review (testimonios) — Fase posterior
- Optimización de slugs en proyectos por borough (ej: `luxury-kitchen-remodel-manhattan-loft`)

---

*Fase 2 — docs/ — Febrero 2025*
