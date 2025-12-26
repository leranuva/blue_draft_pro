# 🔧 Corregir DatabaseSeeder.php en el Servidor

Tu archivo `DatabaseSeeder.php` tiene código duplicado y todavía usa `User::factory()` que causa el error.

## ✅ Solución: Reemplazar el Archivo Completo

Ejecuta estos comandos en el servidor:

```bash
# 1. Hacer backup del archivo actual (por si acaso)
cp database/seeders/DatabaseSeeder.php database/seeders/DatabaseSeeder.php.backup

# 2. Editar el archivo
nano database/seeders/DatabaseSeeder.php
```

**Elimina TODO el contenido** y reemplázalo con esto:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
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
}
```

**En nano:**
1. Selecciona todo el contenido (Ctrl+A si está disponible, o manualmente)
2. Elimínalo
3. Pega el código nuevo
4. Guarda: `Ctrl+X`, luego `Y`, luego `Enter`

## ✅ Verificar y Ejecutar

```bash
# Verificar que el archivo está correcto
cat database/seeders/DatabaseSeeder.php

# Debería mostrar solo el código limpio sin User::factory()

# Ejecutar seeders
php artisan db:seed --force
```

## 📝 Notas

- **NO debe tener** `User::factory()->create()`
- **NO debe tener** código duplicado
- **SÍ debe tener** `AdminUserSeeder::class` como primer seeder
- **SÍ debe tener** todos los seeders de configuración

---

**Después de corregir el archivo, los seeders deberían ejecutarse sin errores.**

