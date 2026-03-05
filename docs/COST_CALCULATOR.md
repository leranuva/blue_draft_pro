# Módulo Cost Calculator — Documentación

Calculadora de costos de renovación para el mercado NYC. Permite a los visitantes obtener una estimación rápida (ajustada por borough y nivel de acabado) y convertirse en leads cualificados mediante el CTA "Lock This Estimate".

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
| **Quote (modelo)** | +3 lead score si viene de calculadora (`calculator_budget_min` y `calculator_budget_max` presentes) |
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

---

## 4. Flujo de usuario (2 pasos)

1. **Visita** `/cost-calculator`
2. **Step 1:** Introduce sq ft y tipo de renovación → "Continue to refine estimate"
3. **Step 2:** Selecciona borough y nivel de acabado
4. **Ve** rango estimado con desglose (Includes: Labor • Materials • Permits • Project management)
5. **Texto:** "Estimates adjusted for local NYC market conditions" + timeline promedio
6. **Hace clic** en "Lock This Estimate — Send to Our Project Manager"
7. **Redirige** a `/#quote` con parámetros:
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
| `lead_score` | **Scoring dinámico:** +2 base, +2 Manhattan, +2 Premium, +1 sqft>500, +1 budget≥100k | Priorización |

---

## 8. Costo interno y margen

Para leads desde calculadora:

- `internal_cost_estimate` = `estimated_value × cost_ratio` (default 0.75)
- `expected_margin` = `estimated_value - internal_cost_estimate`

Configurable en `config/cost_calculator.php` → `cost_ratio`.

**Dashboard:** Margen por fuente y por borough (calculadora).

---

## 9. Tracking y eventos

### Eventos enviados

| Evento | Cuándo | Datos |
|--------|--------|-------|
| `cost_calculator_view` | Visita la página | page_type: cost_calculator |
| `calculator_estimate` | Primera vez que se calcula un rango (sqft > 0) | sqft, type, borough, finish, min, max |
| `calculator_step_1_completed` | Clic "Continue to refine estimate" | sqft, type |
| `calculator_step_2_completed` | Llega a Step 2 (borough + finish) | borough, finish |
| `calculator_cta_clicked` | Clic "Lock This Estimate" | min, max, sqft, type, borough, finish |

### Configuración en vista

```html
<script>window.__trackingData = { page_type: 'cost_calculator', content_name: 'cost_calculator' };</script>
```

Usado por `resources/js/tracking.js` para ViewContent (remarketing).

---

## 10. SEO y meta

| Meta | Valor |
|------|-------|
| Title | NYC Renovation Cost Calculator \| Blue Draft |
| Description | Estimate your renovation costs in New York City. Kitchen, bathroom, basement, and commercial remodeling cost ranges. |
| Canonical | `route('cost-calculator')` |
| Schema | BreadcrumbList (Home → Cost Calculator) |

---

## 11. Configuración

### CTA de la calculadora

Editable en `config/cta.php`:

```php
'calculator' => 'Lock This Estimate — Send to Our Project Manager for Exact Quote',
```

O desde HeroSettings si se usa `hero_cta_lock_estimate`.

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

## 13. Tests

| Test | Archivo | Descripción |
|------|---------|-------------|
| `test_cost_calculator_returns_200` | `tests/Feature/RoutesTest.php` | Verifica que `/cost-calculator` devuelve 200 |

---

## 14. Scoring predictivo (futuro)

Ver `docs/SCORING_PREDICTIVO_FUTURO.md` para ajustar scoring según close_rate real después de 3–6 meses.

---

## 15. Diagrama de flujo

```
/cost-calculator
    │
    ├─► Usuario introduce sqft + tipo
    │
    ├─► Alpine.js calcula min/max (sqft × precio por sqft)
    │
    ├─► Clic "Lock This Estimate"
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
```
