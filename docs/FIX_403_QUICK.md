# 🔧 Solución Rápida: Error 403 Forbidden

## ✅ Comando Correcto (Ya estás en public_html)

Si ya estás en el directorio `public_html`, crea el `.htaccess` directamente:

```bash
# Crear .htaccess en el directorio actual (public_html)
cat > .htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L]
</IfModule>
EOF

# Verificar que se creó
cat .htaccess
ls -la .htaccess
```

## 🔍 Verificar Ubicación

```bash
# Verificar dónde estás
pwd
# Debería mostrar: /home/u671466050/domains/leranuva.com/public_html

# Verificar que el .htaccess se creó
ls -la .htaccess
```

## ✅ Alternativa: Cambiar Document Root en Hostinger

**Mejor solución**: Cambiar el Document Root en el panel de Hostinger:

1. Panel de Hostinger → **"Dominios"** o **"Manage"**
2. Selecciona `leranuva.com`
3. Busca **"Document Root"** o **"Public HTML Path"**
4. Cambia de: `/public_html`
5. A: `/public_html/public`
6. Guarda y espera 2-3 minutos

Esto es mejor que usar el `.htaccess` de redirección.

## 🧪 Probar

Después de crear el `.htaccess` o cambiar el Document Root:

1. Espera 2-3 minutos
2. Visita: `https://leranuva.com`
3. Debería cargar el sitio

---

**Nota**: Si cambias el Document Root en Hostinger, NO necesitas el `.htaccess` en `public_html`.

