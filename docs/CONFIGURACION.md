# Configuración

Referencia completa de variables de entorno y servicios externos.

---

## Archivo `.env`

Copiar desde `.env.example`:

```bash
cp .env.example .env
php artisan key:generate
```

---

## Aplicación

| Variable | Descripción | Valor por defecto |
|----------|-------------|-------------------|
| `APP_NAME` | Nombre de la aplicación | `Infrasoft` |
| `APP_ENV` | Entorno (`local`, `production`) | `local` |
| `APP_KEY` | Clave de encriptación (generar con `artisan key:generate`) | — |
| `APP_DEBUG` | Mostrar errores detallados | `true` (dev) |
| `APP_URL` | URL base de la aplicación | `http://localhost` |
| `APP_LOCALE` | Idioma | `es` |
| `APP_FALLBACK_LOCALE` | Idioma de respaldo | `en` |
| `APP_FAKER_LOCALE` | Locale para datos de prueba | `es_AR` |

> En producción: `APP_DEBUG=false` y `APP_ENV=production`.

---

## Base de datos

### SQLite (desarrollo)

```env
DB_CONNECTION=sqlite
```

Crear el archivo: `touch database/database.sqlite`

### MySQL (producción)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=infrasoft
DB_USERNAME=root
DB_PASSWORD=secret
```

---

## Sesiones y caché

| Variable | Descripción | Valor |
|----------|-------------|-------|
| `SESSION_DRIVER` | Driver de sesiones | `database` |
| `SESSION_LIFETIME` | Duración en minutos | `120` |
| `CACHE_STORE` | Driver de caché | `database` |
| `QUEUE_CONNECTION` | Driver de colas | `database` |

---

## Correo electrónico

### Desarrollo (log)

```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS="contacto@infrasoft.com.ar"
MAIL_FROM_NAME="${APP_NAME}"
```

Los emails se registran en `storage/logs/laravel.log`.

### Producción (SMTP)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.tuservidor.com
MAIL_PORT=587
MAIL_USERNAME=tu_usuario
MAIL_PASSWORD=tu_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="contacto@infrasoft.com.ar"
MAIL_FROM_NAME="Infrasoft"
```

### Gmail / servicios externos

Para Gmail usar contraseña de aplicación y:

```env
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
```

---

## Stripe (pagos internacionales)

Obtener claves en [dashboard.stripe.com](https://dashboard.stripe.com).

```env
STRIPE_SECRET_KEY=sk_test_...
STRIPE_PUBLIC_KEY=pk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...
```

| Variable | Uso |
|----------|-----|
| `STRIPE_SECRET_KEY` | API del servidor (crear sesiones de pago) |
| `STRIPE_PUBLIC_KEY` | Frontend (si se usa Stripe.js) |
| `STRIPE_WEBHOOK_SECRET` | Verificar firma de webhooks |

**Webhook URL en Stripe:** `https://tudominio.com/webhooks/stripe`

Eventos recomendados: `checkout.session.completed`, `checkout.session.async_payment_succeeded`, `checkout.session.async_payment_failed`, `checkout.session.expired`, `payment_intent.payment_failed`, `charge.refunded`.

Si `STRIPE_WEBHOOK_SECRET` no está configurado el webhook responde 503; con firma inválida responde 400.

---

## Mercado Pago (pagos en ARS)

Obtener credenciales en [mercadopago.com.ar/developers](https://www.mercadopago.com.ar/developers).

```env
MERCADOPAGO_ACCESS_TOKEN=APP_USR-...
MERCADOPAGO_PUBLIC_KEY=APP_USR-...
MERCADOPAGO_NOTIFICATION_TOKEN=un_token_aleatorio_largo
```

| Variable | Uso |
|----------|-----|
| `MERCADOPAGO_ACCESS_TOKEN` | Token de acceso (producción o sandbox) |
| `MERCADOPAGO_PUBLIC_KEY` | Clave pública para checkout |
| `MERCADOPAGO_NOTIFICATION_TOKEN` | **Obligatorio.** Se agrega como `?token=` a la `notification_url`; sin él el webhook responde 403 |

**Webhook URL:** `https://tudominio.com/webhooks/mercadopago`

---

## Vite

```env
VITE_APP_NAME="${APP_NAME}"
```

Variables con prefijo `VITE_` están disponibles en JavaScript via `import.meta.env`.

---

## Logging

```env
LOG_CHANNEL=stack
LOG_LEVEL=debug        # debug en dev, error en prod
```

---

## Ejemplo completo para producción

```env
APP_NAME=Infrasoft
APP_ENV=production
APP_KEY=base64:...
APP_DEBUG=false
APP_URL=https://infrasoft.com.ar

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=infrasoft
DB_USERNAME=infrasoft_user
DB_PASSWORD=password_seguro

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.infrasoft.com.ar
MAIL_PORT=587
MAIL_USERNAME=noreply@infrasoft.com.ar
MAIL_PASSWORD=...
MAIL_FROM_ADDRESS="contacto@infrasoft.com.ar"
MAIL_FROM_NAME="Infrasoft"

STRIPE_SECRET_KEY=sk_live_...
STRIPE_PUBLIC_KEY=pk_live_...
STRIPE_WEBHOOK_SECRET=whsec_...

MERCADOPAGO_ACCESS_TOKEN=APP_USR-...
MERCADOPAGO_PUBLIC_KEY=APP_USR-...
MERCADOPAGO_NOTIFICATION_TOKEN=...

SESSION_SECURE_COOKIE=true
LOG_LEVEL=error
SALES_PENDING_TTL_HOURS=48

# Solo para el primer `php artisan db:seed --force`
ADMIN_EMAIL=admin@infrasoft.com.ar
ADMIN_PASSWORD=una_contraseña_larga_y_unica
```

---

## Documentos relacionados

- [Pagos](PAGOS.md) — configuración detallada de pasarelas
- [Despliegue](DESPLIEGUE.md) — checklist de producción
- [Instalación](INSTALACION.md)
