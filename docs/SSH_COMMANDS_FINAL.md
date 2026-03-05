# 🚀 Comandos SSH Finales para Hostinger (Sin Git)

Comandos en orden para completar el despliegue después de corregir el DatabaseSeeder.

## ✅ Paso 1: Ejecutar Seeders

```bash
php artisan db:seed --force
```

**Espera a que termine**. Deberías ver mensajes como:
```
INFO  Seeding database.
INFO  Seeding: AdminUserSeeder
INFO  Seeding: ProjectSeeder
...
```

## ✅ Paso 2: Crear Enlace Simbólico de Storage

```bash
# Eliminar si existe
rm -f public/storage

# Crear enlace simbólico manualmente (exec() está deshabilitado en Hostinger)
ln -s ../storage/app/public public/storage

# Crear directorio si no existe
mkdir -p storage/app/public

# Verificar que se creó correctamente
ls -la public/storage
```

**Debería mostrar**: `public/storage -> ../storage/app/public`

## ✅ Paso 3: Configurar Permisos

```bash
# Configurar permisos para storage y cache
chmod -R 775 storage bootstrap/cache

# Verificar permisos
ls -ld storage bootstrap/cache
```

## ✅ Paso 4: Optimizar para Producción

```bash
# Limpiar cache anterior
php artisan optimize:clear

# Cachear configuración
php artisan config:cache

# Cachear rutas
php artisan route:cache

# Cachear vistas
php artisan view:cache
```

## ✅ Paso 5: Verificar que Todo Funciona

```bash
# Verificar logs (no debería haber errores críticos)
tail -n 20 storage/logs/laravel.log

# Verificar que el enlace simbólico existe
ls -la public/storage

# Verificar que el usuario admin se creó
php artisan tinker
>>> \App\Models\User::where('email', 'info@bluedraft.cc')->count()
# Debería mostrar: 1
>>> exit
```

## 📋 Comandos Completos (Copia y Pega)

```bash
# 1. Ejecutar seeders
php artisan db:seed --force

# 2. Crear enlace simbólico
rm -f public/storage
ln -s ../storage/app/public public/storage
mkdir -p storage/app/public
ls -la public/storage

# 3. Permisos
chmod -R 775 storage bootstrap/cache

# 4. Optimizar
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Verificar
tail -n 20 storage/logs/laravel.log
```

## 🌐 Probar en el Navegador

Después de ejecutar todos los comandos:

1. **Sitio Principal**: `https://leranuva.com`
   - Debería cargar correctamente
   - Todas las secciones visibles

2. **Panel de Administración**: `https://leranuva.com/system-bd-access`
   - Email: `info@bluedraft.cc`
   - Contraseña: `BlueDraft2024!`

## 🐛 Si Hay Problemas

### Error: "Storage link not found"
```bash
# Recrear el enlace
rm -f public/storage
ln -s ../storage/app/public public/storage
ls -la public/storage
```

### Error: "Permission denied"
```bash
# Ajustar permisos
chmod -R 775 storage bootstrap/cache
```

### Error 500 en el navegador
```bash
# Ver logs
tail -n 50 storage/logs/laravel.log

# Limpiar y recachear
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Error: "Class not found"
```bash
# Regenerar autoload
composer dump-autoload --optimize
php artisan optimize:clear
```

## ✅ Checklist Final

- [ ] Seeders ejecutados sin errores
- [ ] Enlace simbólico `public/storage` creado
- [ ] Permisos configurados (775)
- [ ] Configuración cacheada
- [ ] Rutas cacheadas
- [ ] Vistas cacheadas
- [ ] Sitio principal carga correctamente
- [ ] Panel de administración accesible
- [ ] Login funciona con credenciales

---

**Después de ejecutar estos comandos, tu sitio debería estar completamente funcional en Hostinger.**

