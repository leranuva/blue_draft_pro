# 🖼️ Solución: Imágenes No Se Cargan

Guía para diagnosticar y solucionar problemas con imágenes en el proyecto.

## 🔍 Diagnóstico

Ejecuta estos comandos en SSH para diagnosticar:

```bash
# 1. Verificar que el enlace simbólico existe
ls -la public/storage
# Debería mostrar: public/storage -> ../storage/app/public

# 2. Verificar que el directorio de storage existe
ls -la storage/app/public
ls -la storage/app/public/images/projects

# 3. Verificar permisos
ls -ld storage/app/public
ls -ld public/storage

# 4. Verificar que hay imágenes en la base de datos
php artisan tinker
>>> \App\Models\Project::whereNotNull('image_before')->orWhereNotNull('image_after')->count()
# Debería mostrar el número de proyectos con imágenes
>>> exit

# 5. Verificar una URL de imagen
php artisan tinker
>>> $project = \App\Models\Project::first();
>>> $project->image_before
>>> \Storage::disk('public')->url($project->image_before ?? 'test')
>>> exit
```

## ✅ Solución 1: Verificar y Recrear Enlace Simbólico

```bash
# Eliminar enlace si existe
rm -f public/storage

# Crear enlace simbólico manualmente
ln -s ../storage/app/public public/storage

# Verificar
ls -la public/storage
# Debe mostrar: public/storage -> ../storage/app/public

# Crear directorio si no existe
mkdir -p storage/app/public/images/projects

# Configurar permisos
chmod -R 775 storage/app/public
chmod 755 public/storage
```

## ✅ Solución 2: Verificar Assets Compilados (CSS/JS)

Las imágenes pueden no verse si los assets no están cargando:

```bash
# Verificar que los assets compilados existen
ls -la public/build
ls -la public/build/assets

# Si no existen, necesitas compilarlos (en local y subirlos)
# O compilar en el servidor si tienes Node.js:
npm install
npm run build
```

## ✅ Solución 3: Verificar Proyectos en Base de Datos

Los proyectos del seeder no incluyen imágenes. Necesitas agregarlas:

### Opción A: Desde el Panel de Administración

1. Accede a: `https://leranuva.com/system-bd-access`
2. Login: `marcin@bluedraft.org` / `BlueDraft2024!`
3. Ve a **"Projects"**
4. Edita cada proyecto y sube imágenes "Before" y "After"

### Opción B: Subir Imágenes Manualmente

```bash
# Crear directorio para imágenes
mkdir -p storage/app/public/images/projects

# Subir imágenes usando FTP o File Manager de Hostinger
# Las imágenes deben estar en: storage/app/public/images/projects/

# Luego actualizar la base de datos con las rutas
php artisan tinker
>>> $project = \App\Models\Project::first();
>>> $project->update(['image_before' => 'images/projects/before1.jpg', 'image_after' => 'images/projects/after1.jpg']);
>>> exit
```

## ✅ Solución 4: Verificar APP_URL en .env

El `APP_URL` debe ser correcto para que las URLs de las imágenes funcionen:

```bash
# Verificar APP_URL
grep APP_URL .env
# Debe mostrar: APP_URL=https://leranuva.com

# Si está mal, edítalo:
nano .env
# Cambia APP_URL a: https://leranuva.com

# Limpiar y recachear
php artisan config:clear
php artisan config:cache
```

## ✅ Solución 5: Verificar Permisos Completos

```bash
# Permisos para storage
chmod -R 775 storage
chmod -R 775 storage/app/public

# Permisos para public/storage (enlace simbólico)
chmod 755 public/storage

# Verificar
ls -ld storage/app/public
ls -ld public/storage
```

## ✅ Solución 6: Probar Acceso Directo a Imágenes

Prueba acceder directamente a una imagen:

```
https://leranuva.com/storage/images/projects/nombre_imagen.jpg
```

Si esto funciona, el problema es con las rutas en la base de datos.
Si no funciona, el problema es con el enlace simbólico o permisos.

## 🔧 Comandos Completos de Verificación

```bash
# 1. Verificar estructura
ls -la public/storage
ls -la storage/app/public/images/projects

# 2. Recrear enlace si es necesario
rm -f public/storage
ln -s ../storage/app/public public/storage

# 3. Crear directorios
mkdir -p storage/app/public/images/projects

# 4. Permisos
chmod -R 775 storage/app/public
chmod 755 public/storage

# 5. Verificar APP_URL
grep APP_URL .env

# 6. Limpiar cache
php artisan config:clear
php artisan config:cache

# 7. Verificar proyectos con imágenes
php artisan tinker
>>> \App\Models\Project::whereNotNull('image_before')->orWhereNotNull('image_after')->count()
>>> exit
```

## 📝 Checklist

- [ ] Enlace simbólico `public/storage` existe y apunta correctamente
- [ ] Directorio `storage/app/public/images/projects` existe
- [ ] Permisos correctos (775 en storage, 755 en public/storage)
- [ ] `APP_URL` en `.env` es correcto (https://leranuva.com)
- [ ] Assets compilados existen en `public/build/`
- [ ] Proyectos tienen imágenes asociadas en la base de datos
- [ ] Cache limpiado y regenerado

## 🎯 Solución Rápida (Copia y Pega)

```bash
# Recrear enlace simbólico
rm -f public/storage
ln -s ../storage/app/public public/storage

# Crear directorios
mkdir -p storage/app/public/images/projects

# Permisos
chmod -R 775 storage/app/public
chmod 755 public/storage

# Verificar APP_URL
grep APP_URL .env

# Limpiar cache
php artisan config:clear
php artisan config:cache
```

---

**Después de ejecutar estos comandos, verifica en el navegador si las imágenes se cargan.**

