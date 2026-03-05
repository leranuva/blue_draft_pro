# Usuario Administrador - Blue Draft Web

## 📋 Información del Usuario Administrador

### Credenciales por Defecto

| Campo | Valor |
|-------|-------|
| **Nombre** | Blue Draft Admin |
| **Email** | `info@bluedraft.cc` |
| **Contraseña** | `BlueDraft2024!` |
| **Panel de Administración** | `/system-bd-access` |

## 🔐 Restricciones de Acceso

### Política de Acceso al Panel

Solo los usuarios con email que termine en `@bluedraft.org` pueden acceder al panel de administración de Filament.

Esta restricción está implementada en el modelo `User` mediante el método `canAccessPanel()`:

```php
public function canAccessPanel(Panel $panel): bool
{
    return str_ends_with($this->email, '@bluedraft.org');
}
```

### URLs de Acceso

- **Panel de Administración**: `http://localhost:8000/system-bd-access` (desarrollo)
- **Panel de Administración**: `https://tudominio.com/system-bd-access` (producción)

**Nota**: La URL del panel es discreta (`/system-bd-access`) para mayor seguridad.

## 🚀 Creación del Usuario Administrador

### Método 1: Usando el Seeder (Recomendado)

El usuario administrador se crea automáticamente al ejecutar:

```bash
php artisan db:seed --class=AdminUserSeeder
```

O al ejecutar todos los seeders:

```bash
php artisan db:seed
```

El seeder verifica si el usuario ya existe antes de crearlo, por lo que es seguro ejecutarlo múltiples veces.

### Método 2: Usando Tinker

```bash
php artisan tinker
```

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::create([
    'name' => 'Blue Draft Admin',
    'email' => 'info@bluedraft.cc',
    'password' => Hash::make('BlueDraft2024!'),
    'email_verified_at' => now(),
]);
```

### Método 3: Crear Usuario Adicional

Para crear un usuario administrador adicional con email `@bluedraft.org`:

```bash
php artisan tinker
```

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::create([
    'name' => 'Nombre del Administrador',
    'email' => 'nuevo@bluedraft.org',
    'password' => Hash::make('TuContraseñaSegura123!'),
    'email_verified_at' => now(),
]);
```

## 📝 Estructura del Modelo User

### Campos Principales

- `name`: Nombre del usuario
- `email`: Email del usuario (debe terminar en `@bluedraft.org` para acceso al panel)
- `password`: Contraseña hasheada
- `email_verified_at`: Fecha de verificación del email
- `remember_token`: Token para "Recordarme"

### Campos Ocultos

- `password`: No se serializa en respuestas JSON
- `remember_token`: No se serializa en respuestas JSON

### Implementación

El modelo `User` implementa `FilamentUser` para integrarse con Filament:

```php
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, '@bluedraft.org');
    }
}
```

## 🔧 Configuración del Panel de Administración

### Archivo de Configuración

`app/Providers/Filament/AdminPanelProvider.php`

### Características del Panel

- **ID del Panel**: `admin`
- **Ruta Personalizada**: `/system-bd-access`
- **Nombre de la Marca**: Blue Draft Admin
- **Color Primario**: `#003366` (Azul oscuro de Blue Draft)
- **Logo**: `images/logo-original.png`
- **Favicon**: `favicon.ico`

### Páginas Disponibles

1. **Dashboard**: Panel principal
2. **Hero Settings**: Configuración del Hero section
3. **About Settings**: Configuración de la sección About
4. **Services Settings**: Configuración de la sección Services
5. **Testimonials Settings**: Configuración de la sección Testimonials
6. **Contact Settings**: Configuración de la sección Contact
7. **Footer Settings**: Configuración del Footer

### Recursos Disponibles

- **Projects**: Gestión de proyectos y galería
- **Quotes**: Gestión de solicitudes de cotización

## 🔒 Seguridad

### Recomendaciones

1. **Cambiar la Contraseña por Defecto**: Después del primer acceso, cambia la contraseña `BlueDraft2024!` por una más segura.

2. **Usar Contraseñas Fuertes**: 
   - Mínimo 12 caracteres
   - Combinar mayúsculas, minúsculas, números y símbolos
   - No usar información personal

3. **Restricción de Email**: Solo usuarios con email `@bluedraft.org` pueden acceder. Esto proporciona una capa adicional de seguridad.

4. **URL Discreta**: El panel usa una URL no obvia (`/system-bd-access`) en lugar de `/admin` para evitar ataques automatizados.

5. **HTTPS en Producción**: Asegúrate de usar HTTPS en producción para proteger las credenciales.

## 📧 Emails Asociados

### Emails de Contacto del Sitio

- `info@bluedraft.cc` - Email principal (footer, contacto, notificaciones, usuario administrador)

### Notificaciones

Las notificaciones de formularios de contacto y cotizaciones se envían automáticamente a `info@bluedraft.cc` (configurable vía `ADMIN_NOTIFICATION_EMAIL`).

## 🛠️ Comandos Útiles

### Verificar Usuario

```bash
php artisan tinker
```

```php
use App\Models\User;

$user = User::where('email', 'info@bluedraft.cc')->first();
echo $user->name;
```

### Cambiar Contraseña

```bash
php artisan tinker
```

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('email', 'info@bluedraft.cc')->first();
$user->password = Hash::make('NuevaContraseñaSegura123!');
$user->save();
```

### Listar Todos los Usuarios

```bash
php artisan tinker
```

```php
use App\Models\User;

User::all(['name', 'email', 'created_at']);
```

## 📚 Referencias

- **Modelo User**: `app/Models/User.php`
- **Seeder de Usuario Admin**: `database/seeders/AdminUserSeeder.php`
- **Configuración del Panel**: `app/Providers/Filament/AdminPanelProvider.php`
- **Documentación de Filament**: https://filamentphp.com/docs

## ⚠️ Notas Importantes

1. **No compartir credenciales**: Mantén las credenciales del administrador en secreto.

2. **Backup de usuarios**: Si necesitas hacer backup de usuarios, exporta la tabla `users` de la base de datos.

3. **Recuperación de contraseña**: Si olvidas la contraseña, puedes restablecerla usando Tinker o creando un nuevo usuario.

4. **Múltiples administradores**: Puedes crear múltiples usuarios administradores, todos con email `@bluedraft.org`.

---

**Última actualización**: Diciembre 2025  
**Versión del documento**: 1.0

