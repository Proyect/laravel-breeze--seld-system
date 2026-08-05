# Integración de pagos

Guía para configurar y usar Stripe y Mercado Pago.

---

## Arquitectura

El sistema usa el patrón **Strategy** para abstraer las pasarelas:

```
PayController
    └── PaymentService
            ├── StripeGateway        (USD, EUR, etc.)
            └── MercadoPagoGateway   (ARS)
```

Archivos relevantes:

| Archivo | Función |
|---------|---------|
| `app/Services/Payments/PaymentGateway.php` | Interfaz común |
| `app/Services/Payments/PaymentService.php` | Selección de gateway |
| `app/Services/Payments/StripeGateway.php` | Implementación Stripe |
| `app/Services/Payments/MercadoPagoGateway.php` | Implementación Mercado Pago |
| `app/Http/Controllers/PayController.php` | Iniciar y consultar pagos |
| `app/Http/Controllers/StripeWebhookController.php` | Webhook Stripe |
| `app/Http/Controllers/MercadoPagoWebhookController.php` | Webhook Mercado Pago |

---

## Selección automática de pasarela

| Moneda | Pasarela |
|--------|----------|
| `ARS` | Mercado Pago |
| `USD`, `EUR`, otras | Stripe |

El usuario elige la moneda al crear el pago en `/payments`.

---

## Stripe

### 1. Crear cuenta

Registrarse en [stripe.com](https://stripe.com) y activar modo test.

### 2. Obtener claves

Dashboard → Developers → API keys:

```env
STRIPE_SECRET_KEY=sk_test_...
STRIPE_PUBLIC_KEY=pk_test_...
```

### 3. Configurar webhook

Dashboard → Developers → Webhooks → Add endpoint:

- **URL:** `https://tudominio.com/webhooks/stripe`
- **Eventos:** `checkout.session.completed`, `payment_intent.succeeded`

Copiar el signing secret:

```env
STRIPE_WEBHOOK_SECRET=whsec_...
```

### 4. Flujo

```
Usuario → POST /payments (currency=USD)
    → PaymentService crea registro (status: pending)
    → StripeGateway crea Checkout Session
    → Redirección a Stripe
    → Usuario paga
    → Stripe envía webhook
    → StripeWebhookController actualiza payment_status: approved
    → Usuario redirigido a /payments/success
```

### 5. Pruebas locales con Stripe CLI

```bash
stripe listen --forward-to localhost:8000/webhooks/stripe
```

---

## Mercado Pago

### 1. Crear cuenta de desarrollador

[mercadopago.com.ar/developers](https://www.mercadopago.com.ar/developers)

### 2. Obtener credenciales

Aplicación → Credenciales de prueba:

```env
MERCADOPAGO_ACCESS_TOKEN=TEST-...
MERCADOPAGO_PUBLIC_KEY=TEST-...
```

### 3. Configurar webhook

En la configuración de la aplicación:

- **URL:** `https://tudominio.com/webhooks/mercadopago`
- **Eventos:** `payment`

### 4. Flujo

```
Usuario → POST /payments (currency=ARS)
    → PaymentService crea registro (status: pending)
    → MercadoPagoGateway crea preferencia de pago
    → Redirección a Mercado Pago
    → Usuario paga
    → MP envía notificación IPN
    → MercadoPagoWebhookController actualiza payment_status
    → Usuario redirigido a /payments/success
```

### 5. Tarjetas de prueba (sandbox)

Consultar la [documentación oficial de MP](https://www.mercadopago.com.ar/developers/es/docs/checkout-api/integration-test/test-cards) para números de tarjeta de prueba.

---

## Estados de pago

| Estado | Descripción |
|--------|-------------|
| `pending` | Pago iniciado, esperando confirmación |
| `approved` | Pago confirmado por la pasarela |
| `rejected` | Pago rechazado o cancelado por el usuario |
| `refunded` | Pago reembolsado |

---

## Pagar desde una venta

1. Crear venta con estado `pending`
2. En el detalle de la venta (`/sales/{id}`), hacer clic en **Pagar**
3. El sistema crea un pago vinculado a la venta (`sale_id`)
4. Redirección a la pasarela correspondiente

---

## Sin claves configuradas

Si las variables de entorno están vacías:

- El registro de pago se crea en la base de datos
- No hay redirección a la pasarela externa
- Útil para desarrollo y tests

---

## Seguridad

- Los webhooks están excluidos de verificación CSRF (`bootstrap/app.php`)
- Stripe verifica la firma con `STRIPE_WEBHOOK_SECRET`
- Mercado Pago valida el `access_token` en cada consulta
- Los montos se validan server-side antes de crear el pago

---

## Troubleshooting

| Problema | Solución |
|----------|----------|
| No redirige a pasarela | Verificar claves en `.env`, ejecutar `php artisan config:clear` |
| Webhook no actualiza estado | Verificar URL pública accesible, revisar logs |
| Pago queda en `pending` | Confirmar que el webhook llega; revisar `storage/logs/laravel.log` |
| Error de moneda | ARS solo con MP; USD/EUR con Stripe |

---

## Documentos relacionados

- [Configuración](CONFIGURACION.md)
- [Manual de Usuario — Pagos](../MANUAL_USUARIO.md#9-pagos)
- [Rutas](RUTAS.md)
