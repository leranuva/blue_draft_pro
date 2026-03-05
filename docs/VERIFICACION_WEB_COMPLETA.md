# Checklist de verificación — ¿La web se muestra completa?

Usa esta lista para comprobar que todo funciona en https://bluedraft.cc

---

## 1. Página principal (Home)

| Sección | Qué debe verse | ✓ |
|---------|----------------|---|
| **Hero** | Título, subtítulo, botones "Get Free Quote" y teléfono | |
| **About** | Badge, título, descripción, estadísticas (Years, Projects, Satisfaction), imagen | |
| **Projects** | Filtros (All, Residential, Commercial, Renovation), tarjetas de proyectos con slider antes/después | |
| **Services** | Grid de servicios (Kitchen, Bathroom, etc.) con enlaces | |
| **Process** | 4 pasos (How It Works) | |
| **Testimonials** | 3 testimonios con nombre y texto | |
| **Quote** | Formulario en 2 pasos (Step 1: nombre, email, servicio) | |
| **Contact** | Dirección, teléfono, email, mapa, formulario de contacto | |
| **Footer** | Logo, descripción, enlaces, copyright | |

### Elementos globales
| Elemento | ✓ |
|----------|---|
| Navbar con logo y menú (Home, About, Projects, Services, Testimonials, Blog, Contact) | |
| Botón "Get Free Quote" en navbar | |
| Menú móvil (hamburguesa) funciona | |
| Botón WhatsApp flotante (si está configurado) | |
| Barra sticky "Get Free Estimate" en móvil | |

---

## 2. Páginas individuales

| URL | Qué debe verse | ✓ |
|-----|----------------|---|
| `/blog` | Lista de posts del blog | |
| `/blog/{slug}` | Post individual con título, contenido, imagen | |
| `/services/kitchen-remodeling-new-york` | Página del servicio con contenido, FAQs, CTA | |
| `/projects/{slug}` | Proyecto con slider antes/después, descripción | |
| `/construction-company-new-york` | Página pilar NYC con servicios y proyectos | |
| `/cost-calculator` | Calculadora (sq ft, tipo, estimación) | |
| `/free-renovation-guide` | Formulario para descargar guía | |
| `/project-proposal` | Propuesta del proyecto y guía de uso | |

---

## 3. Estilos y diseño

| Comprobación | ✓ |
|--------------|---|
| Colores correctos (azul #003366, beige #CCCC99) | |
| Fuentes cargadas (Inter, Playfair Display) | |
| Animaciones al hacer scroll | |
| Modo oscuro/claro funciona (si aplica) | |
| Diseño responsive en móvil | |
| Imágenes con lazy loading | |

---

## 4. Formularios

| Formulario | Acción | ✓ |
|------------|--------|---|
| **Contacto** | Enviar y verificar que llega el email | |
| **Quote Step 1** | Rellenar nombre, email, servicio → continuar | |
| **Quote Step 2** | Completar teléfono, dirección, etc. → enviar | |
| **Lead magnet** | Email para descargar guía | |

---

## 5. Panel de administración

| URL | Qué debe verse | ✓ |
|-----|----------------|---|
| `/system-bd-access` | Página de login | |
| Tras login | Dashboard con pipeline, métricas, alertas | |
| Menú lateral | Quotes, Projects, Services, Posts, Settings | |
| Site Settings | Hero, About, Contact, Footer, etc. | |

---

## 6. Errores frecuentes

| Problema | Posible causa |
|----------|---------------|
| Página en blanco | Revisar `storage/logs/laravel.log` |
| Estilos no cargan | Subir `public/build/` completo, verificar ASSET_URL |
| Imágenes rotas | Verificar `storage:link`, permisos en `storage/app/public` |
| 403 Forbidden | Document Root debe apuntar a `public/` |
| 500 Error | Permisos en `storage/` y `bootstrap/cache/` (775) |

---

## 7. Comandos de diagnóstico (SSH)

```bash
# Ver logs recientes
tail -50 ~/domains/bluedraft.cc/public_html/storage/logs/laravel.log

# Verificar que build existe
ls -la ~/domains/bluedraft.cc/public_html/public/build/

# Verificar storage link
ls -la ~/domains/bluedraft.cc/public_html/public/storage

# Verificar permisos
ls -la ~/domains/bluedraft.cc/public_html/storage
```

---

## Resumen rápido

**Si falta algo:**
1. Estilos → Subir `public/build/`, añadir ASSET_URL, limpiar caché
2. Imágenes → Crear symlink storage, revisar rutas en BD
3. Secciones vacías → Revisar seeders, datos en panel admin
4. Errores → Revisar `storage/logs/laravel.log`
