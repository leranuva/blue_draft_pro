# 🔧 Solución de Problemas en Hostinger

## Problema 1: Error en DatabaseSeeder

**Error**: `Call to undefined function Database\Factories\fake()`

**Solución**: El archivo `DatabaseSeeder.php` necesita actualizarse.

### Opción A: Actualizar desde Git

```bash
# Actualizar código
git pull origin main

# Volver a ejecutar seeders
php artisan db:seed --force
```

### Opción B: Editar Manualmente

```bash
# Editar el archivo
nano database/seeders/DatabaseSeeder.php
```

Reemplaza el método `run()` completo con:

```php
public function run(): void
{
    $this->call([
        AdminUserSeeder::class,
        ProjectSeeder::class,
        HeroSettingsSeeder::class,
        AboutSettingsSeeder::class,
        ServicesSettingsSeeder::class,
        TestimonialsSettingsSeeder::class,
        ContactSettingsSeeder::class,
        FooterSettingsSeeder::class,
    ]);
}
```

Guarda (Ctrl+X, Y, Enter) y ejecuta:
```bash
php artisan db:seed --force
```

## Problema 2: Error al crear Storage Link

**Error**: `Call to undefined function Illuminate\Filesystem\exec()`

**Causa**: La función `exec()` está deshabilitada en Hostinger por seguridad.

**Solución**: Crear el enlace simbólico manualmente.

### Crear Enlace Simbólico Manualmente

```bash
# 1. Eliminar el enlace si existe (puede dar error si no existe, está bien)
rm -f public/storage

# 2. Crear el enlace simbólico manualmente
ln -s ../storage/app/public public/storage

# 3. Verificar que se creó correctamente
ls -la public/storage
# Debería mostrar algo como: public/storage -> ../storage/app/public
```

### Verificar que Funciona

```bash
# Verificar que el directorio existe
ls -la storage/app/public

# Si no existe, créalo
mkdir -p storage/app/public

# Verificar el enlace
ls -la public/storage
```

## ✅ Comandos Completos para Resolver Ambos Problemas

```bash
# 1. Actualizar DatabaseSeeder (si usas Git)
git pull origin main

# O editar manualmente (ver arriba)

# 2. Ejecutar seeders
php artisan db:seed --force

# 3. Crear enlace simbólico manualmente
rm -f public/storage
ln -s ../storage/app/public public/storage

# 4. Crear directorio si no existe
mkdir -p storage/app/public

# 5. Configurar permisos
chmod -R 775 storage bootstrap/cache

# 6. Optimizar
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🔍 Verificar que Todo Está Correcto

```bash
# Verificar enlace simbólico
ls -la public/storage
# Debe mostrar: public/storage -> ../storage/app/public

# Verificar permisos
ls -ld storage bootstrap/cache
# Deben tener permisos 775

# Verificar que seeders funcionaron
php artisan tinker
>>> \App\Models\User::count()
# Debería mostrar al menos 1 (el usuario admin)
>>> \App\Models\Settings::count()
# Debería mostrar varios registros
>>> exit
```

## 📝 Notas Importantes

1. **En Hostinger, `exec()` está deshabilitada** - Siempre usa `ln -s` para crear enlaces simbólicos
2. **Permisos**: En Hostinger compartido, generalmente no necesitas `chown`, solo `chmod`
3. **Usuario**: El usuario suele ser tu ID de Hostinger (u671466050)

---

**Después de resolver estos problemas, tu sitio debería funcionar correctamente.**

