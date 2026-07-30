# Laravel Sell / Payment System

Aplicación Laravel 12 ubicada en `src/`, con pasarelas Stripe y Mercado Pago.

## Requisitos

- PHP 8.2+
- Composer
- Node.js 20+ / npm
- MySQL o SQLite

## Instalación

```bash
cd src
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite   # o configurar MySQL en .env
php artisan migrate
npm install
npm run build
php artisan serve
```

## Producción

Ver `src/PRODUCTION.md` para el checklist de despliegue, seguridad y pagos.

## Estructura

- `src/` — aplicación Laravel
- `.github/workflows/laravel.yml` — CI (tests + build de assets)
