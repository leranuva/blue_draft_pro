# Documentación Completa — Blue Draft

**Guía de referencia** de todo lo implementado y usos recomendados.

---

## Índice

1. [Resumen del sistema](#1-resumen-del-sistema)
2. [Captación de leads](#2-captación-de-leads)
3. [Panel de administración](#3-panel-de-administración)
4. [Sistema de métricas ejecutivas](#4-sistema-de-métricas-ejecutivas)
5. [Automatización y emails](#5-automatización-y-emails)
6. [Comandos disponibles](#6-comandos-disponibles)
7. [Testing](#7-testing)
8. [Configuración](#8-configuración)
9. [Flujos de trabajo recomendados](#9-flujos-de-trabajo-recomendados)

---

## 1. Resumen del sistema

Blue Draft es un CRM web para empresa de construcción en NYC con:

| Módulo | Descripción |
|--------|-------------|
| **Landing** | Hero, About, Projects, Services, Testimonials, Quote, Contact |
| **SEO local** | Páginas pilar por distrito (Manhattan, Queens, Brooklyn, Bronx, New Jersey) |
| **Captación** | Formulario quote 2 pasos, lead magnet, calculadora de costes, contacto |
| **CRM** | Pipeline de leads, lead score, UTM, borough, secuencia de emails |
| **Métricas** | Dashboard ejecutivo, reporte mensual PDF, revenue pipeline |
| **Admin** | Filament 4 — Quotes, Projects, Services, Posts, Settings |

---

## 2. Captación de leads

### 2.1 Formulario de cotización (2 pasos)

**Rutas:** `POST /quote/partial` → `POST /quote/complete`

| Paso | Campos | Comportamiento |
|------|--------|----------------|
| **Step 1** | nombre, email, servicio (residential/commercial/renovation/other) | Crea quote con `is_partial=true`, devuelve `quote_id` |
| **Step 2** | quote_id, phone, address, budget, message, photos, reCAPTCHA | Completa quote, envía email admin, despacha secuencia |

**Campos opcionales Step 1:** timeline, property_type, calculator_budget_min/max (prefill desde calculadora).

**Uso recomendado:**
- Mantener Step 1 corto para maximizar conversión.
- Usar prefill desde `/cost-calculator` para leads cualificados (+3 lead score).

### 2.2 Lead magnet

**Rutas:** `GET /free-renovation-guide` → `POST /free-renovation-guide` → `GET /free-renovation-guide/guide`

- Captura email (y nombre opcional).
- Crea `LeadMagnetSubscriber` y Quote con `lead_source=lead_magnet_free_guide`.
- Despacha secuencia de emails.
- La guía solo es accesible tras enviar el formulario (sesión).

**Uso recomendado:** Ofrecer guía descargable a cambio del email para nutrir leads fríos.

### 2.3 Calculadora de costes

**Ruta:** `GET /cost-calculator`

- El usuario selecciona tipo de proyecto y obtiene rango de presupuesto.
- "Lock This Estimate" prefill el formulario de quote con budget y servicio.
- Lead score +3 para leads pre-cualificados.

**Uso recomendado:** Colocar en CTAs de servicios y pillar pages para captar intención de compra.

### 2.4 Formulario de contacto

**Ruta:** `POST /contact`

- Campos: name, email, service, message (y opcionalmente budget, phone, address).
- Envía notificación a `ADMIN_NOTIFICATION_EMAIL`.
- Rate limit: 5 requests/minuto por IP.

### 2.5 Tracking automático

Se captura y guarda en cada lead:

| Campo | Origen |
|-------|--------|
| utm_source, utm_medium, utm_campaign | Query string o sesión |
| lead_source | utm_source, referer o "website" |
| gclid | Google Ads (query/sesión) |
| fbclid | Meta/Facebook Ads (query/sesión) |
| borough | Inferido de address (Manhattan, Brooklyn, Queens, Bronx, Staten Island) |

**Uso recomendado:** Añadir UTM a todas las campañas (Ads, email, redes) para atribución.

---

## 3. Panel de administración

**URL:** `/system-bd-access`  
**Acceso:** Solo usuarios con email `@bluedraft.org` o `@bluedraft.cc`

### 3.1 Dashboard

- **KPIs ejecutivos:** Leads mes actual, Revenue ganado, Pipeline potencial, Ticket promedio.
- **Alertas:** Leads sin contactar 24h+, Propuestas pendientes follow-up 5d+.
- **Funnel:** Partial → Complete → Proposal → Won (con tasas de conversión).
- **Pipeline:** New, Contacted, Qualified, Proposal Sent, Won, Lost.
- **Análisis:** Por fuente, borough, servicio.
- **Leads prioritarios:** Top 5 por lead score.

### 3.2 Quotes (Cotizaciones)

- **Campos clave:** client_name, email, phone, address, borough, service_type, stage, lead_score.
- **Campos financieros:** estimated_value (al enviar propuesta), closed_value (al cerrar deal).
- **Etapas:** New → Contacted → Qualified → Proposal Sent → Won / Lost.
- **Filtros:** stage, borough, status, service_type, is_partial, abandoned_at.

**Uso recomendado:**
- Actualizar `stage` conforme avanza el lead.
- Rellenar `estimated_value` al enviar propuesta.
- Rellenar `closed_value` al cerrar (Won).

### 3.3 Projects, Services, Posts

- **Projects:** Galería con slug, categoría, imágenes antes/después.
- **Services:** Páginas SEO con FAQs, CTA, proyectos relacionados.
- **Posts:** Blog con RichEditor, meta SEO, published_at.

### 3.4 Settings

- Hero, About, Services, Testimonials, Contact, Footer.
- Pillar pages por distrito (Manhattan, Queens, Brooklyn, Bronx, New Jersey).

---

## 4. Sistema de métricas ejecutivas

Ver [SISTEMA_METRICAS_EJECUTIVAS.md](SISTEMA_METRICAS_EJECUTIVAS.md) para detalle.

### 4.1 KPIs disponibles

| Categoría | KPI |
|-----------|-----|
| Marketing | Leads totales, por fuente, borough, servicio, **revenue por fuente** |
| Comerciales | Contactados <24h (%), propuestas, close rate (%), tiempo cierre, revenue, pipeline, **velocidad comercial** |
| Operativos | Abandonados, seguimientos vencidos |
| Avanzados | **Score vs Close Rate**, **Forecast predictivo**, **Borough profundo** (close rate, ticket, días por borough) |

### 4.2 UTM completo

Se captura: `utm_source`, `utm_medium`, `utm_campaign`, `utm_content`, `gclid`, `fbclid`.

### 4.3 Tabla `quote_stages`

Registra cada cambio de etapa con timestamp para:
- Tiempo en cada etapa.
- Tasa de conversión por etapa.
- Análisis de cohortes (futuro).

### 4.4 Campos financieros y velocidad en quotes

| Campo | Cuándo rellenar |
|-------|-----------------|
| estimated_value | Al enviar propuesta (Qualified / Proposal Sent) |
| closed_value | Al cerrar deal (Won) |
| closed_at | Se rellena automáticamente al pasar a Won/Lost |
| first_contacted_at | Se rellena al pasar a Contacted/Qualified/Proposal (primera vez) |
| proposal_sent_at | Se rellena al pasar a Proposal Sent (primera vez) |

### 4.5 Reporte mensual

**Comando:** `php artisan report:monthly`

**Opciones:**
- `--email` — Envía PDF al admin.
- `--month=1 --year=2026` — Mes específico.
- `--no-pdf` — Solo salida en consola.

**Programado:** Día 1 de cada mes a las 06:00 con `--email`.

**Contenido PDF:** Leads, conversión, revenue, borough/servicio dominante, desgloses.

---

## 5. Automatización y emails

### 5.1 Secuencia de emails (6 correos)

Se despacha al completar quote (Step 2) o al suscribirse al lead magnet.

| # | Momento | Propósito |
|---|---------|-----------|
| 1 | Inmediato | Confirmación |
| 2 | +24h | Educación |
| 3 | +3d | Autoridad |
| 4 | +7d | Urgencia |
| 5 | +10d | Case study |
| 6 | +14d | Objeción |

**Config:** `config/email_sequence.php`, `EMAIL_SEQUENCE_ENABLED` en .env.

### 5.2 Recordatorios operativos

| Evento | Comando | Acción |
|--------|---------|--------|
| Leads 24h sin contactar | `leads:check-followups` | Email a admin |
| Propuestas 5d+ sin follow-up | `leads:check-followups` | Email a admin |
| Quotes parciales 24h+ sin completar | `quotes:mark-abandoned` | Marca `abandoned_at` |

**Programación:** `leads:check-followups` hourly, `quotes:mark-abandoned` daily.

### 5.3 Cola de trabajos

Los emails y jobs se procesan con `php artisan queue:work`. En producción usar Supervisor.

---

## 6. Comandos disponibles

### 6.1 Automatización

```bash
php artisan quotes:mark-abandoned      # Marca quotes parciales 24h+ como abandonados
php artisan leads:check-followups      # Despacha recordatorios (24h, 5d)
```

### 6.2 Reportes

```bash
php artisan report:monthly            # Genera PDF reporte mes anterior
php artisan report:monthly --email     # Genera y envía por email
php artisan report:monthly --month=1 --year=2026
php artisan report:monthly --no-pdf    # Solo consola
```

### 6.3 Testing / desarrollo

```bash
php artisan leads:create-sample        # Crea lead de prueba
php artisan leads:create-sample --complete
php artisan leads:create-sample --dispatch   # Despacha secuencia
php artisan leads:create-sample --email=test@example.com
```

### 6.4 Diagnóstico

```bash
php artisan images:test-urls           # Verifica URLs de imágenes
php artisan projects:check             # Revisa proyectos
```

---

## 7. Testing

### 7.1 Tests automatizados

```bash
php artisan test
```

**Cobertura actual:** 34+ tests (RoutesTest, FormsTest, CommandsTest, AdminTest).

### 7.2 Checklist manual

Ver [TESTING_CHECKLIST.md](TESTING_CHECKLIST.md) para verificación pre-producción (~45 ítems).

### 7.3 Crear lead de prueba

```bash
php artisan leads:create-sample
# Ver en: /system-bd-access/quotes
```

---

## 8. Configuración

### 8.1 Variables de entorno (.env)

```env
# Email principal
ADMIN_NOTIFICATION_EMAIL=info@bluedraft.cc

# Base de datos
DB_CONNECTION=pgsql
DB_DATABASE=blue_draft_pro

# reCAPTCHA (opcional, si vacío se omite validación)
RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=

# Secuencia de emails
EMAIL_SEQUENCE_ENABLED=true
BREVO_API_KEY=
BREVO_LIST_ID=

# Tracking
GTM_ID=
GA4_MEASUREMENT_ID=
META_PIXEL_ID=
```

### 8.2 Archivos de configuración

| Archivo | Uso |
|---------|-----|
| `config/pillar_cities.php` | Distritos (Manhattan, Queens, Brooklyn, Bronx, New Jersey) |
| `config/cta.php` | CTAs por servicio y borough |
| `config/email_sequence.php` | Delays y contenido secuencia |
| `config/tracking.php` | GTM, GA4, Meta Pixel |
| `config/quotes.php` | Auto-asignación de leads |

### 8.3 Cron (producción)

```bash
* * * * * cd /ruta/proyecto && php artisan schedule:run >> /dev/null 2>&1
```

---

## 9. Flujos de trabajo recomendados

### 9.1 Nuevo lead entra

1. Lead completa Step 1 → Quote creado (parcial).
2. Lead completa Step 2 → Email a admin, secuencia despachada.
3. **Acción:** Contactar en <24h (alerta en dashboard si no).
4. En admin: actualizar stage a Contacted, asignar si aplica.

### 9.2 Lead cualificado

1. Actualizar stage a Qualified.
2. Rellenar `estimated_value` al enviar propuesta.
3. Actualizar stage a Proposal Sent.
4. **Acción:** Follow-up a los 5 días si no responde (alerta automática).

### 9.3 Deal cerrado

1. Actualizar stage a Won (o Lost).
2. Rellenar `closed_value` si Won.
3. `closed_at` se rellena automáticamente.

### 9.4 Revisión mensual

1. Día 1: Recibir reporte PDF por email.
2. Revisar: borough dominante, servicio dominante, close rate.
3. **Acción:** Ajustar campañas Ads según datos (ej. más presupuesto en Queens si convierte mejor).

### 9.5 Mantenimiento semanal

1. Revisar alertas en dashboard (leads 24h, propuestas 5d).
2. Procesar cola: `php artisan queue:work` (o Supervisor).
3. Revisar leads abandonados (`abandoned_at`) para posibles reactivaciones.

---

## Archivos de referencia

| Documento | Contenido |
|-----------|-----------|
| [SISTEMA_METRICAS_EJECUTIVAS.md](SISTEMA_METRICAS_EJECUTIVAS.md) | Métricas, KPIs, reporte mensual |
| [TESTING_CHECKLIST.md](TESTING_CHECKLIST.md) | Verificación pre-producción |
| [ESTADO_ACTUAL_PROYECTO.md](ESTADO_ACTUAL_PROYECTO.md) | Estado por fase |
| [FASES_IMPLEMENTACION.md](FASES_IMPLEMENTACION.md) | Detalle fases 1-6 |
| [CRO_IMPLEMENTADO.md](CRO_IMPLEMENTADO.md) | Mejoras de conversión |
| [user.md](user.md) | Guía usuario final |
| [README.md](../README.md) | Instalación y overview |

---

**Última actualización:** Febrero 2026
