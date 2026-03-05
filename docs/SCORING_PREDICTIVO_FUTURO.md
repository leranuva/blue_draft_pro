# Scoring Predictivo — Guía Futura

## Objetivo

Después de 3–6 meses de datos reales, ajustar el lead scoring para que sea **predictivo** (basado en close_rate histórico) en lugar de arbitrario.

**Optimización:** No solo probabilidad de cierre, sino **margen esperado × probabilidad de cierre** (revenue optimization).

---

## Datos a cruzar

| Campo calculadora | Campo resultado | Análisis |
|-------------------|-----------------|----------|
| `calculator_borough` | `close_rate` | ¿Manhattan Premium convierte más que Bronx Basic? |
| `calculator_finish_level` | `close_rate` | ¿Premium tiene mejor margen? |
| `calculator_type` | `close_rate` | ¿Kitchen vs Basement? |
| `lead_source` | `close_rate` | ¿Calculator vs website vs google? |

---

## Proceso recomendado

1. **Exportar datos** (3–6 meses):
   - Quotes con `calculator_borough`, `calculator_finish_level`, `calculator_type`, `lead_source`
   - `stage` (won/lost) para calcular close_rate

2. **Calcular close_rate por segmento**:
   ```sql
   -- Ejemplo: close_rate por calculator_borough
   SELECT calculator_borough,
          COUNT(*) as total,
          SUM(CASE WHEN stage = 'won' THEN 1 ELSE 0 END) as won,
          ROUND(100.0 * SUM(CASE WHEN stage = 'won' THEN 1 ELSE 0 END) / COUNT(*), 1) as close_rate_pct
   FROM quotes
   WHERE calculator_borough IS NOT NULL
   GROUP BY calculator_borough;
   ```

3. **Mapear close_rate → puntos de score**:
   - Ejemplo: Si Manhattan tiene 45% close_rate y Bronx 20%, asignar +2 a Manhattan, +0 a Bronx.
   - Crear matriz `config/scoring_weights.php`:
   ```php
   'calculator_borough' => [
       'manhattan' => 2,
       'brooklyn' => 1,
       'queens' => 1,
       'bronx' => 0,
       'nj' => 0,
   ],
   'calculator_finish_level' => [
       'premium' => 2,
       'standard' => 1,
       'basic' => 0,
   ],
   ```

4. **Integrar en `Quote::calculateLeadScore()`**:
   - Reemplazar valores fijos por `config('scoring_weights.calculator_borough')[$borough] ?? 0`
   - Revisar y actualizar cada 3–6 meses con nuevos datos

---

## Config actual vs futuro

| Actual | Futuro |
|--------|--------|
| +2 Manhattan (fijo) | +N según close_rate histórico |
| +2 Premium (fijo) | +N según close_rate histórico |
| +1 sqft>500 | Mantener o ajustar por correlación |
| +1 budget≥100k | Mantener o ajustar por correlación |

---

## Notas

- El scoring actual es una **aproximación inicial** basada en heurísticas de mercado.
- Con datos reales, el scoring puede volverse **predictivo** y mejorar priorización comercial.
- Revisar `docs/SISTEMA_METRICAS_EJECUTIVAS.md` para métricas de validación.
