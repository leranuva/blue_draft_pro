# Estrategia de Mejora - Blue Draft

Perfecto.
Vamos a convertir Blue Draft en una máquina de captación real con una estrategia por fases, pensada para ejecutarse en producción sin romper lo que ya tienes construido con Laravel + Filament + PostgreSQL.

La clave: orden correcto de implementación.
No todo a la vez. Se construye como un sistema comercial.

## 🧭 VISIÓN GENERAL

Vamos a dividirlo en 6 fases:

1. **Fundación de Conversión**
2. **SEO & Estructura Escalable**
3. **Automatización Comercial**
4. **Tracking & Datos**
5. **Optimización & Remarketing**
6. **Escalado y Dominación Local**

Cada fase construye sobre la anterior.

---

## 🟦 FASE 1 — FUNDACIÓN DE CONVERSIÓN (Semana 1–2)

**Objetivo:** Mejorar conversión inmediata sin cambiar arquitectura profunda.

### 1️⃣ Rediseño estratégico del Home

**Cambios:**
- Propuesta de valor clara en hero
- CTA visible arriba
- Casos reales con resultados
- Sección proceso en 4 pasos
- Garantía fuerte
- CTA repetido cada 2 secciones

### 2️⃣ Simplificar formulario

Divide Quote en 2 pasos:

**Paso 1:**
- Nombre
- Email
- Tipo de servicio

**Paso 2:**
- Resto de campos

**👉 Implementación técnica:**
- Livewire multi-step
- Guardado provisional en base de datos

### 3️⃣ CTA omnipresente

Añadir:
- Botón fijo "Get Free Estimate"
- Botón WhatsApp flotante
- Click-to-call móvil

### 4️⃣ Optimización básica de velocidad

- Lazy loading imágenes
- Convertir imágenes a WebP
- Compresión Vite

---

## 🟦 FASE 2 — SEO Y ESTRUCTURA ESCALABLE (Semana 3–5)

**Objetivo:** Que Google trabaje para ti.

### 1️⃣ Landing Pages por servicio

Crear tabla nueva:

```
services
- id
- title
- slug
- hero_title
- hero_subtitle
- seo_title
- seo_description
- content
- faq_json
- is_active
```

Crear rutas dinámicas:
- `/services/{slug}`

**Ejemplo:**
- `/services/kitchen-remodel`
- `/services/bathroom-renovation`
- `/services/commercial-construction`

**Cada página:**
- 1200–2000 palabras
- FAQs
- CTA fuerte
- Proyectos relacionados

### 2️⃣ Proyectos con slug SEO

Cambiar:
- ~~`/proposal`~~

Por:
- `/projects/{slug}`

**Cada proyecto:**
- Optimizado para ciudad
- Antes/después
- Testimonio asociado

### 3️⃣ Sitemap automático

Generar dinámicamente desde DB.

### 4️⃣ Schema Markup (JSON-LD)

Implementar:
- LocalBusiness
- Service
- FAQ
- Review

---

## 🟦 FASE 3 — AUTOMATIZACIÓN COMERCIAL (Semana 6–8)

**Objetivo:** Que cada lead entre en un sistema de seguimiento.

### 1️⃣ Mejorar modelo Quote

Añadir:
- `lead_source`
- `utm_source`
- `utm_medium`
- `utm_campaign`
- `stage`
- `last_contacted_at`
- `assigned_to`

**Stages:**
- new
- contacted
- qualified
- proposal_sent
- won
- lost

### 2️⃣ Secuencia automática de emails

Puedes usar:
- Brevo
- ActiveCampaign

**Flujo:**
- Email 1 → inmediato
- Email 2 → 24h
- Email 3 → 3 días
- Email 4 → 7 días

### 3️⃣ Recordatorios internos automáticos

**Laravel Jobs:**
- Si stage = new y pasan 24h → notificar admin
- Si stage = proposal_sent y pasan 5 días → follow-up

---

## 🟦 FASE 4 — TRACKING PROFESIONAL (Semana 9)

**Objetivo:** Medir todo.

### Implementar:

**1️⃣ Analytics**
- Google Analytics
- **Track:**
  - Envío formulario
  - Click teléfono
  - Scroll 75%
  - Tiempo en página
  - Servicio visitado

**2️⃣ Tag Manager**
- Google Tag Manager
- Eventos personalizados.

**3️⃣ Pixel Meta**
- Meta Pixel
- Para remarketing.

---

## 🟦 FASE 5 — OPTIMIZACIÓN Y REMARKETING (Semana 10–12)

**Objetivo:** Convertir tráfico que no compró.

### 1️⃣ Campañas de remarketing

**Usuarios que:**
- Visitaron servicio
- No enviaron formulario

**Anuncios:**
- Testimonios
- Antes/después
- Oferta limitada

### 2️⃣ Lead Magnet

Crear:
- `/free-renovation-guide`
- Captura email antes de descargar.

### 3️⃣ Calculadora interactiva

- `/cost-calculator`
- Con Livewire:
  - m²
  - tipo de remodelación
  - rango estimado
- Esto genera leads de alta intención.

---

## 🟦 FASE 6 — ESCALADO (Mes 4+)

**Objetivo:** Sistema autosuficiente.

### 1️⃣ SEO Local fuerte

Crear páginas:
- `/construction-company-miami`
- `/home-remodeling-miami`
- etc.

### 2️⃣ Blog estratégico

**Artículos:**
- Costes reales
- Comparativas
- Errores comunes
- Tendencias 2026

2 artículos por mes mínimo.

### 3️⃣ CDN y performance

**Implementar:**
- Cloudflare
- Cache agresivo
- Protección bots
- WAF

---

## 📊 Cronograma Realista

| Mes | Objetivo |
|-----|----------|
| 1 | Conversión base + SEO estructura |
| 2 | Automatización + tracking |
| 3 | Remarketing + lead magnets |
| 4 | Escalado local + blog |
| 5–6 | Optimización basada en datos |

---

## 🎯 Resultado esperado si se ejecuta bien

- **Mes 1** → +20–40% conversión
- **Mes 3** → Flujo constante de leads
- **Mes 6** → Sistema que genera clientes incluso sin ads
