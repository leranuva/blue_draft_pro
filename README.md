# Blue Draft - Expert Construction Solutions

Sitio web moderno y profesional para Blue Draft Construction Company, desarrollado con Laravel 12 y las últimas tendencias de diseño web 2024-2025.

![Laravel](https://img.shields.io/badge/Laravel-12.44.0-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?style=flat-square&logo=tailwind-css)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=flat-square&logo=alpine.js)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql)
![Filament](https://img.shields.io/badge/Filament-4.0-FFB02B?style=flat-square&logo=filament)

## 📋 Descripción

Blue Draft es un sitio web corporativo moderno para una empresa de construcción, diseñado con las últimas tendencias de diseño web 2024-2025. El sitio presenta un diseño minimalista y elegante, con animaciones avanzadas, efectos glassmorphism mejorados, formularios interactivos multi-paso, panel de administración profesional con Filament PHP, y una experiencia de usuario optimizada para destacar sobre la competencia.

## ✨ Características Principales

### 🎨 Diseño y UX
- **Diseño Moderno**: Inspirado en las últimas tendencias de diseño web 2024-2025
- **Responsive**: Totalmente adaptable a dispositivos móviles, tablets y desktop
- **Glassmorphism Mejorado**: Efectos de vidrio esmerilado en navbar y cards
- **Paleta de Colores Personalizada**: Colores corporativos (#336699, #CCCC99, #003366)
- **Tipografía Premium**: Playfair Display para títulos, Inter con interlineado amplio para legibilidad
- **Navegación Intuitiva**: Menú fijo con scroll suave entre secciones
- **Detección Automática de Tema**: El sitio detecta y se adapta automáticamente al tema del sistema operativo (modo claro/oscuro)
- **Menú Móvil Avanzado**: Menú hamburguesa con animaciones sofisticadas, overlay oscuro, deslizamiento suave y entrada escalonada de elementos
- **Hero Section Configurable**: Hero section completamente configurable desde el panel de administración con imagen de fondo y overlay personalizable

### 🚀 Animaciones y Efectos
- **Animaciones de Scroll Reveal**: Elementos aparecen con fade-in y desplazamiento al hacer scroll
- **Motion One Integration**: Animaciones fluidas y profesionales
- **Transiciones Suaves**: Efectos de transición en todos los elementos interactivos
- **Hover Effects**: Efectos visuales mejorados en cards y botones
- **Overlay Dinámico**: Sistema de overlay ajustable para imágenes de fondo del Hero
- **Menú Móvil Animado**: 
  - Botón hamburguesa que se transforma en X con animación suave
  - Menú que se desliza desde arriba con backdrop blur
  - Overlay oscuro con blur cuando el menú está abierto
  - Entrada escalonada de elementos del menú con delays
  - Efectos hover mejorados con desplazamiento horizontal
  - Indicadores visuales en elementos del menú

### 📝 Formularios Avanzados
- **Formulario Multi-paso (Wizard)**: Formulario de contacto dividido en 4 pasos para mayor conversión
  - Paso 1: Selección de servicio (Residential, Commercial, Renovation, Other)
  - Paso 2: Presupuesto estimado (Under $25k, $25k-$50k, $50k-$100k, Over $100k)
  - Paso 3: Información de contacto completa
  - Paso 4: Descripción del proyecto y subida de fotos con drag & drop
- **Indicador de Progreso Visual**: Barra de progreso que muestra el avance del formulario
- **Validación por Pasos**: Validación incremental para mejor UX con botones Next Step que se habilitan al completar cada paso
- **Drag & Drop de Archivos**: Subida de fotos con preview y eliminación individual
- **Eventos de Cambio Mejorados**: Los radio buttons y campos del formulario actualizan correctamente el estado para habilitar los botones de navegación
- **Widget de Mensajería Flotante**: Botón flotante en la esquina inferior derecha para acceso rápido a cotizaciones y contacto
  - Acceso directo a formularios
  - Información de contacto visible
  - Horarios de atención
  - Animaciones suaves de apertura/cierre

### 🖼️ Galería y Proyectos
- **Filtros Dinámicos**: Filtrado instantáneo de proyectos por categoría (Residential, Commercial, Renovation)
- **Visualizador Antes/Después**: Slider interactivo arrastrable para comparar transformaciones
- **Cards con Glassmorphism**: Tarjetas de proyectos con efecto glass mejorado
- **Animaciones de Entrada**: Cards aparecen con animación escalonada
- **Gestión desde Panel Admin**: Subida y gestión de proyectos con imágenes antes/después desde Filament

### 🔍 SEO y Performance
- **JSON-LD Schema Markup**: Schema.org LocalBusiness para SEO local mejorado
- **Meta Tags Optimizados**: Meta tags para mejor indexación
- **Performance Optimizado**: Optimizado con Vite para carga rápida
- **Lazy Loading**: Carga diferida de imágenes y recursos

### 🛡️ Panel de Administración (Filament PHP)
- **Panel Profesional y Discreto**: Panel de administración con URL personalizada (`/system-bd-access`)
- **Gestión de Proyectos**: CRUD completo para proyectos con subida de imágenes antes/después
- **Gestión de Cotizaciones**: Visualización y gestión de todas las solicitudes de cotización
- **Sistema de Settings**: Configuración dinámica del sitio desde el panel
- **Hero Section Configurable**: Configuración completa del Hero desde el dashboard
  - Badge, títulos, descripción
  - Texto y botones CTA
  - Números de teléfono
  - Imagen de fondo con overlay
  - SVG icon y texto del placeholder
- **Control de Acceso**: Solo usuarios con email `@bluedraft.org` pueden acceder
- **Gestión de Archivos**: Visualización y descarga de fotos subidas por clientes

## 🛠️ Tecnologías Utilizadas

### Backend
- **Laravel 12.44.0**: Framework PHP moderno
- **PHP 8.2+**: Lenguaje de programación
- **MySQL**: Base de datos relacional
- **Filament PHP 4.0**: Panel de administración profesional

### Frontend
- **Tailwind CSS 4.0**: Framework CSS utility-first
- **Alpine.js 3.x**: Framework JavaScript ligero para interactividad
- **Motion One**: Biblioteca de animaciones de alto rendimiento
- **Vite 7.0.7**: Build tool y bundler
- **Google reCAPTCHA**: Protección contra spam en formularios
- **Playfair Display**: Tipografía serif para títulos (transmite lujo y solidez)
- **Inter**: Tipografía sans-serif para contenido (con interlineado amplio para legibilidad)

### Herramientas
- **Composer**: Gestor de dependencias PHP
- **NPM**: Gestor de paquetes Node.js
- **Git**: Control de versiones
- **Google reCAPTCHA PHP Library**: Validación de reCAPTCHA en el servidor

## 📦 Requisitos del Sistema

- **PHP**: >= 8.2 (con extensiones: `intl`, `gd`, `zip`)
- **Composer**: >= 2.0
- **Node.js**: >= 18.0
- **NPM**: >= 9.0
- **MySQL**: >= 8.0 (o MariaDB)
- **Servidor Web**: Apache/Nginx (o usar `php artisan serve`)

### Extensiones PHP Requeridas (XAMPP)

Asegúrate de que las siguientes extensiones estén activadas en `php.ini`:

```ini
extension=intl
extension=gd
extension=zip
```

**Nota**: La extensión `intl` es requerida por Filament PHP para formateo de números. Si no está disponible, el sistema incluye un fallback personalizado.

## 🚀 Instalación

### 1. Clonar el repositorio

```bash
git clone <repository-url>
cd blue_draft_web
```

### 2. Instalar dependencias PHP

```bash
composer install
```

### 3. Instalar dependencias Node.js

```bash
npm install
```

### 4. Configurar el archivo de entorno

Copia el archivo `.env.example` a `.env`:

```bash
cp .env.example .env
```

O si ya existe, edita el archivo `.env` con tus configuraciones:

```env
APP_NAME="Blue Draft"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blue_draft_web
DB_USERNAME=root
DB_PASSWORD=

# Google reCAPTCHA (Opcional pero recomendado)
RECAPTCHA_SITE_KEY=tu_clave_de_sitio_aqui
RECAPTCHA_SECRET_KEY=tu_clave_secreta_aqui

# Configuración de Correo (Para notificaciones)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_email@gmail.com
MAIL_PASSWORD=tu_contraseña_de_aplicacion
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@bluedraft.org
MAIL_FROM_NAME="${APP_NAME}"
```

#### Configurar Google reCAPTCHA

Para proteger el formulario de contacto contra spam:

1. Ve a [Google reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin)
2. Crea un nuevo sitio (reCAPTCHA v2 "I'm not a robot" Checkbox)
3. Agrega tu dominio (localhost para desarrollo, tu dominio para producción)
4. Copia la **Site Key** y **Secret Key**
5. Agrega las claves a tu archivo `.env`:

```env
RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

**Nota**: Las claves de ejemplo anteriores son para testing. Reemplázalas con tus claves reales.

#### Configurar Correo Electrónico

Para recibir notificaciones cuando se envíen formularios:

**Opción 1: Gmail (Recomendado para desarrollo)**
1. Habilita la verificación en 2 pasos en tu cuenta de Gmail
2. Genera una "Contraseña de aplicación" en [Google Account Security](https://myaccount.google.com/apppasswords)
3. Configura en `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_email@gmail.com
MAIL_PASSWORD=tu_contraseña_de_aplicacion
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@bluedraft.org
MAIL_FROM_NAME="Blue Draft"
```

**Opción 2: Mailtrap (Para testing)**
1. Crea una cuenta en [Mailtrap](https://mailtrap.io)
2. Usa las credenciales SMTP proporcionadas

**Opción 3: Servidor SMTP propio**
Configura según las especificaciones de tu proveedor de correo.

**Nota**: Las notificaciones se envían automáticamente a `marcin@bluedraft.org` cuando se recibe un formulario.

### 5. Generar la clave de aplicación

```bash
php artisan key:generate
```

### 6. Crear la base de datos

Crea la base de datos MySQL:

```sql
CREATE DATABASE blue_draft_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

O usando la línea de comandos:

```bash
# En Windows con XAMPP
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS blue_draft_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 7. Ejecutar las migraciones

```bash
php artisan migrate
```

Esto creará las siguientes tablas:
- **users**: Usuarios del sistema (incluye usuarios admin para Filament)
- **projects**: Para gestionar la galería de proyectos con filtros dinámicos
- **quotes**: Para almacenar las solicitudes de cotización del formulario multi-paso
- **quote_attachments**: Para almacenar las fotos subidas por los clientes
- **settings**: Para configuración dinámica del sitio (Hero, textos, etc.)
- **cache**: Cache del sistema
- **jobs**: Cola de trabajos

### 8. Crear el enlace simbólico de storage

```bash
php artisan storage:link
```

Esto crea un enlace simbólico desde `public/storage` a `storage/app/public` para que las imágenes subidas sean accesibles públicamente.

### 9. Poblar la base de datos con datos iniciales

```bash
php artisan db:seed
```

Esto ejecutará los siguientes seeders:
- **DatabaseSeeder**: Seeder principal que llama a los demás
- **AdminUserSeeder**: Crea el usuario administrador inicial
- **ProjectSeeder**: Crea proyectos de ejemplo para la galería
- **HeroSettingsSeeder**: Crea la configuración inicial del Hero section
- **AboutSettingsSeeder**: Crea la configuración inicial de la sección About
- **ServicesSettingsSeeder**: Crea la configuración inicial de la sección Services
- **TestimonialsSettingsSeeder**: Crea la configuración inicial de la sección Testimonials
- **ContactSettingsSeeder**: Crea la configuración inicial de la sección Contact
- **FooterSettingsSeeder**: Crea la configuración inicial del Footer

#### Crear Usuario Administrador Manualmente

Si necesitas crear un usuario administrador adicional:

```bash
php artisan db:seed --class=AdminUserSeeder
```

O usando Tinker:

```bash
php artisan tinker
```

```php
$user = \App\Models\User::create([
    'name' => 'Admin Name',
    'email' => 'admin@bluedraft.org',
    'password' => bcrypt('tu_contraseña_segura'),
    'email_verified_at' => now(),
]);
```

**Importante**: Solo los usuarios con email que termine en `@bluedraft.org` pueden acceder al panel de administración.

### 10. Compilar los assets

```bash
npm run build
```

## 🎯 Uso

### Servidor de Desarrollo

Para iniciar el servidor de desarrollo:

```bash
php artisan serve
```

El sitio estará disponible en: `http://localhost:8000`

### Desarrollo con Hot Reload

Para desarrollo con recarga automática de assets:

```bash
npm run dev
```

En otra terminal:

```bash
php artisan serve
```

### Acceso al Panel de Administración

1. Navega a: `http://localhost:8000/system-bd-access`
2. Inicia sesión con un usuario que tenga email `@bluedraft.org`
3. Usa las credenciales creadas por `AdminUserSeeder` o crea un nuevo usuario

**Nota**: La URL del panel es discreta (`/system-bd-access`) para mayor seguridad.

### Compilar para Producción

```bash
npm run build
```

## 📁 Estructura del Proyecto

```
blue_draft_web/
├── app/
│   ├── Filament/
│   │   ├── Pages/
│   │   │   ├── HeroSettings.php          # Configuración del Hero section
│   │   │   ├── AboutSettings.php         # Configuración de la sección About
│   │   │   ├── ServicesSettings.php       # Configuración de la sección Services
│   │   │   ├── TestimonialsSettings.php  # Configuración de la sección Testimonials
│   │   │   ├── ContactSettings.php       # Configuración de la sección Contact
│   │   │   ├── FooterSettings.php        # Configuración del Footer
│   │   │   └── SiteSettings.php          # Página personalizada de Filament (legacy)
│   │   └── Resources/
│   │       ├── Projects/
│   │       │   ├── Pages/
│   │       │   │   ├── CreateProject.php
│   │       │   │   ├── EditProject.php
│   │       │   │   └── ListProjects.php
│   │       │   ├── ProjectResource.php   # Recurso Filament para proyectos
│   │       │   ├── Schemas/
│   │       │   │   └── ProjectForm.php   # Formulario de proyectos
│   │       │   └── Tables/
│   │       │       └── ProjectsTable.php # Tabla de proyectos
│   │       ├── Quotes/
│   │       │   ├── Pages/
│   │       │   │   ├── CreateQuote.php
│   │       │   │   ├── EditQuote.php
│   │       │   │   ├── ListQuotes.php
│   │       │   │   └── ViewQuote.php     # Vista detallada de cotización
│   │       │   ├── QuoteResource.php     # Recurso Filament para cotizaciones
│   │       │   ├── Schemas/
│   │       │   │   └── QuoteForm.php
│   │       │   └── Tables/
│   │       │       └── QuotesTable.php
│   │       └── Settings/
│   │           ├── Pages/
│   │           │   ├── CreateSettings.php
│   │           │   ├── EditSettings.php
│   │           │   └── ListSettings.php
│   │           ├── SettingsResource.php  # Recurso Filament para settings
│   │           ├── Schemas/
│   │           │   └── SettingsForm.php
│   │           └── Tables/
│   │               └── SettingsTable.php
│   ├── Helpers/
│   │   └── NumberHelper.php              # Helper para formateo de números (fallback)
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Controller.php
│   │       └── HomeController.php       # Controlador principal
│   ├── Mail/
│   │   ├── ContactNotification.php      # Mailable para contacto
│   │   └── QuoteNotification.php        # Mailable para cotizaciones
│   ├── Models/
│   │   ├── Project.php                  # Modelo de proyectos
│   │   ├── Quote.php                    # Modelo de cotizaciones
│   │   ├── QuoteAttachment.php          # Modelo de archivos adjuntos
│   │   ├── Settings.php                  # Modelo de configuración
│   │   └── User.php                     # Modelo de usuario (con canAccessPanel)
│   ├── Providers/
│   │   ├── AppServiceProvider.php        # Service provider principal
│   │   ├── Filament/
│   │   │   └── AdminPanelProvider.php   # Configuración del panel Filament
│   │   └── NumberServiceProvider.php    # Service provider para Number helper
│   └── Support/
│       └── NumberHelper.php              # Helper de soporte para números
├── config/                               # Archivos de configuración
├── database/
│   ├── migrations/                       # Migraciones de base de datos
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2025_12_24_232340_create_projects_table.php
│   │   ├── 2025_12_24_232344_create_quotes_table.php
│   │   ├── 2025_12_24_232348_create_quote_attachments_table.php
│   │   └── 2025_12_25_212832_create_settings_table.php
│   └── seeders/                          # Seeders de base de datos
│       ├── DatabaseSeeder.php
│       ├── AdminUserSeeder.php
│       ├── HeroSettingsSeeder.php
│       ├── AboutSettingsSeeder.php
│       ├── ServicesSettingsSeeder.php
│       ├── TestimonialsSettingsSeeder.php
│       ├── ContactSettingsSeeder.php
│       ├── FooterSettingsSeeder.php
│       └── ProjectSeeder.php
├── public/
│   ├── images/
│   │   ├── logo-original.png            # Logo principal (PNG)
│   │   └── ...
│   ├── favicon.ico                      # Favicon
│   ├── apple-touch-icon.png             # Icono para Apple
│   └── storage/                         # Enlace simbólico a storage/app/public
├── resources/
│   ├── css/
│   │   └── app.css                      # Estilos principales con glassmorphism
│   ├── js/
│   │   ├── app.js                       # JavaScript principal con Alpine.js y Motion One
│   │   └── bootstrap.js                # Configuración de Axios
│   └── views/
│       ├── emails/
│       │   ├── quote-notification.blade.php
│       │   └── contact-notification.blade.php
│       ├── layouts/
│       │   └── app.blade.php            # Layout principal con JSON-LD Schema
│       └── home.blade.php               # Vista principal con todas las secciones
├── routes/
│   └── web.php                          # Rutas web
├── storage/
│   └── app/
│       └── public/
│           ├── images/
│           │   └── projects/            # Imágenes de proyectos
│           └── settings/                # Imágenes de settings (Hero background, etc.)
├── .env                                  # Variables de entorno
├── composer.json                         # Dependencias PHP
├── package.json                          # Dependencias Node.js
└── vite.config.js                        # Configuración de Vite
```

## 🎨 Paleta de Colores

El sitio utiliza una paleta de colores personalizada:

- **#336699** (Azul Medio): Elementos principales, hover, acentos, badges
- **#CCCC99** (Beige/Crema): Fondos suaves, bordes, elementos secundarios, glassmorphism
- **#003366** (Azul Oscuro): Texto principal, botones, elementos destacados, títulos

## 📄 Secciones del Sitio

1. **Hero Section**: 
   - Sección principal con título destacado, CTAs y animaciones reveal
   - **Configurable desde el panel**: Badge, títulos, descripción, botones, teléfono, imagen de fondo con overlay
   - Overlay ajustable para mejorar legibilidad del texto sobre imágenes de fondo
   - Placeholder con SVG y texto configurable

2. **About Section**: 
   - Información sobre la empresa, misión y estadísticas con animaciones
   - **Configurable desde el panel**: Badge, título, subtítulo, descripciones, estadísticas (años, proyectos, satisfacción), imagen con placeholder SVG

3. **Projects Section**: 
   - Portafolio de proyectos con filtros dinámicos
   - Visualizador antes/después interactivo
   - Cards con glassmorphism y animaciones
   - Gestión completa desde el panel de administración

4. **Services Section**: 
   - Tarjetas de servicios ofrecidos
   - **Configurable desde el panel**: Badge, título, descripción del header, y configuración completa de 3 tarjetas de servicios (título, descripción, SVG path)

5. **Testimonials Section**: 
   - Carrusel de testimonios de clientes con auto-play
   - Sistema de navegación con flechas y dots
   - Calificaciones con estrellas
   - **Configurable desde el panel**: Badge, título, descripción del header, y configuración completa de 3 testimonios (nombre, rol, proyecto, calificación, imagen/emoji, texto)

6. **Quote Request Section**: 
   - Formulario multi-paso (4 pasos) con indicador de progreso
   - Subida de fotos con drag & drop
   - Validación de archivos
   - Preview de imágenes antes de enviar

7. **Contact Section**: 
   - Formulario de contacto simple
   - Información de contacto con iconos glassmorphism
   - Google Maps integrado
   - Layout en grid para mejor distribución visual
   - **Configurable desde el panel**: Badge, título, descripción, información de contacto (dirección, teléfono, email, horarios), título del formulario, URL de Google Maps embed

8. **Footer Section**: 
   - Información de contacto y enlaces rápidos
   - Enlaces a redes sociales (LinkedIn, Instagram, Facebook)
   - **Configurable desde el panel**: Descripción, dirección, emails, teléfono, URLs de redes sociales, texto de copyright

9. **Floating Message Widget**: 
   - Botón flotante siempre visible en la esquina inferior derecha
   - Panel deslizable con opciones rápidas
   - Acceso directo a formularios de cotización y contacto
   - Información de contacto y horarios de atención
   - Animaciones suaves con Alpine.js

## 🔧 Configuración de Base de Datos

El proyecto está configurado para usar MySQL. Asegúrate de que:

1. MySQL esté corriendo en tu servidor
2. Las credenciales en `.env` sean correctas
3. La base de datos `blue_draft_web` exista

### Estructura de Tablas

#### Tabla `users`
- `id`: Identificador único
- `name`: Nombre del usuario
- `email`: Email (debe terminar en `@bluedraft.org` para acceso al panel)
- `email_verified_at`: Fecha de verificación
- `password`: Contraseña hasheada
- `remember_token`: Token de sesión
- `created_at`, `updated_at`: Timestamps

#### Tabla `projects`
- `id`: Identificador único
- `title`: Título del proyecto
- `description`: Descripción del proyecto
- `category`: Categoría (residential, commercial, renovation)
- `image_before`: Ruta de la imagen "antes" (para slider)
- `image_after`: Ruta de la imagen "después" (para slider)
- `is_featured`: Boolean para destacar en el Home
- `created_at`, `updated_at`: Timestamps

#### Tabla `quotes`
- `id`: Identificador único
- `client_name`: Nombre del cliente
- `email`: Email del cliente
- `phone`: Teléfono (opcional)
- `address`: Dirección (opcional)
- `service_type`: Tipo de servicio solicitado
- `estimated_budget`: Presupuesto estimado
- `message`: Mensaje del cliente
- `status`: Estado (pending, contacted, completed)
- `created_at`, `updated_at`: Timestamps

#### Tabla `quote_attachments`
- `id`: Identificador único
- `quote_id`: Foreign key a `quotes`
- `file_path`: Ruta del archivo almacenado
- `file_type`: Tipo MIME del archivo
- `original_name`: Nombre original del archivo
- `file_size`: Tamaño del archivo en bytes
- `created_at`, `updated_at`: Timestamps

#### Tabla `settings`
- `id`: Identificador único
- `key`: Clave única del setting
- `value`: Valor del setting (puede ser texto o ruta de imagen)
- `type`: Tipo de setting (text, textarea, image, number, boolean)
- `group`: Grupo del setting (hero, general, contact, etc.)
- `created_at`, `updated_at`: Timestamps

**Settings del Hero disponibles:**
- `hero_badge`: Badge del Hero
- `hero_title_line1`: Primera línea del título
- `hero_title_line2`: Segunda línea del título
- `hero_description`: Descripción del Hero
- `hero_cta_text`: Texto del botón CTA
- `hero_phone`: Teléfono para enlaces (sin formato)
- `hero_phone_display`: Teléfono para mostrar (con formato)
- `hero_image_text`: Texto del placeholder del Hero
- `hero_image_svg_path`: Path del SVG del icono del placeholder
- `hero_background_image`: Ruta de la imagen de fondo del Hero

### Configuración XAMPP

Si usas XAMPP, la configuración por defecto es:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blue_draft_web
DB_USERNAME=root
DB_PASSWORD=
```

**Nota**: XAMPP incluye MariaDB por defecto, que es compatible con MySQL. Si el sitio crece, considera optimizar la configuración de MariaDB.

## 🎯 Funcionalidades Avanzadas

### Panel de Administración (Filament PHP)

El panel de administración está disponible en `/system-bd-access` y permite:

#### Gestión de Proyectos
- Crear, editar y eliminar proyectos
- Subir imágenes "antes" y "después"
- Marcar proyectos como destacados
- Categorizar proyectos (Residential, Commercial, Renovation)
- Editor de imágenes integrado
- Preview y descarga de imágenes

#### Gestión de Cotizaciones
- Ver todas las solicitudes de cotización
- Ver detalles completos de cada cotización
- Descargar fotos subidas por clientes
- Cambiar estado de cotizaciones (pending, contacted, completed)
- Filtrar y buscar cotizaciones

#### Configuración del Sitio (Settings)
El panel incluye páginas dedicadas para configurar cada sección del sitio:

- **Hero Settings**: Configuración completa del Hero section
  - Badge, títulos (2 líneas), descripción
  - Texto y botones CTA
  - Números de teléfono (link y display)
  - Imagen de fondo con overlay
  - SVG icon y texto del placeholder
  - Imagen alternativa para el placeholder

- **About Settings**: Configuración de la sección About
  - Badge, título, subtítulo
  - Dos párrafos de descripción
  - Tres estadísticas (años, proyectos, satisfacción)
  - Imagen con placeholder SVG configurable

- **Services Settings**: Configuración de la sección Services
  - Badge, título, descripción del header
  - Configuración de 3 tarjetas de servicios (título, descripción, SVG path)

- **Testimonials Settings**: Configuración de la sección Testimonials
  - Badge, título, descripción del header
  - Configuración de 3 testimonios (nombre, rol, proyecto, calificación, imagen/emoji, texto)

- **Contact Settings**: Configuración de la sección Contact
  - Badge, título, descripción
  - Información de contacto (dirección, teléfono, email, horarios)
  - Título del formulario
  - URL de Google Maps embed

- **Footer Settings**: Configuración del Footer
  - Descripción de la empresa
  - Información de contacto (dirección, emails, teléfono)
  - URLs de redes sociales (LinkedIn, Instagram, Facebook)
  - Texto de copyright

- **Gestión de Proyectos**: CRUD completo para proyectos
- **Gestión de Cotizaciones**: Visualización y gestión de solicitudes

#### Control de Acceso
- Solo usuarios con email `@bluedraft.org` pueden acceder
- Implementado en el modelo `User` con método `canAccessPanel()`
- URL discreta para mayor seguridad

### Animaciones de Scroll Reveal

Las secciones y elementos con la clase `.reveal` aparecen automáticamente con animación fade-in y desplazamiento cuando entran en el viewport.

### Filtros Dinámicos

Los filtros de proyectos funcionan sin recargar la página usando Alpine.js. Los proyectos se filtran instantáneamente por categoría.

### Visualizador Antes/Después

El slider interactivo permite arrastrar para comparar imágenes antes y después. Funciona tanto con mouse como con touch en dispositivos móviles.

### Formulario Multi-paso

El formulario de contacto está dividido en 4 pasos para mejorar la tasa de conversión:
- **Paso 1**: Selección del tipo de servicio
- **Paso 2**: Presupuesto estimado
- **Paso 3**: Información de contacto completa
- **Paso 4**: Descripción del proyecto y subida de fotos

### JSON-LD Schema Markup

El sitio incluye Schema.org LocalBusiness markup para mejorar el SEO local:
- Información de contacto estructurada
- Coordenadas geográficas
- Horarios de atención
- Área de servicio

### Widget de Mensajería Flotante

El widget flotante proporciona acceso rápido a las funciones principales del sitio:
- **Botón flotante**: Siempre visible en la esquina inferior derecha
- **Panel interactivo**: Se abre con animación suave al hacer clic
- **Accesos rápidos**: Botones directos a formularios de cotización y contacto
- **Información de contacto**: Teléfono y email con enlaces directos
- **Horarios**: Información de horarios de atención
- **Responsive**: Adaptado para dispositivos móviles y desktop

### Sistema de Notificaciones por Email

Cuando se envía un formulario:
1. Los datos se guardan en la base de datos
2. Se envía un email automático a `marcin@bluedraft.org`
3. El email incluye todos los detalles del formulario
4. Si hay fotos adjuntas, se incluyen en el email

## 🧪 Testing

Para ejecutar los tests:

```bash
php artisan test
```

## 📝 Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan optimize:clear

# Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ver rutas disponibles
php artisan route:list

# Acceder a Tinker (consola interactiva)
php artisan tinker

# Crear enlace simbólico de storage
php artisan storage:link

# Ejecutar migraciones
php artisan migrate

# Ejecutar seeders
php artisan db:seed
php artisan db:seed --class=AdminUserSeeder
php artisan db:seed --class=HeroSettingsSeeder

# Instalar Filament (ya instalado)
php artisan filament:install --panels

# Publicar assets de Filament (si es necesario)
php artisan vendor:publish --tag=filament-assets
```

## 🌐 Despliegue

### Preparación para Producción

1. Cambiar `APP_ENV=production` y `APP_DEBUG=false` en `.env`
2. Compilar assets: `npm run build`
3. Optimizar Laravel: `php artisan config:cache && php artisan route:cache`
4. Crear enlace simbólico: `php artisan storage:link`
5. Configurar el servidor web (Apache/Nginx)
6. Configurar permisos de `storage/` y `bootstrap/cache/`

### Variables de Entorno Importantes

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com
```

### Configuración del Servidor Web

#### Apache (.htaccess)

Asegúrate de que el archivo `public/.htaccess` esté configurado correctamente para redirigir todas las peticiones a `index.php`.

#### Nginx

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

## 📱 Responsive Design

El sitio está completamente optimizado para:
- **Mobile**: 320px - 767px
  - Menú hamburguesa con animaciones sofisticadas
  - Overlay oscuro con blur cuando el menú está abierto
  - Deslizamiento suave desde arriba
  - Entrada escalonada de elementos del menú
  - Cierre automático al hacer clic en enlaces
- **Tablet**: 768px - 1023px
- **Desktop**: 1024px+
  - Menú horizontal completo
  - Navegación fija con glassmorphism

## 🔒 Seguridad

- CSRF protection habilitado
- Validación de formularios
- Sanitización de inputs
- Protección contra XSS
- reCAPTCHA en formularios
- Control de acceso al panel de administración
- Validación de tipos de archivo en uploads
- Límite de tamaño de archivos (10MB)

## 📞 Información de Contacto

- **Dirección**: 358 Amboy St, Brooklyn, NY 11212, USA
- **Teléfono**: +1.3476366128
- **Email**: wojtek@bluedraft.org, marcin@bluedraft.org
- **Sitio Web**: https://bluedraft.org

## 👥 Desarrollo

### Estructura de Controladores

- `HomeController`: Maneja la página principal y todas las secciones, procesa formularios, valida reCAPTCHA, guarda cotizaciones y envía notificaciones por email

### Estructura de Vistas

- `layouts/app.blade.php`: Layout principal con navegación, footer, JSON-LD Schema y widget de mensajería flotante
- `home.blade.php`: Vista principal con todas las secciones y funcionalidades interactivas
- `emails/quote-notification.blade.php`: Plantilla de email para notificaciones de cotización
- `emails/contact-notification.blade.php`: Plantilla de email para notificaciones de contacto

### JavaScript y Animaciones

- `app.js`: Configuración de Alpine.js, Motion One y animaciones de scroll reveal
- `bootstrap.js`: Configuración de Axios para peticiones HTTP
- **Alpine.js**: Utilizado para el widget flotante, menú móvil, filtros de proyectos, formularios interactivos y slider antes/después

### Mailables (Notificaciones por Correo)

- `QuoteNotification`: Mailable para notificaciones de solicitudes de cotización (incluye adjuntos)
- `ContactNotification`: Mailable para notificaciones de formularios de contacto

### Modelos Eloquent

- `Project`: Modelo para proyectos con accessors para URLs de imágenes
- `Quote`: Modelo para cotizaciones con relación a attachments
- `QuoteAttachment`: Modelo para archivos adjuntos con relación a quotes
- `Settings`: Modelo para configuración con métodos estáticos `get()` y `set()`
- `User`: Modelo de usuario con método `canAccessPanel()` para control de acceso a Filament

## 🎯 Próximas Mejoras

- [x] **Sistema de Citas/Cotización**: Permitir a clientes subir fotos de su espacio para recibir estimaciones ✅
- [ ] **Optimización de Imágenes**: Implementar WebP automático con `spatie/laravel-medialibrary`
- [ ] **Livewire Integration**: Para filtros más avanzados y formularios reactivos
- [x] **Galería de Proyectos**: Agregar galería completa con imágenes reales de proyectos ✅
- [ ] **Sistema de Blog/Noticias**: Sección de blog para compartir proyectos y noticias
- [x] **Testimonios de Clientes**: Sección de testimonios con carrusel ✅
- [x] **Mapa Interactivo**: Integración de Google Maps para mostrar ubicación ✅
- [x] **Widget de Mensajería Flotante**: Botón flotante para acceso rápido a contacto y cotizaciones ✅
- [x] **Panel de Administración**: Panel profesional con Filament PHP ✅
- [x] **Hero Section Configurable**: Configuración completa del Hero desde el dashboard ✅
- [x] **Sistema de Settings**: Configuración dinámica del sitio desde el panel ✅
- [x] **Secciones Configurables**: Hero, About, Services, Testimonials, Contact y Footer completamente configurables desde Filament ✅
- [x] **Detección Automática de Tema**: El sitio detecta y se adapta automáticamente al tema del sistema operativo ✅
- [x] **Menú Móvil Mejorado**: Animaciones sofisticadas con hamburguesa animado, overlay, deslizamiento y entrada escalonada ✅
- [x] **Formulario de Cotización Mejorado**: Botones Next Step funcionando correctamente con validación por pasos ✅
- [ ] **Optimización de Imágenes**: Implementar WebP automático con `spatie/laravel-medialibrary`
- [ ] **Livewire Integration**: Para filtros más avanzados y formularios reactivos
- [ ] **Sistema de Blog/Noticias**: Sección de blog para compartir proyectos y noticias
- [ ] **Chat en Vivo**: Integración de chat para atención al cliente
- [ ] **Sistema de Reservas**: Calendario interactivo para agendar citas
- [ ] **Multi-idioma**: Soporte para múltiples idiomas
- [ ] **Sistema de Notificaciones Push**: Notificaciones en tiempo real para nuevas cotizaciones
- [ ] **Dashboard Analytics**: Estadísticas y métricas de visitas, formularios, etc.
- [ ] **Exportación de Datos**: Exportar cotizaciones a PDF o Excel

## 📊 Optimizaciones Técnicas Implementadas

### Frontend
- ✅ Animaciones con Motion One para mejor rendimiento
- ✅ Alpine.js para interactividad ligera (sin jQuery)
- ✅ Glassmorphism mejorado con backdrop-blur
- ✅ Scroll reveal optimizado con Intersection Observer
- ✅ Transiciones CSS optimizadas
- ✅ Overlay dinámico para imágenes de fondo
- ✅ Detección automática de tema del sistema operativo
- ✅ Menú móvil con animaciones sofisticadas (hamburguesa animado, overlay, deslizamiento, entrada escalonada)
- ✅ Soporte completo para modo oscuro/claro basado en preferencias del sistema

### Backend
- ✅ Sistema de settings configurable desde el panel
- ✅ Gestión de archivos con validación y almacenamiento seguro
- ✅ Notificaciones por email automáticas
- ✅ Validación de reCAPTCHA en servidor
- ✅ Fallback para extensión `intl` si no está disponible

### SEO
- ✅ JSON-LD Schema Markup para LocalBusiness
- ✅ Meta tags optimizados
- ✅ Estructura semántica HTML5
- ✅ URLs amigables

### Performance
- ✅ Vite para compilación rápida
- ✅ Assets optimizados y minificados
- ✅ Lazy loading preparado
- ✅ Código JavaScript modular
- ✅ Cache de configuración y rutas

## 🐛 Solución de Problemas

### Error: "The intl PHP extension is required"

Si ves este error en Filament, el sistema incluye un fallback. Si persiste:

1. Verifica que `extension=intl` esté habilitado en `php.ini`
2. Reinicia el servidor web
3. Limpia la caché: `php artisan optimize:clear`

### Imágenes no se muestran

1. Verifica que el enlace simbólico exista: `php artisan storage:link`
2. Verifica permisos de `storage/app/public`
3. Verifica que `APP_URL` en `.env` sea correcto

### Panel de administración no accesible

1. Verifica que el usuario tenga email `@bluedraft.org`
2. Verifica que el usuario esté creado en la base de datos
3. Verifica la URL: `/system-bd-access`

## 📄 Licencia

Este proyecto es privado y propiedad de Blue Draft Construction Company.

## 🙏 Agradecimientos

- [Laravel](https://laravel.com) - Framework PHP
- [Filament PHP](https://filamentphp.com) - Panel de administración
- [Tailwind CSS](https://tailwindcss.com) - Framework CSS
- [Alpine.js](https://alpinejs.dev) - Framework JavaScript ligero
- [Motion One](https://motion.dev) - Biblioteca de animaciones
- [Vite](https://vitejs.dev) - Build tool

---

**Desarrollado para Blue Draft Construction Company**

**Versión**: 1.1.0  
**Última actualización**: Diciembre 2025

## 📝 Changelog

### Versión 1.1.0 (Diciembre 2025)
- ✅ Implementada detección automática de tema del sistema operativo
- ✅ Mejorado menú móvil con animaciones sofisticadas (hamburguesa animado, overlay, deslizamiento, entrada escalonada)
- ✅ Implementadas páginas de configuración dedicadas en Filament para todas las secciones (Hero, About, Services, Testimonials, Contact, Footer)
- ✅ Corregido formulario de cotización con botones Next Step funcionando correctamente
- ✅ Agregados enlaces de redes sociales al footer (LinkedIn, Instagram, Facebook)
- ✅ Mejorada organización del menú de navegación en Filament con grupos y ordenamiento

### Versión 1.0.0 (Diciembre 2025)
- ✅ Lanzamiento inicial del proyecto
- ✅ Implementación de todas las funcionalidades base

## 📄 License

This project is **PROPRIETARY** and **CONFIDENTIAL**. 

All rights reserved. Unauthorized copying, modification, or distribution of this software, via any medium, is strictly prohibited. This software is developed exclusively for **Blue Draft Construction Company**.

Developed by **Ramiro Nunez**.
