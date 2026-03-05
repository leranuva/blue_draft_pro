# Módulo Cost Calculator — Documentación

Calculadora de costos de renovación para el mercado NYC. Permite a los visitantes obtener una estimación rápida (ajustada por borough y nivel de acabado) y convertirse en leads cualificados mediante el CTA "Get Exact Quote for This Estimate — Free, No Obligation".

**Características:** contexto de mercado (típico vs tu estimación), timeline dinámico por tipo/borough/finish, borough insights, proyecto similar, indicadores de confianza, barra de progreso.

---

## 1. Resumen

| Aspecto | Detalle |
|---------|---------|
| **Ruta** | `GET /cost-calculator` |
| **Nombre ruta** | `cost-calculator` |
| **Controlador** | `CostCalculatorController@show` |
| **Vista** | `resources/views/pages/cost-calculator.blade.php` |
| **Config** | `config/cost_calculator.php` |
| **Tecnología** | Alpine.js (frontend), Laravel (backend) |

---

## 2. Arquitectura

### Archivos principales

| Archivo | Propósito |
|---------|-----------|
| `app/Http/Controllers/CostCalculatorController.php` | Controlador que carga vista y config |
| `resources/views/pages/cost-calculator.blade.php` | Vista 2 pasos: sqft+type → borough+finish |
| `config/cost_calculator.php` | Rangos base, multiplicadores borough/finish, timelines |
| `config/cta.php` | CTA editable: `calculator` |

### Integración con otros módulos

| Módulo | Integración |
|--------|-------------|
| **HomeController** | Prefill del formulario de quote cuando `?from=calculator` |
| **QuoteController** | Guarda `calculator_budget_min`, `calculator_budget_max`, `lead_source=calculator` |
| **Quote (modelo)** | Scoring dinámico: +2 base, +2 Manhattan, +2 Premium, +2 whole_house, +1 commercial, +1 sqft>500, +1 budget≥100k |
| **Tracking** | Evento `calculator_estimate` y `cost_calculator_view` para remarketing |
| **Sitemap** | URL incluida en `/sitemap.xml` |

---

## 3. Fórmula de cálculo (v2.0)

**Fórmula:** `precio = sqft × base × borough_multiplier × finish_multiplier`

### Rangos base (USD por sq ft) — `config/cost_calculator.php`

| Tipo | Min $/sq ft | Max $/sq ft |
|------|-------------|-------------|
| Kitchen Remodeling | 150 | 350 |
| Bathroom Renovation | 100 | 250 |
| Basement Finishing | 50 | 150 |
| Whole House Renovation | 80 | 200 |
| Commercial | 60 | 180 |

### Multiplicadores por Borough

| Borough | Multiplier |
|---------|------------|
| Manhattan | 1.30 |
| Brooklyn | 1.15 |
| Queens | 1.05 |
| The Bronx | 0.95 |
| New Jersey | 1.00 |

### Multiplicadores por Nivel de Acabado

| Nivel | Multiplier |
|-------|------------|
| Basic | 0.9 |
| Standard | 1.0 |
| Premium | 1.25 |

### Multiplicadores Tipo × Borough (v2.1)

Kitchen en Manhattan ≠ Basement en Manhattan. Matriz en `config/cost_calculator.php`:

| Tipo | Manhattan | Brooklyn | Queens | Bronx | NJ |
|------|-----------|----------|--------|-------|-----|
| Kitchen | 1.35 | 1.18 | 1.08 | 0.98 | 1.00 |
| Bathroom | 1.32 | 1.15 | 1.05 | 0.95 | 1.00 |
| Basement | 1.20 | 1.10 | 1.02 | 0.92 | 1.00 |
| Whole House | 1.28 | 1.12 | 1.04 | 0.94 | 1.00 |
| Commercial | 1.25 | 1.12 | 1.03 | 0.93 | 1.00 |

### Ajuste por Sqft (economías de escala)

- **< 150 sqft:** +10% (proyectos pequeños = mayor costo/sqft)
- **> 800 sqft:** -8% (economías de escala)

### Timeline dinámico (Type × Borough × Finish)

