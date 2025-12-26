# ✅ Verificación de Imágenes - Hostinger

## 🔍 Verificación Completa

Ejecuta estos comandos para verificar que todo está funcionando:

### 1. Verificar Enlace Simbólico

```bash
ls -la public/storage
```

**✅ Resultado esperado:**
```
lrwxrwxrwx 1 usuario grupo 21 fecha public/storage -> ../storage/app/public
```

### 2. Verificar Directorios

```bash
ls -la storage/app/public/images/
```

**✅ Debe mostrar:**
- `projects/`
- `hero/`
- `about/`
- `testimonials/`

### 3. Verificar Imágenes en Proyectos

```bash
ls -la storage/app/public/images/projects/
```

**✅ Debe mostrar las imágenes de los proyectos** (si hay proyectos con imágenes subidas).

### 4. Verificar Proyectos en Base de Datos

```bash
php artisan tinker
```

Luego en tinker, ejecuta:

```php
// Ver todos los proyectos
$projects = App\Models\Project::all(['id', 'title', 'image_before', 'image_after']);
foreach($projects as $project) {
    echo "ID: {$project->id} - {$project->title}\n";
    echo "  Before: " . ($project->image_before ?? 'NULL') . "\n";
    echo "  After: " . ($project->image_after ?? 'NULL') . "\n";
    if($project->image_after) {
        echo "  URL: " . Storage::disk('public')->url($project->image_after) . "\n";
    }
    echo "\n";
}
```

### 5. Verificar APP_URL

```bash
grep APP_URL .env
```

**✅ Debe mostrar:**
```
APP_URL=https://leranuva.com
```

**⚠️ IMPORTANTE:** No debe terminar con `/`.

### 6. Probar Acceso Directo a una Imagen

Si tienes una imagen en `storage/app/public/images/projects/project-1.jpg`, prueba acceder directamente:

```
https://leranuva.com/storage/images/projects/project-1.jpg
```

- **Si carga:** ✅ La configuración está correcta
- **Si da 404:** ❌ Hay un problema con el enlace simbólico o la ruta

### 7. Verificar Permisos

```bash
ls -la storage/app/public/
```

**✅ Los permisos deben ser `drwxrwxr-x` (775)**

## 🐛 Si las Imágenes Aún No Se Muestran

### Problema 1: No Hay Imágenes en los Proyectos

**Solución:** Sube imágenes desde el panel de administración:
1. Ve a `/system-bd-access`
2. Navega a **Projects**
3. Edita un proyecto o crea uno nuevo
4. Sube las imágenes "Before" y "After"

### Problema 2: Las Imágenes Existen pero No Se Muestran

**Verificar rutas en la BD:**
```bash
php artisan tinker
```

```php
$project = App\Models\Project::first();
echo "Ruta en BD: " . $project->image_after . "\n";
echo "URL generada: " . Storage::disk('public')->url($project->image_after) . "\n";
echo "Ruta física: " . storage_path('app/public/' . $project->image_after) . "\n";
echo "¿Existe?: " . (file_exists(storage_path('app/public/' . $project->image_after)) ? 'SÍ' : 'NO') . "\n";
```

### Problema 3: Error 404 al Acceder Directamente

**Verificar:**
1. El enlace simbólico existe: `ls -la public/storage`
2. La imagen existe físicamente: `ls -la storage/app/public/images/projects/`
3. Los permisos son correctos: `chmod -R 775 storage/app/public`

### Problema 4: APP_URL Incorrecto

**Solución:**
```bash
# Editar .env
nano .env

# Cambiar APP_URL a:
APP_URL=https://leranuva.com

# Regenerar cache
php artisan config:cache
```

## 📝 Checklist Final

- [ ] Enlace simbólico `public/storage` existe y apunta correctamente
- [ ] Directorios `storage/app/public/images/*` existen
- [ ] Permisos configurados (775)
- [ ] `APP_URL` en `.env` está correcto (sin `/` al final)
- [ ] Cache regenerado
- [ ] Proyectos tienen imágenes asignadas en la BD
- [ ] Las imágenes existen físicamente en `storage/app/public/images/projects/`
- [ ] Acceso directo a una imagen funciona

## 🎯 Próximos Pasos

1. **Si no hay proyectos con imágenes:**
   - Sube imágenes desde el panel de administración
   - Crea proyectos nuevos con imágenes

2. **Si las imágenes existen pero no se muestran:**
   - Verifica las rutas en la base de datos
   - Verifica que las rutas sean relativas: `images/projects/nombre.jpg`
   - No deben empezar con `/` ni incluir `storage/app/public`

3. **Si todo está correcto pero aún no funciona:**
   - Limpia la cache del navegador
   - Verifica los logs: `tail -f storage/logs/laravel.log`
   - Prueba en modo incógnito

---

**Si después de seguir estos pasos las imágenes aún no se muestran, comparte los resultados de las verificaciones para diagnosticar el problema específico.**

