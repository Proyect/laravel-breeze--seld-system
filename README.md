# Laravel Breeze Seld System

Sistema de ventas y pagos para **Infrasoft** con sitio corporativo, módulo de productos, ventas, usuarios y pasarelas de pago (Stripe + Mercado Pago).

---

## Inicio rápido

```powershell
.\tools\setup.ps1          # Windows: descarga PHP + Composer
cd src
.\composer.bat install
npm install
copy .env.example .env
.\php.bat artisan key:generate
New-Item -ItemType File -Path database\database.sqlite -Force
.\php.bat artisan migrate --seed
npm run build
.\composer.bat run dev
```

Abrir **http://localhost:8000**

| Email | Contraseña | Rol |
|-------|-----------|-----|
| admin@infrasoft.com.ar | password | admin |
| user@example.com | password | user |

---

## Documentación

### Usuarios

| Documento | Descripción |
|-----------|-------------|
| [Manual de Usuario](MANUAL_USUARIO.md) | Guía completa para clientes y administradores |

### Desarrolladores

| Documento | Descripción |
|-----------|-------------|
| [Índice de documentación](docs/README.md) | Punto de entrada a toda la documentación |
| [Instalación](docs/INSTALACION.md) | Setup detallado Windows/Linux |
| [Arquitectura](docs/ARQUITECTURA.md) | Estructura y módulos del sistema |
| [Desarrollo](docs/DESARROLLO.md) | Convenciones y flujo de trabajo |
| [Configuración](docs/CONFIGURACION.md) | Variables de entorno |
| [Base de datos](docs/BASE_DE_DATOS.md) | Esquema y migraciones |
| [Rutas](docs/RUTAS.md) | Referencia de endpoints HTTP |
| [Pagos](docs/PAGOS.md) | Stripe y Mercado Pago |
| [Testing](docs/TESTING.md) | PHPUnit y Cypress |
| [Despliegue](docs/DESPLIEGUE.md) | Producción y servidor |
| [Marca](docs/MARCA.md) | Logo y colores corporativos |
| [Contribución](CONTRIBUTING.md) | Cómo colaborar |

---

## Stack

| Capa | Tecnología |
|------|------------|
| Backend | Laravel 12, PHP 8.2+ |
| Frontend | Tailwind 4, Vite, Bootstrap 5 |
| Base de datos | SQLite (dev) / MySQL (prod) |
| Pagos | Stripe + Mercado Pago |
| Tests | PHPUnit (41) + Cypress (21) |

---

## Rutas principales

| Ruta | Descripción |
|------|-------------|
| `/` | Sitio corporativo |
| `/servicios` | Catálogo de servicios |
| `/login` | Inicio de sesión |
| `/dashboard` | Panel de control |
| `/products` | Productos (admin) |
| `/users` | Usuarios (admin) |
| `/sales` | Ventas |
| `/payments` | Pagos |

Ver [referencia completa de rutas](docs/RUTAS.md).

---

## Tests

```powershell
cd src
.\composer.bat run test      # PHPUnit — 41 tests
npm run cypress:run        # Cypress — 21 tests (servidor activo)
.\test.bat                 # Ambos (Windows)
```

Ver [guía de testing](docs/TESTING.md).

---

## Estructura del repositorio

```
laravel-breeze--seld-system/
├── docs/                # Documentación técnica
├── tools/               # PHP/Composer portables (Windows)
├── MANUAL_USUARIO.md    # Manual para usuarios finales
├── README.md            # Este archivo
└── src/                 # Aplicación Laravel
    ├── app/             # Código PHP
    ├── database/        # Migraciones y seeders
    ├── public/          # Assets públicos (logo, media)
    ├── resources/       # Views, CSS, JS
    ├── routes/          # Rutas HTTP
    ├── tests/           # PHPUnit
    └── cypress/         # Tests E2E
```

La aplicación Laravel vive en `src/`. El `composer.json` de la raíz no se usa.

---

## Licencia

MIT
