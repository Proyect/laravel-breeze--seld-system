# Guía de desarrollo

Convenciones, comandos y flujo de trabajo para desarrolladores.

---

## Entorno de desarrollo

### Arranque diario

```powershell
cd src
.\composer.bat run dev
```

Esto ejecuta en paralelo:
- Servidor Laravel (`php artisan serve`)
- Cola de trabajos (`php artisan queue:listen`)
- Logs en tiempo real (`php artisan pail`)
- Vite dev server (`npm run dev`)

### Solo servidor + Vite

```powershell
# Terminal 1
.\php.bat artisan serve

# Terminal 2
npm run dev
```

---

## Convenciones de código

### PHP / Laravel

- PSR-12 para estilo de código
- Controladores delgados; lógica de negocio en Services
- Validación en Form Requests (`app/Http/Requests/`)
- Nombres de rutas con notación de puntos: `products.index`, `sales.show`
- Modelos en singular (`Product`, `Sales`, `User`)

### Blade

- Layouts en `resources/views/layouts/`
- Componentes reutilizables en `resources/views/components/`
- Logo corporativo: `<x-infrasoft-logo size="md" />`
- Sitio público extiende `layouts.landing-tailwind`
- Panel admin extiende `layouts.app`

### JavaScript / CSS

- Entry point: `resources/js/app.js`
- Estilos admin: `resources/css/app.css` (Tailwind 4)
- Estilos servicios: `resources/css/servicios.css`
- Sitio público usa Tailwind CDN (no requiere build)

### Git

- Commits en español o inglés, mensajes descriptivos
- No commitear `.env`, `database.sqlite`, `tools/php/`, `node_modules/`
- Ejecutar tests antes de push

---

## Comandos útiles

### Artisan

```bash
php artisan migrate              # Ejecutar migraciones
php artisan migrate:fresh --seed # Resetear BD con datos de prueba
php artisan route:list           # Listar todas las rutas
php artisan make:model Foo -mcr  # Modelo + migración + controller + resource
php artisan tinker               # REPL interactivo
php artisan cache:clear          # Limpiar caché
php artisan config:clear         # Limpiar config cacheada
```

### Composer

```bash
composer run test        # PHPUnit
composer run dev         # Servidor + cola + logs + Vite
composer require paquete # Agregar dependencia
```

### npm

```bash
npm run dev              # Vite dev server
npm run build            # Build de producción
npm run cypress:open     # Cypress interactivo
npm run cypress:run      # Cypress headless
```

---

## Agregar un nuevo módulo

### 1. Migración y modelo

```bash
php artisan make:model MiModulo -m
```

### 2. Controlador y rutas

```bash
php artisan make:controller MiModuloController --resource
```

Registrar en `routes/web.php` dentro del grupo `auth` o `admin` según corresponda.

### 3. Vistas

Crear en `resources/views/mi-modulo/` siguiendo el patrón de productos o ventas (tabla DataTables + modales Bootstrap).

### 4. Tests

```bash
php artisan make:test MiModuloTest
```

Agregar tests Feature en `tests/Feature/`.

### 5. Navegación

Actualizar `resources/views/layouts/navigation.blade.php` si el módulo requiere enlace en el menú.

---

## Middleware personalizado

| Alias | Clase | Uso |
|-------|-------|-----|
| `admin` | `EnsureUserIsAdmin` | Rutas solo para administradores |

Registrado en `bootstrap/app.php`.

---

## Seeders

Datos de prueba en `database/seeders/DatabaseSeeder.php`:

- Usuario admin: `admin@infrasoft.com.ar` / `password`
- Usuario regular: `user@example.com` / `password`
- Productos de ejemplo

```bash
php artisan db:seed
php artisan migrate:fresh --seed  # Reset completo
```

---

## Debugging

### Logs

```bash
php artisan pail          # Logs en tiempo real
tail -f storage/logs/laravel.log
```

### Mail en desarrollo

Por defecto `MAIL_MAILER=log` — los emails se escriben en el log, no se envían.

### Tinker

```bash
php artisan tinker
>>> User::where('role', 'admin')->first()
>>> Sales::with('details')->get()
```

---

## Estructura de tests

```
tests/
├── CreatesUsers.php       # Trait para crear usuarios en tests
├── Feature/
│   ├── AuthenticationTest.php
│   ├── ProductTest.php
│   ├── UserManagementTest.php
│   ├── SalesTest.php
│   ├── PaymentTest.php
│   ├── ContactTest.php
│   └── PublicPagesTest.php
└── Unit/
```

```
cypress/
├── e2e/
│   ├── public.cy.js
│   ├── auth.cy.js
│   ├── admin.cy.js
│   ├── sales-payments.cy.js
│   └── contact.cy.js
└── support/
    └── commands.js        # cy.login(), cy.loginAsAdmin()
```

Ver [Testing](TESTING.md) para más detalle.

---

## Assets y marca

- Logo: `public/media/img/logo-infrasoft.png`
- Componente: `<x-infrasoft-logo>`
- Colores: ver [Marca](MARCA.md)

---

## Documentos relacionados

- [Instalación](INSTALACION.md)
- [Configuración](CONFIGURACION.md)
- [Testing](TESTING.md)
- [Rutas](RUTAS.md)
