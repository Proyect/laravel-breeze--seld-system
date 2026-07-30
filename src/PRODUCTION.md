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

## Pendiente recomendado

- Políticas/roles completos para admin CRUD
- Tests de integración con Stripe/MP (sandbox)
- Docker/Nginx + Supervisor
- CAPTCHA en formularios públicos
- Sacar Tailwind CDN del landing y pasar todo a Vite
- Purgar `APP_KEY` del historial git si fue expuesto
