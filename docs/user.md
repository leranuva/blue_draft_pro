# Administración de Blue Draft

El panel está en `/system-bd-access`. Solo entran las cuentas aprovisionadas explícitamente como administradoras. El primer acceso exige configurar la autenticación multifactor mediante una aplicación TOTP.

## Aprovisionar o rotar una cuenta

Después de aplicar las migraciones, ejecuta desde el servidor:

```bash
php artisan admin:provision administrador@example.com
```

El comando solicita una contraseña individual de al menos 16 caracteres mediante un prompt oculto. Usa una contraseña única del gestor de contraseñas. Si la cuenta existe, el comando actualiza la contraseña, revoca su token de «recordarme» y conserva su configuración MFA.

Para retirar acceso, desactiva el indicador `is_admin` de la cuenta y revoca sus sesiones en el almacén de sesiones del entorno. Para migrar desde la instalación anterior, sigue el [checklist de despliegue](../DEPLOYMENT_CHECKLIST.md).
