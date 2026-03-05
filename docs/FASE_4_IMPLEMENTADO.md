# Fase 4 — Tracking Profesional (Implementado)

Resumen de los cambios realizados en la **Fase 4**.

---

## 1. Configuración

### config/tracking.php
- `gtm_id` — Google Tag Manager (GTM-XXXXXXX)
- `ga4_id` — Google Analytics 4 (G-XXXXXXXXXX), usado cuando no hay GTM
- `meta_pixel_id` — Meta Pixel para remarketing, usado cuando no hay GTM

### Variables de entorno (.env)
```
GTM_ID=GTM-XXXXXXX
GA4_MEASUREMENT_ID=G-XXXXXXXXXX
META_PIXEL_ID=123456789
```

**Recomendación:** Usar GTM como contenedor. Configurar GA4 y Meta Pixel dentro de GTM. Si solo se define `GTM_ID`, GTM carga todo.

---

## 2. Scripts cargados

### Componente `components/tracking.blade.php`
- **GTM:** Carga el contenedor cuando `GTM_ID` está definido
- **GA4 directo:** Si no hay GTM y `GA4_MEASUREMENT_ID` está definido
- **Meta Pixel directo:** Si no hay GTM y `META_PIXEL_ID` está definido
- **dataLayer:** Inicializado para todos los eventos

### GTM noscript
- Iframe de GTM en el `<body>` para usuarios sin JavaScript

---

## 3. Eventos trackeados

| Evento | Cuándo | dataLayer | Meta Pixel |
|--------|--------|-----------|------------|
| `phone_click` | Click en enlace `tel:` | ✓ | Contact |
| `form_submit` | Submit de formulario quote/contact | ✓ | Lead |
| `scroll_75_percent` | Usuario hace scroll 75% de la página | ✓ | — |
| `time_on_page_30s` | 30 segundos en página | ✓ | — |
| `service_view` | Visita página de servicio | ✓ | ViewContent |

### service_view
- Se dispara en `/services/{slug}`
- Incluye: `service_slug`, `service_title`
- Se usa `window.__trackingData` inyectado por Blade

---

## 4. Archivos

| Archivo | Descripción |
|---------|-------------|
| `config/tracking.php` | Configuración de tracking |
| `resources/views/components/tracking.blade.php` | Scripts GTM, GA4, Meta |
| `resources/js/tracking.js` | Lógica de eventos (importado en app.js) |
| `resources/views/layouts/app.blade.php` | Inclusión de tracking y GTM noscript |
| `resources/views/services/show.blade.php` | Push de `__trackingData` para service_view |

---

## 5. Configuración en GTM (recomendado)

1. Crear contenedor GTM
2. Añadir etiqueta GA4 con Measurement ID
3. Añadir etiqueta Meta Pixel
4. Crear disparadores para eventos personalizados:
   - `form_submit` → GA4 event + Meta Lead
   - `phone_click` → GA4 event + Meta Contact
   - `service_view` → GA4 event + Meta ViewContent
   - `scroll_75_percent` → GA4 event
   - `time_on_page_30s` → GA4 event

---

*Fase 4 — docs/ — Febrero 2025*
