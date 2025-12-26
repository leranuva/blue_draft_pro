# 🔧 Solución: Error 500 en Panel de Administración

El error 500 generalmente indica un problema del servidor. Sigue estos pasos para diagnosticar y solucionar.

## 🔍 Paso 1: Verificar Logs de Laravel

```bash
# Ver los últimos errores en los logs
tail -n 50 storage/logs/laravel.log

# Ver todos los errores recientes
tail -n 100 storage/logs/laravel.log | grep -i error

# Si el archivo es muy grande, busca errores específicos
grep -i "error\|exception\|fatal" storage/logs/laravel.log | tail -n 20
```

**Copia el error completo** que aparezca en los logs y compártelo.

## ✅ Solución 1: Limpiar Cache y Regenerar

```bash
# Limpiar todo el cache
php artisan optimize:clear

# Limpiar cache de configuración
php artisan config:clear

# Limpiar cache de rutas
php artisan route:clear

# Limpiar cache de vistas
php artisan view:clear

# Limpiar cache de aplicación
php artisan cache:clear

# Regenerar cache optimizado
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## ✅ Solución 2: Verificar Permisos

```bash
# Verificar permisos de storage y cache
ls -ld storage bootstrap/cache

# Ajustar permisos
chmod -R 775 storage bootstrap/cache

# Verificar permisos de archivos importantes
ls -la .env
ls -la storage/logs/laravel.log
```

## ✅ Solución 3: Verificar APP_KEY

```bash
# Verificar que APP_KEY existe y está configurado
grep APP_KEY .env

# Si no existe o está vacío, generarlo
php artisan key:generate

# Limpiar y recachear
php artisan config:clear
php artisan config:cache
```

## ✅ Solución 4: Verificar Base de Datos

```bash
# Verificar conexión a base de datos
php artisan migrate:status

# Si hay errores, verificar credenciales en .env
grep DB_ .env
```

## ✅ Solución 5: Verificar Usuario Administrador

```bash
# Verificar que el usuario admin existe
php artisan tinker
>>> \App\Models\User::where('email', 'marcin@bluedraft.org')->first()
# Debería mostrar el usuario
>>> exit

# Si no existe, ejecutar el seeder
php artisan db:seed --class=AdminUserSeeder --force
```

## ✅ Solución 6: Verificar Extensiones PHP

```bash
# Verificar extensiones PHP necesarias
php -m | grep -E "intl|gd|zip|mbstring|openssl|pdo_mysql"

# Si falta alguna, contacta a Hostinger para habilitarla
```

## ✅ Solución 7: Habilitar Debug Temporalmente (Solo para Diagnóstico)

**⚠️ Solo para diagnóstico, luego desactívalo:**

```bash
# Editar .env
nano .env

# Cambiar temporalmente:
APP_DEBUG=true
APP_ENV=local

# Guardar y limpiar cache
php artisan config:clear

# Probar de nuevo en el navegador
# Verás el error detallado

# IMPORTANTE: Después de ver el error, volver a:
APP_DEBUG=false
APP_ENV=production
php artisan config:cache
```

## 🔧 Comandos Completos de Solución (Copia y Pega)

```bash
# 1. Ver logs
tail -n 50 storage/logs/laravel.log

# 2. Limpiar todo
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# 3. Verificar APP_KEY
grep APP_KEY .env
php artisan key:generate

# 4. Permisos
chmod -R 775 storage bootstrap/cache

# 5. Regenerar cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Verificar usuario admin
php artisan tinker
>>> \App\Models\User::where('email', 'marcin@bluedraft.org')->count()
>>> exit
```

## 🐛 Errores Comunes y Soluciones

### Error: "Class not found"
```bash
composer dump-autoload --optimize
php artisan optimize:clear
```

### Error: "Permission denied"
```bash
chmod -R 775 storage bootstrap/cache
```

### Error: "No application encryption key"
```bash
php artisan key:generate
php artisan config:clear
php artisan config:cache
```

### Error: "SQLSTATE[HY000] [2002]"
```bash
# Verificar credenciales de BD en .env
grep DB_ .env
# Verificar que la BD existe y el usuario tiene permisos
```

### Error: "Call to undefined function"
```bash
# Verificar extensiones PHP
php -m
# Contactar a Hostinger si falta alguna extensión
```

## 📝 Checklist de Diagnóstico

- [ ] Logs revisados (`tail -n 50 storage/logs/laravel.log`)
- [ ] Cache limpiado (`php artisan optimize:clear`)
- [ ] APP_KEY configurado (`grep APP_KEY .env`)
- [ ] Permisos correctos (`chmod -R 775 storage bootstrap/cache`)
- [ ] Base de datos conecta (`php artisan migrate:status`)
- [ ] Usuario admin existe (`php artisan tinker`)
- [ ] Extensiones PHP habilitadas (`php -m`)
- [ ] Cache regenerado (`php artisan config:cache`)

## 🎯 Pasos Inmediatos

1. **Ver logs primero:**
   ```bash
   tail -n 50 storage/logs/laravel.log
   ```

2. **Limpiar cache:**
   ```bash
   php artisan optimize:clear
   php artisan config:cache
   ```

3. **Verificar permisos:**
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

4. **Probar de nuevo en el navegador**

---

**Si el error persiste, comparte el contenido de los logs para diagnosticar el problema específico.**

