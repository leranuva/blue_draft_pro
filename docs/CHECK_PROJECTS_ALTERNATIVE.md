# 🔍 Verificar Proyectos e Imágenes (Sin Tinker)

Como `tinker` no funciona en tu servidor (función `shell_exec()` deshabilitada), usa este comando alternativo:

## ✅ Comando Artisan Personalizado

He creado un comando especial para verificar proyectos:

```bash
php artisan projects:check
```

Este comando mostrará:
- ✅ Todos los proyectos en la base de datos
- ✅ Rutas de imágenes (Before y After)
- ✅ Si las imágenes existen físicamente
- ✅ URLs generadas
- ✅ Estado del enlace simbólico
- ✅ Estado de los directorios

## 📋 Ejemplo de Salida

```
Checking projects and images...

Found 6 project(s):

ID: 1 - Kitchen Renovation
  Before Image:
    Path in DB: images/projects/project-1-before.jpg
    Physical: ✅ EXISTS
    URL: https://leranuva.com/storage/images/projects/project-1-before.jpg
  After Image:
    Path in DB: images/projects/project-1-after.jpg
    Physical: ✅ EXISTS
    URL: https://leranuva.com/storage/images/projects/project-1-after.jpg

Storage Link Status:
  ✅ Link exists: /path/to/public/storage
  Target: ../storage/app/public

Image Directories:
  projects: ✅ EXISTS (writable)
  hero: ✅ EXISTS (writable)
  about: ✅ EXISTS (writable)
  testimonials: ✅ EXISTS (writable)
```

## 🔧 Si el Comando No Existe

Si obtienes un error "Command not found", ejecuta:

```bash
# Limpiar cache de comandos
php artisan optimize:clear

# Verificar que el comando está registrado
php artisan list | grep projects
```

## 🐛 Solución de Problemas

### Problema: "Command projects:check is not defined"

**Solución:**
1. Verifica que el archivo existe: `app/Console/Commands/CheckProjects.php`
2. Limpia el cache: `php artisan optimize:clear`
3. Verifica que Laravel puede encontrar el comando: `php artisan list`

### Problema: Las Imágenes No Existen Físicamente

**Solución:**
1. Sube las imágenes desde el panel de administración
2. O sube las imágenes manualmente vía FTP al directorio `storage/app/public/images/projects/`

### Problema: Rutas Incorrectas en la BD

**Solución:**
Las rutas deben ser relativas a `storage/app/public`:
- ✅ Correcto: `images/projects/project-1.jpg`
- ❌ Incorrecto: `/images/projects/project-1.jpg`
- ❌ Incorrecto: `storage/app/public/images/projects/project-1.jpg`

## 📝 Verificación Manual (Alternativa)

Si prefieres verificar manualmente:

### 1. Ver Proyectos en la BD

```bash
# Usar MySQL directamente
mysql -u usuario -p nombre_base_datos -e "SELECT id, title, image_before, image_after FROM projects;"
```

### 2. Ver Imágenes Físicas

```bash
ls -la storage/app/public/images/projects/
```

### 3. Verificar Enlace

```bash
ls -la public/storage
```

### 4. Verificar APP_URL

```bash
grep APP_URL .env
```

---

**Usa `php artisan projects:check` para una verificación completa y rápida.**

