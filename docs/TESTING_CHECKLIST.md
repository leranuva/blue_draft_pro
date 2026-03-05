# Checklist de Testing — Blue Draft

**Objetivo:** Verificar que todo el sistema funciona correctamente antes de producción.

**Cómo usar:** Ejecutar localmente (`php artisan serve` + `npm run dev`) o contra staging. Marcar cada ítem al completar.

---

## 1. Páginas públicas (GET)

| # | Ruta | Esperado | ✓ |
|---|------|----------|---|
| 1 | `/` | Home carga, secciones visibles (Hero, About, Projects, Services, Testimonials, Quote, Contact) | |
| 2 | `/services` | Redirige 301 a `/#services` | |
| 3 | `/services/{slug}` | Página de servicio (ej. kitchen-remodeling-nyc). Si no hay servicios, 404 o vacío | |
| 4 | `/construction-company-new-york` | Pilar NYC carga | |
| 5 | `/construction-company-manhattan` | Pilar Manhattan carga | |
| 6 | `/construction-company-queens` | Pilar Queens carga | |
| 7 | `/construction-company-brooklyn` | Pilar Brooklyn carga | |
| 8 | `/construction-company-bronx` | Pilar Bronx carga | |
| 9 | `/construction-company-new-jersey` | Pilar New Jersey carga | |
| 10 | `/projects/{slug}` | Proyecto individual. Si no hay proyectos, 404 o listado vacío | |
| 11 | `/blog` | Índice del blog | |
| 12 | `/blog/{slug}` | Post individual (si hay posts publicados) | |
| 13 | `/sitemap.xml` | XML válido con URLs (home, pillar, distritos, services, projects, posts, lead-magnet, cost-calculator) | |
| 14 | `/free-renovation-guide` | Lead magnet landing | |
| 15 | `/free-renovation-guide/guide` | Guía (requiere sesión/email previo o redirección) | |
| 16 | `/cost-calculator` | Calculadora de costes | |
| 17 | `/project-proposal` | Propuesta de proyecto | |

---

## 2. Formularios (POST)

### 2.1 Contacto (`POST /contact`)

| # | Acción | Esperado | ✓ |
|---|--------|----------|---|
| 1 | Enviar con datos válidos | 302 redirect, mensaje success, email recibido en `ADMIN_NOTIFICATION_EMAIL` | |
| 2 | Enviar sin email | 422 o validación, no envía | |
| 3 | Enviar 6 veces en 1 min (misma IP) | 6ª request: 429 Too Many Requests | |

### 2.2 Cotización Step 1 (`POST /quote/partial`)

| # | Acción | Esperado | ✓ |
|---|--------|----------|---|
| 1 | Enviar nombre, email, servicio | 200/302, quote creado con `is_partial=true`, sesión con quote_id | |

### 2.3 Cotización Step 2 (`POST /quote/complete`)

| # | Acción | Esperado | ✓ |
|---|--------|----------|---|
| 1 | Completar con quote_id de Step 1, datos válidos | Quote actualizado, email admin, job AddLeadToEmailSequence despachado | |
| 2 | Completar sin quote_id válido | Error o redirect | |
| 3 | Enviar 6 veces en 1 min (misma IP) | 6ª request: 429 | |

### 2.4 Lead Magnet (`POST /free-renovation-guide`)

| # | Acción | Esperado | ✓ |
|---|--------|----------|---|
| 1 | Email válido | LeadMagnetSubscriber creado, redirect a guide o success | |
| 2 | Email duplicado | Comportamiento definido (error o mensaje) | |
| 3 | Enviar 6 veces en 1 min | 6ª request: 429 | |

---

## 3. Panel Admin (`/system-bd-access`)

| # | Acción | Esperado | ✓ |
|---|--------|----------|---|
| 1 | Acceder sin login | Redirect a login | |
| 2 | Login con info@bluedraft.cc (o usuario válido) | Acceso al dashboard | |
| 3 | Dashboard | CustomDashboard carga sin 500, métricas visibles | |
| 4 | Quotes | Lista de cotizaciones, editar una | |
| 5 | Projects | Lista, crear, editar, eliminar | |
| 6 | Services | Lista, crear, editar | |
| 7 | Posts | Lista, crear, editar, publicar | |
| 8 | Settings | Hero, About, Contact, Footer, etc. | |
| 9 | Subir imagen en Project/Post | Imagen se guarda en storage, se muestra | |

---

## 4. Navegación y UX

| # | Acción | Esperado | ✓ |
|---|--------|----------|---|
| 1 | Navbar desktop | Enlaces a Home, About, Projects, Services, Testimonials, Blog, Contact, Get Quote | |
| 2 | Navbar móvil | Menú hamburguesa abre/cierra | |
| 3 | Footer | Enlaces a distritos, lead-magnet, cost-calculator | |
| 4 | Modo oscuro/claro | Toggle funciona si está implementado | |
| 5 | Lazy loading imágenes | Imágenes cargan al scroll (home) | |

---

## 5. Tracking (si GTM/GA4 configurados)

| # | Acción | Esperado | ✓ |
|---|--------|----------|---|
| 1 | Cargar home | Evento page_view o similar | |
| 2 | Enviar formulario | Evento form_submit | |
| 3 | Click teléfono | Evento phone_click | |
| 4 | Scroll 75% | Evento scroll_75_percent | |
| 5 | Calculadora: obtener estimación | Evento calculator_estimate | |

---

## 6. Comandos programados

| # | Comando | Esperado | ✓ |
|---|---------|----------|---|
| 1 | `php artisan quotes:mark-abandoned` | Sin error, quotes abandonados marcados | |
| 2 | `php artisan leads:check-followups` | Sin error, emails enviados si hay leads 24h sin contactar | |

---

## 7. Tests automatizados (PHPUnit)

```bash
php artisan test
```

| # | Esperado | ✓ |
|---|----------|---|
| 1 | Todos los tests pasan (34+ tests) | |
| 2 | RoutesTest: home, sitemap, services, blog, pillar pages, quote partial, throttle | |
| 3 | FormsTest: quote complete, lead magnet, contact/quote validation | |
| 4 | CommandsTest: quotes:mark-abandoned, leads:check-followups | |
| 5 | AdminTest: redirect sin login, acceso con usuario @bluedraft.cc | |

---

## Resumen

- **Total ítems:** ~45
- **Críticos:** Formularios, admin, rutas públicas
- **Opcionales:** Tracking (si no configurado), comandos (requieren datos)

**Si algo falla:** Anotar ruta, acción y mensaje de error. Revisar `storage/logs/laravel.log`.
