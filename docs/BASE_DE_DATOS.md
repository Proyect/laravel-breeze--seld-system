# Base de datos

Esquema, migraciones, relaciones y seeders.

---

## Diagrama de relaciones

```
users ─────────────┬──────── sales ──────── sales_details
  │                │            │
  │                │            └──── product_sales ──── products
  │                │
  │                └──────── payments
  │
  └──────── inquiries

page_sections (contenido del sitio)
product_details (detalles adicionales de productos)
```

---

## Tablas principales

### `users`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint | PK |
| name | string | Nombre |
| lastName | string | Apellido |
| cuil | string | CUIL (opcional) |
| email | string | Email único |
| phone | string | Teléfono |
| address | string | Dirección |
| password | string | Hash bcrypt |
| role | string | `admin` o `user` |
| email_verified_at | timestamp | Verificación de email |
| remember_token | string | Token "recordarme" |
| timestamps | | created_at, updated_at |

### `products`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint | PK |
| name | string | Nombre del producto |
| description | text | Descripción |
| price | decimal(10,2) | Precio |
| stock | integer | Stock disponible |
| status | enum | `active`, `inactive` |
| images | json | URLs de imágenes (opcional) |
| timestamps | | |

### `sales`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint | PK |
| user_id | bigint | FK → users |
| status | enum | `pending`, `processing`, `shipped`, `completed` |
| total_amount | decimal(10,2) | Total de la venta |
| timestamps | | |

### `sales_details`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint | PK |
| sales_id | bigint | FK → sales |
| product_id | bigint | FK → products |
| quantity | integer | Cantidad |
| unit_price | decimal(10,2) | Precio unitario al momento de la venta |
| timestamps | | |

### `payments`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint | PK |
| sale_id | bigint | FK → sales (opcional) |
| method | string | Método de pago |
| status | enum | `active`, `inactive` |
| amount | decimal(10,2) | Monto |
| currency | string(3) | `ARS`, `USD`, etc. |
| provider | string | `stripe`, `mercadopago` |
| provider_payment_id | string | ID en la pasarela |
| payment_status | enum | `pending`, `approved`, `rejected`, `refunded` |
| metadata | json | Datos adicionales del proveedor |
| timestamps | | |

### `inquiries`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint | PK |
| user_id | bigint | FK → users (opcional) |
| name | string | Nombre del contacto |
| email | string | Email |
| phone | string | Teléfono |
| country | string | País |
| city | string | Ciudad |
| message | text | Mensaje |
| status | enum | `pending`, `read`, `responded` |
| timestamps | | |

### `page_sections`

Contenido dinámico del sitio corporativo (secciones de páginas).

### `product_sales` (pivot)

Tabla pivote para relación muchos-a-muchos entre productos y ventas.

---

## Migraciones

Ubicación: `database/migrations/`

```bash
php artisan migrate              # Ejecutar pendientes
php artisan migrate:rollback     # Revertir último batch
php artisan migrate:fresh --seed # Reset completo + seeders
php artisan migrate:status       # Estado de migraciones
```

### Orden de ejecución

1. `create_users_table` — usuarios, sesiones, password resets
2. `create_cache_table`, `create_jobs_table` — infraestructura Laravel
3. `create_products_table` — productos
4. `create_sales_table`, `create_sales_details_table` — ventas
5. `create_payments_table` — pagos base
6. `add_role_to_users_table` — campo role
7. `update_payments_table_for_gateways` — campos Stripe/MP
8. `create_inquiries_table` — consultas de contacto
9. `create_product_sales_table` — pivot productos-ventas
10. `update_sales_details_table` — ajustes en detalles
11. `create_page_sections_table` — secciones del sitio

---

## Seeders

### DatabaseSeeder

Crea:

| Entidad | Datos |
|---------|-------|
| Admin | `admin@infrasoft.com.ar` / `password` / role: admin |
| Usuario | `user@example.com` / `password` / role: user |
| Productos | Hosting Web Básico, Desarrollo Web, Soporte Técnico |

```bash
php artisan db:seed
php artisan db:seed --class=DatabaseSeeder
```

---

## Modelos Eloquent

| Modelo | Relaciones |
|--------|------------|
| `User` | hasMany Sales |
| `Product` | belongsToMany Sales |
| `Sales` | belongsTo User, hasMany SalesDetail, hasMany Payment |
| `SalesDetail` | belongsTo Sales, belongsTo Product |
| `Payment` | belongsTo Sales |
| `Inquiry` | belongsTo User (nullable) |
| `PageSection` | — |

---

## Backup

### SQLite

```bash
cp database/database.sqlite database/backup-$(date +%Y%m%d).sqlite
```

### MySQL

```bash
mysqldump -u root -p infrasoft > backup.sql
```

---

## Documentos relacionados

- [Arquitectura](ARQUITECTURA.md)
- [Instalación](INSTALACION.md)
- [Desarrollo](DESARROLLO.md)
