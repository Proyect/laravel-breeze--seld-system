# Arquitectura del sistema

Visión general de la estructura técnica del proyecto.

---

## Descripción general

El sistema combina un **sitio corporativo público** con un **backend de gestión** (ventas, productos, usuarios y pagos) para Infrasoft.

```
┌─────────────────────────────────────────────────────────┐
│                    Navegador (cliente)                   │
└──────────────────────────┬──────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────┐
│              Laravel 12 (src/) — PHP 8.2+                 │
│  ┌─────────────┐  ┌──────────────┐  ┌─────────────────┐ │
│  │ Sitio público│  │ Auth Breeze  │  │ Panel admin     │ │
│  │ Landing      │  │ Login/Registro│  │ CRUD + Ventas  │ │
│  │ Servicios    │  │ Perfil       │  │ Pagos           │ │
│  └─────────────┘  └──────────────┘  └─────────────────┘ │
│                           │                               │
│  ┌────────────────────────▼────────────────────────────┐ │
│  │           PaymentService (Strategy Pattern)          │ │
│  │     StripeGateway  │  MercadoPagoGateway            │ │
│  └─────────────────────────────────────────────────────┘ │
└──────────────────────────┬──────────────────────────────┘
                           │
        ┌──────────────────┼──────────────────┐
        ▼                  ▼                  ▼
   SQLite/MySQL      Stripe API        Mercado Pago API
```

---

## Stack tecnológico

| Capa | Tecnología |
|------|------------|
| Backend | Laravel 12, PHP 8.2+ |
| Autenticación | Laravel Breeze (sesiones) |
| Base de datos | SQLite (dev) / MySQL (prod) |
| Frontend público | Tailwind CSS (CDN), Swiper.js |
| Frontend admin | Tailwind 4 + Vite, Bootstrap 5, DataTables |
| Pagos | Stripe PHP SDK, Mercado Pago (REST) |
| Tests | PHPUnit 11, Cypress 15 |
| Build | Vite 5 |

---

## Estructura de directorios

```
laravel-breeze--seld-system/
├── docs/                    # Documentación del proyecto
├── tools/                   # PHP y Composer portables (Windows)
├── MANUAL_USUARIO.md        # Manual para usuarios finales
├── README.md                # Inicio rápido
└── src/                     # Aplicación Laravel
    ├── app/
    │   ├── Http/
    │   │   ├── Controllers/     # Controladores HTTP
    │   │   ├── Middleware/      # EnsureUserIsAdmin
    │   │   └── Requests/        # Form Requests (validación)
    │   ├── Models/              # Eloquent models
    │   └── Services/
    │       └── Payments/        # Gateways de pago
    ├── database/
    │   ├── migrations/
    │   └── seeders/
    ├── public/
    │   └── media/img/           # Logo y assets estáticos
    ├── resources/
    │   ├── views/               # Blade templates
    │   ├── css/                 # Tailwind + estilos
    │   └── js/                  # Vite entry points
    ├── routes/
    │   ├── web.php              # Rutas principales
    │   └── auth.php             # Rutas de autenticación
    ├── tests/                   # PHPUnit (Feature + Unit)
    └── cypress/                 # Tests E2E
```

---

## Módulos funcionales

### 1. Sitio público

- **Landing** (`/`) — Página principal con hero, servicios, testimonios y contacto
- **Servicios** (`/servicios`) — Catálogo y detalle de servicios
- **Contacto** — Formulario que guarda en `inquiries` y envía email
- **Búsqueda** — Endpoint POST `/search`

**Layout:** `layouts/landing-tailwind.blade.php`

### 2. Autenticación

Basado en Laravel Breeze:

- Login, registro, recuperación de contraseña
- Verificación de email (opcional)
- Gestión de perfil

**Layout:** `layouts/guest.blade.php` (auth), `layouts/app.blade.php` (autenticado)

### 3. Panel de administración

Acceso restringido por rol (`admin` middleware):

| Módulo | Controlador | Función |
|--------|-------------|---------|
| Productos | `ProductController` | CRUD de productos |
| Usuarios | `UserController` | CRUD de usuarios |
| Ventas | `SalesController` | Gestión de ventas |
| Pagos | `PayController` | Iniciar y consultar pagos |

### 4. Sistema de pagos

Patrón Strategy con interfaz `PaymentGateway`:

```
PaymentService
├── StripeGateway      → USD y otras monedas
└── MercadoPagoGateway → ARS (pesos argentinos)
```

Los webhooks (`/webhooks/stripe`, `/webhooks/mercadopago`) actualizan el estado del pago sin CSRF.

---

## Roles y permisos

| Rol | Middleware | Acceso |
|-----|-----------|--------|
| `guest` | — | Sitio público, login, registro |
| `user` | `auth` | Dashboard, ventas propias, pagos, perfil |
| `admin` | `auth` + `admin` | Todo lo anterior + productos y usuarios |

Definido en `User.role` y verificado por `EnsureUserIsAdmin`.

---

## Flujo de una venta

```
Usuario autenticado
    → Crea venta (SalesController::store)
    → Estado: pending
    → Inicia pago (PayController::store)
    → Redirección a Stripe o Mercado Pago
    → Webhook confirma pago
    → Estado pago: approved
    → Admin actualiza venta: processing → shipped → completed
```

---

## Frontend

### Sitio público

- Tailwind via CDN en `landing-tailwind.blade.php`
- JavaScript vanilla + Swiper para sliders
- Sin build de Vite requerido para la landing

### Panel admin

- Vite compila `resources/css/app.css` y `resources/js/app.js`
- jQuery + DataTables para tablas AJAX
- Bootstrap 5 para modales y formularios
- Alpine.js para interactividad ligera

---

## Seguridad

- CSRF en todos los formularios (excepto webhooks)
- Middleware `auth` para rutas privadas
- Middleware `admin` para rutas de administración
- Contraseñas hasheadas con bcrypt
- Validación via Form Requests

---

## Health check

Laravel expone `/up` para verificar que la aplicación responde (útil en despliegue).

---

## Documentos relacionados

- [Base de datos](BASE_DE_DATOS.md)
- [Rutas](RUTAS.md)
- [Pagos](PAGOS.md)
- [Despliegue](DESPLIEGUE.md)