`config/cost_calculator.php` → `timelines_dynamic`. Ejemplo: Kitchen Manhattan Premium: 7–10 weeks, Bathroom Queens Basic: 3–4 weeks.

### Rangos típicos de mercado (contexto)

`config/cost_calculator.php` → `typical_ranges`. Se muestra al usuario: "Typical Kitchen renovation in Brooklyn: $25k–$70k. Your estimate falls within the typical range."

### Borough insights

`config/cost_calculator.php` → `borough_insights`. Datos por borough: avg_kitchen, avg_sqft, avg_timeline, popular_finish.

### Proyectos similares (ejemplos)

`config/cost_calculator.php` → `similar_project_examples`. Se muestra un proyecto similar debajo del resultado para aumentar confianza.

---

## 4. Flujo de usuario (2 pasos)

1. **Visita** `/cost-calculator`
2. **Step 1:** Introduce sq ft y tipo de renovación → "Continue to refine estimate" (barra de progreso 50%)
3. **Step 2:** Selecciona borough y nivel de acabado (barra 100%)
4. **Ve** rango estimado con:
   - Contexto: "Typical Kitchen in Brooklyn: $25k–$70k. Your estimate falls within the typical range."
   - Indicadores de confianza: ✔ NYC data, ✔ Labor/materials/permits, ✔ Licensed contractors
   - Timeline dinámico (ej. 6–8 weeks para Kitchen Manhattan Standard)
   - Borough insights: "Renovation trends in Brooklyn — Average kitchen: $42k, Most popular finish: Standard"
   - Proyecto similar: "Kitchen Renovation — Brooklyn Heights — $45k • 6 weeks"
5. **Hace clic** en "Get Exact Quote for This Estimate — Free, No Obligation"
6. **Redirige** a `/#quote` con parámetros:
   - `from=calculator`
   - `budget`, `service`, `budget_min`, `budget_max`
   - `estimated_value` (punto medio del rango, para pipeline)
   - `calc_sqft`, `calc_type`, `calc_borough`, `calc_finish`, `calc_version`
8. **Formulario de quote** pre-rellenado con todos los datos
9. **Al enviar** → Quote con `lead_source=calculator`, `estimated_value`, y scoring dinámico

---

## 5. Mapeo tipo → servicio y presupuesto

### Tipo de renovación → service_type (Quote)

| Tipo calculadora | service_type en Quote |
|------------------|------------------------|
| kitchen | renovation |
| bathroom | renovation |
| basement | renovation |
| whole_house | residential |
| commercial | commercial |

### Rango estimado → estimated_budget (Quote)

| Condición | Valor budget |
|-----------|--------------|
| max ≤ $25,000 | under-25k |
| min ≥ $100,000 | over-100k |
| min ≥ $50,000 | 50k-100k |
| Resto | 25k-50k |

---

## 6. Parámetros de prefill

Cuando el usuario llega desde la calculadora, `HomeController` pasa `quotePrefill`:

```php
$quotePrefill = [
    'service' => $request->query('service', ''),
    'budget' => $request->query('budget', ''),
    'budget_min' => $request->query('budget_min', ''),
    'budget_max' => $request->query('budget_max', ''),
];
```

La vista `home.blade.php` usa estos valores para pre-rellenar el formulario de quote (Alpine.js).

---

## 7. Campos Quote relacionados

| Campo | Origen | Uso |
|-------|--------|-----|
| `calculator_budget_min` | Parámetro `budget_min` | Presupuesto mínimo estimado |
| `calculator_budget_max` | Parámetro `budget_max` | Presupuesto máximo estimado |
| `calculator_sqft` | Parámetro `calc_sqft` | Sq ft del proyecto |
| `calculator_type` | Parámetro `calc_type` | kitchen, bathroom, etc. |
| `calculator_borough` | Parámetro `calc_borough` | manhattan, brooklyn, etc. |
| `calculator_finish_level` | Parámetro `calc_finish` | basic, standard, premium |
| `calculator_algorithm_version` | Parámetro `calc_version` | v2.1 para analytics |
| `calculation_hash` | Hash de sqft+type+borough+finish+version | Duplicados, patrones, recálculos |
| `internal_cost_estimate` | estimated_value × cost_ratio[type][borough] | Costo interno |
| `expected_margin` | estimated_value - internal_cost | Margen esperado |
| `estimated_value` | Punto medio del rango | Pipeline y forecast |
| `lead_source` | `'calculator'` | Segmentación y ROI |
| `lead_score` | **Scoring dinámico:** +2 base, +2 Manhattan, +2 Premium, +2 whole_house, +1 commercial, +1 sqft>500, +1 budget≥100k | Priorización |

