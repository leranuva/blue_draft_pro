# Arreglar imágenes en Hostinger

## Problema
Las imágenes no cargan en https://bluedraft.cc

---

## 1. Imágenes estáticas (logo, favicon)

### Verificar que existan en el servidor

Ruta: `public_html/public/images/`

Debe contener:
- `logo-original.png` (o `logo.svg` como alternativa)
- `favicon.ico` o `favicon.svg`

### Si falta logo-original.png

**Opción A:** Sube tu logo como `logo-original.png` a `public_html/public/images/`

**Opción B:** El proyecto usa `logo.svg` como fallback si cambias las referencias.

---

## 2. Imágenes dinámicas (proyectos, hero, about)

Estas se sirven desde `storage/app/public/` vía el enlace simbólico.

### Verificar el symlink

Por SSH:
```bash
cd ~/domains/bluedraft.cc/public_html
ls -la public/storage
```

Debe mostrar: `storage -> ../storage/app/public` (o ruta absoluta)

### Si el symlink no existe o está roto

```bash
cd ~/domains/bluedraft.cc/public_html
rm -f public/storage
ln -s ../storage/app/public public/storage
```

### Verificar estructura de storage

```bash
ls -la storage/app/public/
# Debe existir: projects/, quotes/, etc.
```

Las imágenes de proyectos se guardan en `storage/app/public/projects/` cuando subes desde el panel admin.

---

## 3. ASSET_URL (si las URLs son incorrectas)

En `.env`:
```env
APP_URL=https://bluedraft.cc
ASSET_URL=https://bluedraft.cc
```

Luego:
```bash
php artisan config:clear
php artisan config:cache
```

---

## 4. Subir carpeta public/images

Asegúrate de haber subido:
```
public/
├── images/
│   ├── logo-original.png   ← Si tienes este archivo
│   ├── logo.svg
│   └── ...
├── build/
└── ...
```

---

## 5. Proyectos sin imágenes

Los proyectos del seeder no tienen imágenes. Para añadirlas:
1. Entra al panel: https://bluedraft.cc/system-bd-access
2. Ve a Projects
3. Edita cada proyecto y sube imágenes (before/after)
