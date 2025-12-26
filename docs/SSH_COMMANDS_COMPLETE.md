# 🚀 Comandos SSH Completos para Hostinger

## 📋 Comandos en Orden (Copia y Pega)

### 1. Navegar al Directorio del Proyecto

```bash
cd ~/public_html
# O el directorio donde está tu proyecto Laravel
```

### 2. Instalar Dependencias de Composer

```bash
composer install --optimize-autoloader --no-dev --no-interaction
```

### 3. Configurar .env

```bash
# Si no existe .env, crear desde template
cp env-production-template.txt .env

# Editar .env con tus datos reales
nano .env

# Configurar al menos:
# APP_ENV=production
# APP_DEBUG=false
# APP_URL=https://leranuva.com
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_DATABASE=tu_base_datos
# DB_USERNAME=tu_usuario
# DB_PASSWORD=tu_contraseña
```

### 4. Generar APP_KEY

```bash
php artisan key:generate
```

### 5. Ejecutar Migraciones

```bash
# Ejecutar migraciones (crear tablas)
php artisan migrate --force
```

### 6. Ejecutar Seeders (Poblar Base de Datos)

```bash
# Ejecutar todos los seeders
php artisan db:seed --force
```

### 7. Crear Directorios Necesarios

```bash
# Crear directorios para imágenes
mkdir -p storage/app/public/images/projects
mkdir -p storage/app/public/images/hero
mkdir -p storage/app/public/images/about
mkdir -p storage/app/public/images/testimonials
mkdir -p storage/app/public/images/quotes
```

### 8. Crear Enlace Simbólico

```bash
# Eliminar enlace existente si existe
rm -f public/storage

# Crear nuevo enlace simbólico
ln -s ../storage/app/public public/storage

# Verificar que se creó correctamente
ls -la public/storage
```

### 9. Configurar Permisos

```bash
# Configurar permisos para storage y cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Verificar permisos
ls -la storage/app/public/
```

### 10. Limpiar y Regenerar Cache

```bash
# Limpiar todo el cache
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Regenerar cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 11. Verificar Instalación

```bash
# Verificar proyectos e imágenes
php artisan projects:check

# Verificar configuración
php artisan config:show app.url
```

## 📝 Script Completo (Todo en Uno)

Puedes copiar y pegar todo esto de una vez:

```bash
# 1. Ir al directorio
cd ~/public_html

# 2. Instalar dependencias
composer install --optimize-autoloader --no-dev --no-interaction

# 3. Generar APP_KEY (si no existe)
php artisan key:generate

# 4. Ejecutar migraciones
php artisan migrate --force

# 5. Ejecutar seeders
php artisan db:seed --force

# 6. Crear directorios
mkdir -p storage/app/public/images/projects
mkdir -p storage/app/public/images/hero
mkdir -p storage/app/public/images/about
mkdir -p storage/app/public/images/testimonials
mkdir -p storage/app/public/images/quotes

# 7. Crear enlace simbólico
rm -f public/storage
ln -s ../storage/app/public public/storage

# 8. Permisos
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# 9. Limpiar cache
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 10. Regenerar cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 11. Verificar
php artisan projects:check
```

## 🔧 Comandos Adicionales Útiles

### Ver Logs

```bash
# Ver últimos logs
tail -f storage/logs/laravel.log

# Ver últimos 50 líneas
tail -n 50 storage/logs/laravel.log
```

### Verificar Base de Datos

```bash
# Verificar conexión
php artisan tinker --execute="echo 'DB Connected: ' . (DB::connection()->getPdo() ? 'YES' : 'NO');"

# Ver tablas
php artisan migrate:status
```

### Verificar Configuración

```bash
# Ver APP_URL
php artisan config:show app.url

# Ver configuración de filesystem
php artisan config:show filesystems.disks.public
```

### Limpiar Cache Específico

```bash
# Solo cache de configuración
php artisan config:clear
php artisan config:cache

# Solo cache de vistas
php artisan view:clear
php artisan view:cache

# Solo cache de rutas
php artisan route:clear
php artisan route:cache
```

### Re-ejecutar Seeders Específicos

```bash
# Ejecutar solo un seeder específico
php artisan db:seed --class=AdminUserSeeder --force
php artisan db:seed --class=ProjectSeeder --force
php artisan db:seed --class=HeroSettingsSeeder --force
```

### Verificar Permisos

```bash
# Ver permisos de storage
ls -la storage/
ls -la storage/app/public/

# Ver permisos de cache
ls -la bootstrap/cache/

# Ver permisos del enlace simbólico
ls -la public/storage
```

## ⚠️ Solución de Problemas

### Error: "The environment file is invalid!"

```bash
# Eliminar .env corrupto
rm .env

# Crear nuevo .env desde template
cp env-production-template.txt .env

# Editar con tus datos
nano .env
```

### Error: "Call to undefined function exec()"

```bash
# Crear enlace simbólico manualmente
rm -f public/storage
ln -s ../storage/app/public public/storage
```

### Error: "Permission denied"

```bash
# Configurar permisos
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Error: "Class not found" o "Seeder not found"

```bash
# Regenerar autoload
composer dump-autoload

# Ejecutar seeders de nuevo
php artisan db:seed --force
```

## ✅ Checklist Post-Instalación

Después de ejecutar todos los comandos, verifica:

- [ ] `composer install` ejecutado sin errores
- [ ] `.env` configurado con datos reales
- [ ] `APP_KEY` generado
- [ ] Migraciones ejecutadas (`php artisan migrate:status` muestra todas como "Ran")
- [ ] Seeders ejecutados (verificar en BD que hay datos)
- [ ] Directorios de imágenes creados
- [ ] Enlace simbólico `public/storage` creado
- [ ] Permisos configurados (775 en storage y bootstrap/cache)
- [ ] Cache regenerado
- [ ] Sitio carga correctamente
- [ ] Panel de administración accesible (`/system-bd-access`)
- [ ] Imágenes se muestran correctamente

## 📝 Notas Importantes

1. **`--force`**: Se usa en producción para evitar confirmaciones interactivas
2. **`--no-dev`**: No instala dependencias de desarrollo (optimiza para producción)
3. **`--optimize-autoloader`**: Optimiza el autoloader de Composer
4. **Permisos 775**: Permite lectura, escritura y ejecución para propietario y grupo
5. **Enlace simbólico**: Debe crearse DESPUÉS de subir los archivos

---

**Ejecuta estos comandos en orden para configurar completamente tu proyecto en Hostinger.**

