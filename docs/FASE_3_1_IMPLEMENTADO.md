# Fase 3.1 — Optimización Crítica (Implementado)

Resumen de los cambios realizados en la **Fase 3.1**.

---

## 1. Integración Brevo API

### EmailSequenceService
- **addLeadToSequence():** Despacha 4 jobs con delay (0h, 24h, 3d, 7d).
- **addContactToBrevo():** Añade contacto a Brevo cuando `BREVO_API_KEY` está configurado.
- **sendViaBrevoApi():** Envío transaccional vía API (alternativa a Laravel Mail).

### Jobs
- **SendSequenceEmailJob:** Envía email 1–4 según número. Evita duplicados con `quote_email_sequence_log`.
- **AddLeadToEmailSequence:** Llama al servicio al completar un quote.

### Configuración (.env)
```
EMAIL_SEQUENCE_ENABLED=true
BREVO_API_KEY=your_key
BREVO_LIST_ID=optional_list_id
```

---

## 2. Templates de la secuencia (4 emails)

| # | Asunto | Contenido |
|---|--------|-----------|
| 1 | We received your quote request | Confirmación + agendar llamada |
| 2 | How NYC construction works | Educación sobre proceso NYC |
| 3 | See our before/after projects | Autoridad, testimonios |
| 4 | Limited availability this month | Escasez / urgencia |

**Vistas:** `resources/views/emails/sequence/1-confirmation.blade.php` … `4-urgency.blade.php`

---

## 3. Lead scoring avanzado

### Reglas (max 12)
- Presupuesto: over-100k +3, 50k-100k +2, 25k-50k/10k-25k +1
- Comercial +2
- Fotos +2
- Mensaje >200 chars +1
- Teléfono completo +1
- Dirección completa +1
- **Borough NYC específico +1**

### Borough
- Campo `borough` en quotes.
- **inferBoroughFromAddress():** Infiere Manhattan, Brooklyn, Queens, Bronx, Staten Island desde la dirección.
- **getBoroughs():** Lista de boroughs para selects.

### Asignación automática
- **config/quotes.php:** Mapeo `by_borough`, `by_service`, `default`.
- Variables de entorno: `QUOTE_ASSIGN_BOROUGH_MANHATTAN`, `QUOTE_ASSIGN_SERVICE_COMMERCIAL`, etc.
- Al crear quote: si hay mapeo, se asigna `assigned_to`.

---

## 4. Dashboard analítico

### Métricas
- **Por fuente:** lead_source / utm_source (agrupado).
- **Por borough:** Conteo por borough.
- **Por servicio:** Conteo por service_type.

### Alertas (ya existentes)
- Leads sin contactar 24h+.
- Propuestas pendientes de follow-up 5d+.

---

## Archivos creados/modificados

| Archivo | Cambios |
|---------|---------|
| `database/migrations/2026_02_24_100001_add_borough_to_quotes_table.php` | Campo borough |
| `database/migrations/2026_02_24_100002_create_quote_email_sequence_log_table.php` | Log de emails enviados |
| `app/Mail/SequenceEmail1Confirmation.php` … `SequenceEmail4Urgency.php` | 4 Mailables |
| `app/Jobs/SendSequenceEmailJob.php` | Job de secuencia |
| `app/Services/EmailSequenceService.php` | Brevo API + despacho de jobs |
| `app/Models/Quote.php` | borough, getBoroughs, inferBoroughFromAddress, scoring, auto-assignment |
| `app/Filament/Pages/CustomDashboard.php` | bySource, byBorough, byService |
| `app/Filament/Resources/Quotes/Schemas/QuoteForm.php` | Campo borough |
| `app/Filament/Resources/Quotes/Tables/QuotesTable.php` | Columna borough, filtro |
| `config/quotes.php` | Auto-assignment |
| `resources/views/emails/sequence/*.blade.php` | 4 templates |

---

*Fase 3.1 — docs/ — Febrero 2025*
