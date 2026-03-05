# Sistema de Métricas Ejecutivas — Blue Draft

**Objetivo:** Convertir el CRM en un sistema de inteligencia comercial con reportes accionables.

---

## Implementado

### FASE 1 — KPIs definidos

| Categoría | KPI |
|-----------|-----|
| **Marketing** | Leads totales, por fuente (utm_source), por borough, por servicio |
| **Comerciales** | Leads contactados <24h (%), propuestas enviadas, close rate (%), tiempo promedio cierre, revenue ganado, pipeline potencial |
| **Operativos** | Leads abandonados, seguimientos vencidos |

### FASE 2 — Base de datos

- **`quote_stages`**: Historial de etapas por quote (permite medir tiempo en cada etapa, conversión).
- **`quotes`**: Nuevos campos:
  - `estimated_value` — Valor estimado del proyecto
  - `closed_value` — Valor cerrado (cuando Won)
  - `closed_at` — Fecha de cierre
  - `gclid` — Google Ads click ID
  - `fbclid` — Meta/Facebook click ID

### FASE 3 — Dashboard ejecutivo (Filament)

4 widgets KPIs en la parte superior:

1. **Leads este mes** — Total + variación % vs mes anterior
2. **Revenue ganado** — Suma de `closed_value` (Won)
3. **Pipeline potencial** — Suma de `estimated_value` (Qualified + Proposal Sent)
4. **Ticket promedio** — Por proyecto cerrado

Más: Funnel, Pipeline, Por fuente/borough/servicio, Leads prioritarios.

### FASE 4 — Reporte mensual automático

**Comando:**
```bash
php artisan report:monthly
php artisan report:monthly --email    # Envía PDF al admin
php artisan report:monthly --month=1 --year=2026
php artisan report:monthly --no-pdf   # Solo consola
```

**Programado:** Día 1 de cada mes a las 06:00, con envío por email.

**Contenido del PDF:**
- Resumen ejecutivo (leads, conversión, revenue)
- Borough dominante
- Servicio dominante
- Desglose por borough y servicio

### FASE 5 — Mejoras avanzadas (implementadas)

- **utm_content**: Capturado junto a utm_source, utm_medium, utm_campaign.
- **Revenue por fuente**: Tabla Leads / Won / Close % / Revenue / Ticket por fuente (lead_source, utm_source).
- **Velocidad comercial**: first_contacted_at, proposal_sent_at — días hasta primer contacto, propuesta y cierre.
- **Score vs Close Rate**: Hot (9-12), Warm (5-8), Cold (0-4) con % Won por rango.
- **Forecast predictivo**: Close rate × Pipeline = Revenue esperado.
- **Borough profundo**: Close rate, ticket promedio, días de cierre por borough.

---

## Usos recomendados

### Por rol

| Rol | Acción | Frecuencia |
|-----|--------|------------|
| **Comercial** | Rellenar `estimated_value` al enviar propuesta | Cada propuesta |
| **Comercial** | Rellenar `closed_value` al cerrar deal (Won) | Cada cierre |
| **Comercial** | Actualizar `stage` conforme avanza el lead | Continuo |
| **Director** | Revisar dashboard KPIs | Diario/semanal |
| **Director** | Revisar reporte PDF mensual | Mensual (día 1) |
| **Marketing** | Analizar borough/servicio dominante para Ads | Mensual |

### Decisiones accionables

| Métrica | Si... | Entonces... |
|---------|-------|-------------|
| Borough Queens convierte 2x mejor | Queens tiene mejor close rate | Aumentar presupuesto Ads en Queens |
| Servicio "renovation" domina | Renovation genera más leads | Crear contenido/Ads específicos |
| Contactados <24h baja | Tasa de respuesta lenta | Mejorar proceso de contacto |
| Pipeline alto, Won bajo | Muchas propuestas sin cerrar | Revisar pricing o follow-up |
| Ticket promedio sube | Proyectos más grandes | Priorizar leads con budget alto |

### Checklist mensual

1. [ ] Recibir y revisar reporte PDF (día 1).
2. [ ] Identificar borough y servicio dominante.
3. [ ] Comparar leads mes actual vs anterior.
4. [ ] Revisar close rate y tiempo de cierre.
5. [ ] Ajustar campañas Ads según datos.
6. [ ] Revisar pipeline potencial vs revenue ganado.

---

## Archivos clave

| Archivo | Descripción |
|---------|-------------|
| `app/Filament/Pages/CustomDashboard.php` | Lógica de KPIs |
| `app/Console/Commands/GenerateMonthlyReport.php` | Reporte mensual |
| `resources/views/reports/monthly.blade.php` | Plantilla PDF |
| `app/Models/Quote.php` | extractTrackingFromRequest (gclid, fbclid) |
| `database/migrations/2026_02_28_*` | quote_stages, campos financieros |