---

## 8. Costo interno y margen

Para leads desde calculadora:

- `internal_cost_estimate` = `estimated_value × cost_ratio` (default 0.75)
- `expected_margin` = `estimated_value - internal_cost_estimate`

Configurable en `config/cost_calculator.php` → `cost_ratio`.

**Dashboard:** Margen por fuente y por borough (calculadora).

---

## 9. Mejoras de conversión (CRO)

| Elemento | Descripción |
|----------|-------------|
| **Contexto de mercado** | Compara la estimación del usuario con el rango típico (type × borough). Si cae dentro: "Your estimate falls within the typical range." |
| **Indicadores de confianza** | ✔ Estimate based on NYC renovation data • ✔ Includes labor, materials, permits • ✔ Reviewed by licensed contractors |
| **Timeline dinámico** | Más preciso que el promedio: Kitchen Manhattan Premium 7–10 weeks vs Bathroom Queens Basic 3–4 weeks |
| **Borough insights** | "Renovation trends in Queens — Average kitchen: $38k, Most popular finish: Standard, Average timeline: 5 weeks" |
| **Proyecto similar** | Muestra un ejemplo real (título, ubicación, coste, timeline) según type y borough |
| **Barra de progreso** | Step 1 of 2 con barra visual (50% / 100%) para reducir abandono |
| **CTA mejorado** | "Get Exact Quote for This Estimate — Free, No Obligation" (menos fricción que "Lock This Estimate") |

---

## 10. Tracking y eventos

### Eventos enviados

| Evento | Cuándo | Datos |
|--------|--------|-------|
| `cost_calculator_view` | Visita la página | page_type: cost_calculator |
| `calculator_estimate` | Primera vez que se calcula un rango (sqft > 0) | sqft, type, borough, finish, min, max |
| `calculator_step_1_completed` | Clic "Continue to refine estimate" | sqft, type |
| `calculator_step_2_completed` | Llega a Step 2 (borough + finish) | borough, finish |
| `calculator_cta_clicked` | Clic "Get Exact Quote for This Estimate" | min, max, sqft, type, borough, finish |

### Configuración en vista

```html
<script>window.__trackingData = { page_type: 'cost_calculator', content_name: 'cost_calculator' };</script>
```

Usado por `resources/js/tracking.js` para ViewContent (remarketing).

---

## 11. SEO y meta

| Meta | Valor |
|------|-------|
| Title | NYC Renovation Cost Calculator \| Blue Draft |
| Description | Estimate your renovation costs in NYC. Kitchen, bathroom, basement, whole house, and commercial. Borough-adjusted pricing with typical market ranges. |
| Canonical | `route('cost-calculator')` |
| Schema | BreadcrumbList (Home → Cost Calculator) |

---

## 12. Configuración

### CTA de la calculadora

Editable en `config/cta.php`:

```php
'calculator' => 'Get Exact Quote for This Estimate — Free, No Obligation',
```

O desde HeroSettings si se usa `hero_cta_lock_estimate`.

### Configuración adicional (config/cost_calculator.php)

| Clave | Propósito |
|-------|-----------|
| `timelines_dynamic` | Timeline por tipo × borough × finish (ej. kitchen.manhattan.premium) |
| `typical_ranges` | Rangos típicos por tipo × borough para contexto de mercado |
| `borough_insights` | avg_kitchen, avg_sqft, avg_timeline, popular_finish por borough |
| `similar_project_examples` | Array de proyectos ejemplo (type, borough, title, location, cost, timeline) |

### Contacto

Teléfono y WhatsApp se cargan desde `Settings` (group: contact) para enlaces de contacto en la página.

