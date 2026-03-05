# Fix 500 Error on /system-bd-access/projects

## Root cause (from your log)

The error occurs when Filament tries to generate the Edit URL for table records. Possible causes:

1. **Stale route cache** – route names not in cache
2. **Null slug** – projects with empty slug cause invalid URLs
3. **Resource discovery** – ProjectResource not loaded on some hosts

## Fixes applied in code

- **ProjectResource**: Uses `id` for admin routes (avoids null slug)
- **Project model**: `getRouteKey()` returns `id`; `resolveRouteBindingQuery` accepts both slug and id for public URLs

## Steps on the server

### 1. Clear caches

```bash
cd ~/domains/bluedraft.cc/public_html
php artisan route:clear
php artisan config:clear
php artisan view:clear
```

### 2. Deploy the updated code

Upload the modified files (ProjectResource, Project model) and run the commands above again.

### 3. Verify routes exist

```bash
php artisan route:list --name=filament.admin.resources.projects
```

You should see `filament.admin.resources.projects.index`, `.create`, `.edit`. If not, resource discovery may be failing.

---

## 1. Check the Laravel log (most important)

On the server, run:

```bash
tail -100 storage/logs/laravel.log
```

Or via Hostinger File Manager: open `storage/logs/laravel.log` and read the last lines.

The log will show the exact exception (e.g. missing column, SQL error, missing file).

## 2. Temporary debug mode (to see error in browser)

In `.env` on the server, temporarily set:

```
APP_DEBUG=true
APP_ENV=local
```

Reload https://bluedraft.cc/system-bd-access/projects. You should see the full error and stack trace.

**Important:** Set `APP_DEBUG=false` again after diagnosing.

## 3. Common causes and fixes

| Cause | Fix |
|-------|-----|
| Missing `slug` column on `projects` | Run `php artisan migrate` |
| Missing `project_service` pivot table | Run `php artisan migrate` |
| PostgreSQL syntax on MySQL | Already fixed in CustomDashboard; check other resources |
| Storage symlink missing | `ln -s ../storage/app/public public/storage` |
| Missing `placeholder.jpg` | Fixed: now uses `logo.svg` |
| `logo-original.png` missing in brand | Fixed: now uses `logo.svg` |

## 4. Verify migrations

```bash
php artisan migrate:status
```

Ensure all migrations have run, especially:

- `add_slug_to_projects_table`
- `create_services_table` (creates `project_service`)

## 5. Clear caches

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```
