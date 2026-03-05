# Fase 3 — Automatización Comercial (Implementado)

Resumen de los cambios realizados en la **Fase 3** de la estrategia de mejora.

---

## 1. Modelo Quote mejorado

### Nuevos campos (migración `2026_02_23_210001`)

| Campo | Tipo | Descripción |
|-------|------|-------------|
| lead_source | string | Origen del lead (website, google, etc.) |
| utm_source | string | UTM source |
| utm_medium | string | UTM medium |
| utm_campaign | string | UTM campaign |
| stage | string | Etapa del pipeline (new, contacted, qualified, proposal_sent, won, lost) |
| last_contacted_at | timestamp | Última vez que se contactó al lead |
| assigned_to | foreignId | Usuario asignado (users.id) |

### Stages del pipeline

| Stage | Descripción |
|-------|-------------|
| new | Lead nuevo, sin contactar |
| contacted | Ya se contactó |
| qualified | Lead cualificado |
| proposal_sent | Propuesta enviada |
| won | Ganado |
| lost | Perdido |

### Migración de datos existentes

- `status = pending` → `stage = new`
- `status = contacted` → `stage = contacted`
- `status = completed` → `stage = won`

### Sincronización status ↔ stage

- Al guardar, si `stage` cambia, se sincroniza `status` automáticamente.
- Si `stage` pasa a contacted/qualified/proposal_sent, se setea `last_contacted_at` si estaba vacío.

---

## 2. Captura UTM y lead_source

### Middleware `CaptureUtmParams`

- Se ejecuta en cada request web.
- Si la URL tiene `utm_source`, `utm_medium`, `utm_campaign` o `lead_source`, los guarda en sesión.
- Ubicación: `app/Http/Middleware/CaptureUtmParams.php`

### Modelo Quote::extractTrackingFromRequest()

- Extrae UTM y lead_source de: query params, input del formulario, o sesión.
- Usado en: QuoteController (savePartial, complete), HomeController (submitContact).

### Flujo

1. Usuario llega con `?utm_source=google&utm_medium=cpc` → middleware guarda en sesión.
2. Usuario envía formulario → extractTrackingFromRequest() lee de sesión y guarda en Quote.

---

## 3. Filament — QuoteForm y QuotesTable

### QuoteForm

- Campo `stage` (Select) con las 6 etapas.
- Campo `last_contacted_at` (DateTimePicker).
- Campo `assigned_to` (Select, relación con User).
- Campos UTM: `lead_source`, `utm_source`, `utm_medium`, `utm_campaign`.

### QuotesTable

- Columna `stage` (badge, ordenable, filtrable).
- Filtro por `stage`.
- Columna `status` oculta por defecto (se mantiene por compatibilidad).

---

## 4. Jobs de recordatorios internos

### NotifyNewLeadAfter24Hours

- Se dispara para quotes con `stage = new` y `created_at` hace más de 24 horas.
- Actualmente: log warning. TODO: enviar email/Slack al admin.

### FollowUpProposalSent

- Se dispara para quotes con `stage = proposal_sent` y `last_contacted_at` (o `updated_at`) hace más de 5 días.
- Actualmente: log warning. TODO: enviar notificación de follow-up.

### Comando `leads:check-followups`

- Ejecuta ambos checks y despacha los jobs.
- Programado: `hourly()` en `routes/console.php`.

```bash
php artisan leads:check-followups
```

---

## 5. Secuencia automática de emails (estructura)

### Configuración

- Archivo: `config/email_sequence.php`
- Variables de entorno: `EMAIL_SEQUENCE_ENABLED`, `BREVO_API_KEY`, `BREVO_LIST_ID`, etc.

### EmailSequenceService

- Placeholder para integración con Brevo (o ActiveCampaign).
- `addLeadToSequence(Quote $quote)` — llama a la API cuando está configurado.
- Ubicación: `app/Services/EmailSequenceService.php`

### Job AddLeadToEmailSequence

- Se despacha cuando se completa un quote (QuoteController::complete, HomeController quote_request).
- Llama a `EmailSequenceService::addLeadToSequence()`.

### Flujo planificado (cuando se implemente Brevo)

- Email 1 → inmediato
- Email 2 → 24h
- Email 3 → 3 días
- Email 4 → 7 días

---

## Archivos creados/modificados

| Archivo | Cambios |
|---------|---------|
| `database/migrations/2026_02_23_210001_add_phase3_fields_to_quotes_table.php` | Nuevos campos |
| `app/Models/Quote.php` | Stages, UTM, assignedTo, syncStatusFromStage, extractTrackingFromRequest |
| `app/Http/Middleware/CaptureUtmParams.php` | Nuevo middleware |
| `app/Http/Controllers/QuoteController.php` | UTM, stage, AddLeadToEmailSequence |
| `app/Http/Controllers/HomeController.php` | UTM, stage, lead_score, AddLeadToEmailSequence |
| `app/Filament/Resources/Quotes/Schemas/QuoteForm.php` | stage, last_contacted_at, assigned_to, UTM |
| `app/Filament/Resources/Quotes/Tables/QuotesTable.php` | Columna stage, filtro stage |
| `app/Jobs/NotifyNewLeadAfter24Hours.php` | Nuevo job |
| `app/Jobs/FollowUpProposalSent.php` | Nuevo job |
| `app/Jobs/AddLeadToEmailSequence.php` | Nuevo job |
| `app/Console/Commands/CheckLeadFollowUps.php` | Nuevo comando |
| `app/Services/EmailSequenceService.php` | Nuevo servicio (placeholder) |
| `config/email_sequence.php` | Configuración secuencia |
| `bootstrap/app.php` | Registro middleware CaptureUtmParams |
| `routes/console.php` | Schedule leads:check-followups |

---

## Optimización de cierre (implementado)

- **Notificaciones reales:** LeadNotContactedNotification y ProposalFollowUpNotification envían email al admin.
- **Dashboard:** Pipeline por stage, alertas (leads 24h+, propuestas 5d+), top 5 leads por score.
- **Scoring mejorado:** +1 teléfono completo, +1 dirección completa (max 10). Labels: Hot (7+), Warm (5+), Medium (3+), Cold (1+).

Configurar `ADMIN_NOTIFICATION_EMAIL` en `.env` para las notificaciones.

## Pendiente (Fase 3)
- Integrar Brevo API en EmailSequenceService cuando se configure BREVO_API_KEY.
- Crear emails/templates para la secuencia (4 emails).

---

*Fase 3 — docs/ — Febrero 2025*
