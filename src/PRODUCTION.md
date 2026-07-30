# Checklist de producción

## Bloqueantes resueltos en este PR

- Webhooks excluidos de CSRF
- Stripe/Mercado Pago como dependencias de `src/composer.json`
- Webhooks rechazan firmas inválidas con HTTP 4xx/5xx
- Auth routes restauradas (`login`, `register`, `logout`, profile, dashboard)
- Monto de pago tomado desde la venta (no del request)
- `.env copy` eliminado del árbol de trabajo
- CI apunta a `src/` con PHP 8.3
- Migración de `inquiries` y endurecimiento de FKs de pagos/ventas

## Antes de desplegar

1. Rotar `APP_KEY` si el valor del `.env copy` histórico se usó fuera de local.
2. Configurar secrets reales:
   - `STRIPE_SECRET_KEY`, `STRIPE_PUBLIC_KEY`, `STRIPE_WEBHOOK_SECRET`
   - `MERCADOPAGO_ACCESS_TOKEN`, `MERCADOPAGO_PUBLIC_KEY`, `MERCADOPAGO_WEBHOOK_SECRET`
3. Producción:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://tu-dominio.com
   LOG_STACK=daily
   LOG_LEVEL=warning
   SESSION_SECURE_COOKIE=true
   MAIL_MAILER=smtp
   ```
4. Ejecutar:
   ```bash
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   npm ci && npm run build
   ```
5. Correr worker de cola: `php artisan queue:work --tries=3`
6. Apuntar webhooks:
   - Stripe → `POST /webhooks/stripe`
   - Mercado Pago → `POST /webhooks/mercadopago`
7. Health check básico: `GET /up`

## Pendiente recomendado (priorizado)

### Alta
1. **Reparar CRUD admin** (`ProductController`, `UserController`, `SalesController`): hoy `StoreProductRequest`/`UpdateProductRequest` deniegan todo, `ProductController` importa Request de Guzzle, y `UserController@store` usa `User::created()` inválido.
2. **Policies por rol**: restringir `/users` a admin; ventas/productos con ownership; no exponer listados globales a cualquier usuario autenticado.
3. **Idempotencia fuerte de webhooks**: persistir `event_id` / `x-request-id` para evitar reprocesos y race conditions.
4. **Reconciliación de montos en webhook**: validar amount/currency del proveedor contra el pago local antes de aprobar.

### Media
5. **Docker + Nginx + Supervisor** (php-fpm, queue worker, scheduler).
6. **CAPTCHA / honeypot** en `/contacto` y relevamientos.
7. **Quitar Tailwind/Swiper CDN** del landing y compilar todo con Vite + SRI.
8. **Actualizar deps PHP** (`composer update` / audit: hay advisories low en symfony/yaml transitivo).
9. **Observabilidad**: Sentry/Log drain + alertas de webhooks fallidos.

### Baja / despliegue
10. Purgar `APP_KEY` del historial git si fue expuesto.
11. Health check profundo (`/up` + DB/queue/cache).
12. Seeders de producción sin usuario `test@example.com` / password `password`.

## Suite de tests

```bash
cd src
php artisan test
```

Cobertura actual: health/páginas públicas, auth/registro/logout/profile, contacto, relevamiento, schema, autorización de pagos, webhooks Stripe/MP (firma + aprobación + idempotencia básica).
