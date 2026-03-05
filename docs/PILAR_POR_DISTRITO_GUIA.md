# Guía para mejorar las páginas pilar por distrito

Documento de referencia para optimizar las páginas pilar por borough (Manhattan, Brooklyn, Queens, Bronx, New Jersey).

---

## 1. Objetivo de cada página pilar

Cada borough debe posicionarse para:

- **"Renovation contractor + borough"**
- **"Apartment renovation + borough"**
- **"Kitchen renovation + borough"**
- **"Bathroom renovation + borough"**

Ejemplos de keywords objetivo:

| Keyword | Valor comercial |
|---------|------------------|
| Kitchen renovation Manhattan | Alto |
| Apartment renovation Brooklyn | Alto |
| Bathroom renovation Queens | Alto |
| Home renovation Bronx | Alto |

En NYC estas búsquedas tienen alto valor comercial ($30k–$150k por proyecto).

---

## 2. Estructura ideal de cada página pilar

Ejemplo: `/manhattan-renovation-contractor` (o `/construction-company-manhattan`)

### 1️⃣ Hero hiper local

**Headline:**
> Apartment Renovation Contractor in Manhattan  
> Licensed NYC Contractors for High-End Apartment Renovations

**Subheadline:**
> We specialize in kitchen, bathroom, and full apartment renovations in Manhattan buildings, including co-ops, condos, and brownstones.

**CTAs:**
- Get Your Renovation Estimate
- Try Cost Calculator

### 2️⃣ Introducción SEO (150–200 palabras)

Optimizada para el borough. Ejemplo Manhattan:

> Renovating an apartment in Manhattan requires experienced contractors who understand NYC building regulations, permits, and co-op board approvals.
>
> At Blue Draft, we provide full-service renovation solutions for Manhattan apartments, including kitchen remodeling, bathroom renovation, and complete apartment transformations.
>
> Our team works with property managers, architects, and building boards to ensure every renovation meets NYC code requirements.

### 3️⃣ Sección "Services in [Borough]"

Lista clara con links internos:

| Servicio | URL ideal |
|----------|-----------|
| Kitchen Renovation | `/kitchen-renovation-manhattan` |
| Bathroom Renovation | `/bathroom-renovation-manhattan` |
| Full Apartment Renovation | `/apartment-renovation-manhattan` |
| Brownstone Renovation | (según borough) |
| Interior Remodeling | — |
| Commercial Renovation | — |

Esto crea cluster SEO.

### 4️⃣ Sección "Typical Renovation Costs in [Borough]"

Conectar con la calculadora. Datos desde `config/cost_calculator.php` → `typical_ranges`.

| Renovation Type | Typical Cost |
|-----------------|--------------|
| Kitchen renovation | $40k – $90k |
| Bathroom renovation | $20k – $45k |
| Full apartment renovation | $100k – $300k |

**CTA:** Use our [NYC Renovation Cost Calculator](/cost-calculator?borough=manhattan)

### 5️⃣ Sección "Building Regulations"

MUY importante para NYC. Explica:

- Permits (DOB)
- Co-op board approval
- Building insurance
- Work hour compliance

### 6️⃣ Proyectos realizados

Mostrar 2–3 ejemplos por borough:

- Upper East Side Apartment Renovation — Budget: $85k, Timeline: 7 weeks, Scope: Kitchen + Bathroom

### 7️⃣ Borough insights

Usar datos de `config/cost_calculator.php` → `borough_insights`:

- Average kitchen renovation: $65k
- Average apartment size: 750 sq ft
- Most popular finish: Premium
- Typical timeline: 6–9 weeks

### 8️⃣ FAQs específicas del borough

Ejemplo:

- **How long does a renovation take in Manhattan?**  
  Most Manhattan apartment renovations take between 5 and 10 weeks depending on scope and building requirements.

- **Do I need permits for renovation in Manhattan?**  
  Yes, many projects require NYC Department of Buildings permits.

### 9️⃣ CTA final fuerte

- Get a Free Manhattan Renovation Quote
- Calculate Your Renovation Cost

---

## 3. Estructura SEO de URLs

### Arquitectura ideal

```
/manhattan-renovation-contractor   ← pillar
  /manhattan-kitchen-renovation
  /manhattan-bathroom-renovation
  /manhattan-apartment-renovation

/brooklyn-renovation-contractor
/queens-renovation-contractor
/bronx-renovation-contractor
/new-jersey-renovation-contractor
```

### URLs actuales (implementadas)

```
/construction-company-manhattan
/construction-company-brooklyn
/construction-company-queens
/construction-company-bronx
/construction-company-new-jersey
```

---

## 4. Evitar contenido duplicado

El mayor error es repetir el mismo contenido. Cambiar por borough:

| Borough | Contexto inmobiliario |
|---------|------------------------|
| Manhattan | Co-ops, condos, luxury apartments |
| Brooklyn | Brownstones, townhouses, duplex |
| Queens | Houses, larger apartments |
| Bronx | Family homes |
| New Jersey | Suburban homes, condos |

- **Precios:** Usar datos de `config/cost_calculator.php`
- **Proyectos ejemplo:** Uno diferente por borough

---

## 5. Conectar con la calculadora

En cada página pilar:

> Try our [renovation cost calculator](/cost-calculator?borough=manhattan) to estimate the cost of your Manhattan project.

El parámetro `?borough=` pre-selecciona el borough en la calculadora.

---

## 6. Schema a añadir

En cada página:

- **LocalBusiness** — Ya existe en layout
- **Service** — Servicios ofrecidos en el borough
- **FAQPage** — FAQs específicas del borough

---

## 7. Internal linking

Cada página debe enlazar a:

- Home
- Cost Calculator (con ?borough=)
- Service pages
- Projects
- Quote form

---

## 8. Longitud ideal

**1.200 – 2.000 palabras** por página pilar. Google premia páginas completas.

---

## 9. Estrategia de contenido futuro

Artículos de blog que enlacen a las páginas pilar:

- How much does a Manhattan renovation cost
- Kitchen renovation permits NYC
- How long does a Brooklyn renovation take

---

## 10. Resultado esperado

Si se implementa correctamente:

- Manhattan renovation contractor
- Brooklyn renovation contractor
- Queens apartment renovation
- Bronx home renovation

Cada keyword puede traer clientes de proyectos $30k–$150k.

---

## 11. Implementación actual

| Elemento | Estado |
|---------|--------|
| Config `pillar_cities.php` | FAQs, building_regulations, context, calculator_borough por borough |
| Página pilar | Hero con 2 CTAs, Services, Typical Costs, Building Regs, Borough Insights, FAQs, CTA final |
| Cost Calculator | `?borough=manhattan` pre-selecciona borough |
| Schema FAQ | Incluido en páginas pilar |
| Seeder | `php artisan db:seed --class=PillarCitySeeder` actualiza títulos y contenido por defecto |
