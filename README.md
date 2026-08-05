# Laravel Breeze Seld System

Sistema de ventas y pagos para **Infrasoft** con sitio corporativo, módulo de productos, ventas, usuarios y pasarelas de pago (Stripe + Mercado Pago).

## Requisitos

- Node.js 18+ y npm
- SQLite (por defecto) o MySQL

> **Windows:** Este proyecto incluye PHP 8.3 y Composer en `tools/`. No necesitás instalarlos globalmente.

## Instalación

```powershell
cd src

# Usar los wrappers locales (Windows)
.\composer.bat install
npm install

copy .env.example .env
.\php.bat artisan key:generate

# SQLite (por defecto)
New-Item -ItemType File -Path database\database.sqlite -Force

.\php.bat artisan migrate --seed
npm run build
```

## Desarrollo

```powershell
cd src
.\composer.bat run dev
```

Esto inicia el servidor Laravel, cola, logs y Vite en paralelo. La app queda en `http://localhost:8000`.

## Usuarios de prueba

| Email | Contraseña | Rol |
|-------|-----------|-----|
| admin@infrasoft.com.ar | password | admin |
| user@example.com | password | user |

## Variables de entorno

```env
APP_URL=http://localhost:8000

# Stripe (pagos internacionales)
STRIPE_SECRET_KEY=
STRIPE_PUBLIC_KEY=
STRIPE_WEBHOOK_SECRET=

# Mercado Pago (pagos en ARS)
MERCADOPAGO_ACCESS_TOKEN=
MERCADOPAGO_PUBLIC_KEY=
```

## Rutas principales

| Ruta | Descripción |
|------|-------------|
| `/` | Sitio corporativo |
| `/login` | Inicio de sesión |
| `/register` | Registro |
| `/dashboard` | Panel de control |
| `/products` | CRUD productos (admin) |
| `/users` | CRUD usuarios (admin) |
| `/sales` | Ventas |
| `/payments` | Pagos |
| `/servicios` | Catálogo de servicios |

## Tests

### PHPUnit (backend) — 41 tests

```powershell
cd src
.\composer.bat run test
# o alternativamente:
npm run test:php
```

Cubre: autenticación, productos, usuarios, ventas, pagos, contacto, páginas públicas y webhooks.

### Cypress (E2E) — 21 tests

Terminal 1 — servidor:

```powershell
cd src
.\php.bat artisan serve --host=127.0.0.1 --port=8000
```

Terminal 2 — tests E2E:

```powershell
cd src
npm run cypress:run
```

### Ejecutar todo (Windows)

```powershell
cd src
.\test.bat
```

## Estructura

La aplicación Laravel vive en `src/`. El `composer.json` de la raíz del repositorio no se usa; todas las dependencias están en `src/composer.json`.