---

## 12. Rutas y enlaces

| Ubicación | Enlace |
|-----------|--------|
| Footer (Quick Links) | `route('cost-calculator')` |
| Sitemap | Incluido en `SitemapController` |
| Lead magnet guide | Enlace a "Download our free renovation guide" |

---

## 14. Tests

| Test | Archivo | Descripción |
|------|---------|-------------|
| `test_cost_calculator_returns_200` | `tests/Feature/RoutesTest.php` | Verifica que `/cost-calculator` devuelve 200 |

---

## 14. Scoring predictivo (futuro)

Ver `docs/SCORING_PREDICTIVO_FUTURO.md` para ajustar scoring según close_rate real después de 3–6 meses.

---

## 16. Evaluación Ejecutiva (v2.1)

### Arquitectura técnica

| Área | Evaluación |
|------|------------|
| Arquitectura modular | 9.5 |
| Configuración desacoplada | 9.5 |
| Integración CRM | 9 |
| Tracking eventos | 9 |
| Versionado algoritmo | 9.5 |

La presencia de `algorithm_version`, `calculation_hash`, `internal_cost_estimate` y `expected_margin` convierte la calculadora en un sistema analítico, no solo un widget.

### Lo que se hizo extremadamente bien

1. **Contexto de mercado** — "Typical Kitchen renovation in Brooklyn: $25k–$70k" reduce fricción psicológica.
2. **Timeline dinámico** — Añade percepción de precisión (ej. Kitchen Manhattan Premium: 7–10 weeks).
3. **Borough insights** — Convierte la calculadora en un mini informe de mercado.
4. **Similar project** — Aumenta conversión al mostrar un ejemplo real del tipo/borough.
5. **Lead scoring avanzado** — Permite priorizar leads automáticamente en el CRM.

### Evaluación de conversión

| Elemento | Estado |
|----------|--------|
| UX | 8 |
| Persuasión | 9 |
| Confianza | 9 |
| Lead capture | 8 |
| Remarketing | 9 |

**Potencial:** 8%–15% de conversión a leads si el tráfico es cualificado (muy alto para contractors).

### Mejoras futuras (no implementadas)

| Mejora | Descripción |
|--------|-------------|
| **Estimaciones anónimas (data mining)** | Tabla `calculator_sessions` (session_id, sqft, type, borough, finish, estimate_min, estimate_max, timestamp) para saber qué proyectos buscan los usuarios. Permite contenido SEO tipo "Most searched renovation type in Queens: Bathroom remodels under 200 sqft". |
| **Páginas SEO automáticas** | URLs como `/kitchen-renovation-cost-manhattan`, `/bathroom-renovation-cost-brooklyn` con contenido + calculadora embebida. Ataca keywords con mucho tráfico local. |
| **Remarketing por estimación** | Audiencias: usuarios que calcularon >$50k, o Manhattan kitchen. Anuncios segmentados aumentan ROAS. |

### Disclaimer (implementado)

Debajo del resultado se muestra:

> *Estimates are based on typical NYC renovation data. Final costs depend on layout, materials, and building requirements.*

Evita malentendidos y expectativas de precio exacto.

---

## 17. Diagrama de flujo

```
/cost-calculator
    │
    ├─► Step 1: sqft + tipo (barra progreso 50%)
    │
    ├─► Step 2: borough + finish (barra 100%)
    │
    ├─► Alpine.js calcula min/max (sqft × precio por sqft)
    │
    ├─► Muestra: contexto típico, trust indicators, timeline dinámico, borough insights, proyecto similar
    │
    ├─► Clic "Get Exact Quote for This Estimate — Free, No Obligation"
    │       │
    │       └─► Redirige a /?from=calculator&budget=...&service=...&budget_min=...&budget_max=...#quote
    │
    └─► HomeController detecta from=calculator
            │
            └─► quotePrefill → formulario pre-rellenado
                    │
                    └─► Usuario envía → QuoteController
                            │
                            └─► Quote con lead_source=calculator, estimated_value, internal_cost, expected_margin, scoring dinámico
                                    (incl. +2 whole_house, +1 commercial)
```
