# Notas del proyecto

## Estructura

La aplicación Laravel activa está en `src/`. El `composer.json` raíz no se usaba y fue eliminado; las dependencias reales están en `src/composer.json`.

## Herramientas portátiles

Desde `src/` se puede usar el PHP y Composer incluidos:

```bash
../php.bat -l archivo.php
../php.bat artisan test
../composer.bat install
```

## Tests

El suite completo se corre con:

```bash
../php.bat artisan test
```

## Variables de entorno importantes

Configurar en `src/.env`:

- `STRIPE_SECRET_KEY`
- `STRIPE_PUBLIC_KEY`
- `STRIPE_WEBHOOK_SECRET`
- `MERCADOPAGO_ACCESS_TOKEN`
- `MERCADOPAGO_PUBLIC_KEY`
- `MERCADOPAGO_NOTIFICATION_TOKEN`

`src/phpunit.xml` configura `MERCADOPAGO_NOTIFICATION_TOKEN` para el entorno de testing.
