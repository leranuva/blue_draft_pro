# Blue Draft — Configuración Cloudflare (CDN)

**Objetivo:** Cache, protección bots y WAF para mejorar rendimiento y seguridad.

---

## 1. Resumen de lo implementado

| Item | Estado | Descripción |
|------|--------|-------------|
| Cache headers middleware | ✅ | Headers `Cache-Control` en respuestas públicas |
| Documentación Cloudflare | ✅ | Este documento |

---

## 2. Cache Headers (Middleware)

El middleware `App\Http\Middleware\CacheHeaders` añade headers a las respuestas:

| Tipo | Duración | Uso |
|------|----------|-----|
| `page` | 1 hora | Páginas HTML públicas |
| `sitemap` | 1 hora | `/sitemap.xml` |
| Admin | no-store | Rutas `/system-bd-access*` |

- `max-age`: Tiempo que el navegador puede cachear.
- `s-maxage`: Tiempo que Cloudflare (u otro CDN) puede cachear.
- `stale-while-revalidate`: Permite servir contenido antiguo mientras se revalida en segundo plano.

---

## 3. Configuración Cloudflare

### 3.1 Añadir el sitio

1. Entra en [Cloudflare Dashboard](https://dash.cloudflare.com).
2. **Add site** → Introduce tu dominio.
3. Elige el plan (Free es suficiente para empezar).
4. Actualiza los nameservers en tu registrador de dominios.

### 3.2 Page Rules / Cache Rules (recomendado)

En **Caching** → **Cache Rules**:

- **Rule 1:** Para `/sitemap.xml` → Cache Level: Standard, Edge TTL: 1 hour.
- **Rule 2:** Para páginas HTML (`/`, `/services/*`, `/blog/*`, etc.) → Cache Level: Standard, Edge TTL: 1 hour.
- **Rule 3:** Para `/system-bd-access/*` → Cache Level: Bypass (no cachear admin).

### 3.3 Protección Bots

En **Security** → **Bots**:

- Activa **Bot Fight Mode** (plan Free) o **Super Bot Fight Mode** (plan Pro).
- Reduce tráfico de bots maliciosos y crawlers abusivos.

### 3.4 WAF (Web Application Firewall)

En **Security** → **WAF**:

- **Plan Free:** Reglas básicas limitadas.
- **Plan Pro:** Más reglas y control.

Reglas recomendadas:

- **Managed Rules:** Activa el conjunto "Cloudflare Managed Ruleset".
- **Rate Limiting:** Limita el número de requests por IP (ej. 100 req/min para formularios).

### 3.5 SSL/TLS

En **SSL/TLS**:

- Modo: **Full (strict)** si tu servidor tiene certificado válido.
- **Always Use HTTPS:** Activado.

---

## 4. Verificación

1. **Headers:** Usa las DevTools del navegador (pestaña Network) y comprueba que las respuestas incluyen `Cache-Control`.
2. **Cloudflare:** En el dashboard, verifica que el tráfico pasa por Cloudflare (icono naranja en la columna "Status").
3. **Cache:** Tras la primera visita, las siguientes deberían ser más rápidas (servidas desde cache).

---

## 5. Purga de cache

Si actualizas contenido y necesitas que se refleje de inmediato:

- **Cloudflare Dashboard** → **Caching** → **Configuration** → **Purge Everything**.
- O purga URLs específicas en **Purge by URL**.

---

*Documento actualizado — Blue Draft — Febrero 2025*
