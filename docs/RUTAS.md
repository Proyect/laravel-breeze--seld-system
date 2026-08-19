# Referencia de rutas

Listado completo de endpoints HTTP del sistema.

---

## Sitio público

| Método | Ruta | Nombre | Descripción |
|--------|------|--------|-------------|
| GET | `/` | — | Landing principal |
| GET | `/site` | `site.index` | Índice del sitio |
| GET | `/site/{site}` | `site.detail` | Detalle de sección |
| POST | `/search` | `site.search` | Búsqueda en el sitio |
| POST | `/contacto` | `contact.submit` | Formulario de contacto |
| GET | `/servicios` | `servicios.index` | Catálogo de servicios |
| GET | `/servicios/{slug}` | `servicios.detalle` | Detalle de servicio |
| POST | `/servicios/{slug}/relevamiento` | `servicios.relevamiento` | Formulario de relevamiento |
| GET | `/api/tecnologias/{categoria}` | `api.tecnologias.categoria` | API tecnologías por categoría |

---

## Autenticación

| Método | Ruta | Nombre | Descripción |
|--------|------|--------|-------------|
| GET | `/login` | `login` | Formulario de login |
| POST | `/login` | — | Procesar login |
| GET | `/register` | `register` | Formulario de registro |
| POST | `/register` | — | Procesar registro |
| POST | `/logout` | `logout` | Cerrar sesión |
| GET | `/forgot-password` | `password.request` | Solicitar reset |
| POST | `/forgot-password` | `password.email` | Enviar email de reset |
| GET | `/reset-password/{token}` | `password.reset` | Formulario de nueva contraseña |
| POST | `/reset-password` | `password.store` | Guardar nueva contraseña |
| GET | `/verify-email` | `verification.notice` | Aviso de verificación |
| GET | `/verify-email/{id}/{hash}` | `verification.verify` | Verificar email |
| POST | `/email/verification-notification` | `verification.send` | Reenviar verificación |
| GET | `/confirm-password` | `password.confirm` | Confirmar contraseña |
| POST | `/confirm-password` | — | Procesar confirmación |
| PUT | `/password` | `password.update` | Actualizar contraseña |

---

## Panel autenticado

Requiere middleware `auth`.

| Método | Ruta | Nombre | Descripción |
|--------|------|--------|-------------|
| GET | `/dashboard` | `dashboard` | Panel de control |
| GET | `/profile` | `profile.edit` | Editar perfil |
| PATCH | `/profile` | `profile.update` | Actualizar perfil |
| DELETE | `/profile` | `profile.destroy` | Eliminar cuenta |

### Ventas

| Método | Ruta | Nombre | Descripción |
|--------|------|--------|-------------|
| GET | `/sales` | `sales.index` | Listado de ventas |
| POST | `/sales` | `sales.store` | Crear venta |
| GET | `/sales/{sales}` | `sales.show` | Detalle de venta |
| PUT | `/sales/{sales}` | `sales.update` | Actualizar venta |
| DELETE | `/sales/{sales}` | `sales.destroy` | Eliminar venta |
| GET | `/sales-list/data` | `sales.list` | Datos JSON para DataTables |

### Pagos

| Método | Ruta | Nombre | Descripción |
|--------|------|--------|-------------|
| GET | `/payments` | `payments.index` | Listado e inicio de pago |
| POST | `/payments` | `payments.store` | Crear pago y redirigir |
| GET | `/payments/success` | `payments.success` | Pago exitoso |
| GET | `/payments/cancel` | `payments.cancel` | Pago cancelado |

---

## Administración

Requiere middleware `auth` + `admin`.

### Productos

| Método | Ruta | Nombre | Descripción |
|--------|------|--------|-------------|
| GET | `/products` | `products.index` | Listado de productos |
| GET | `/products/create` | `products.create` | Formulario de creación |
| POST | `/products` | `products.store` | Guardar producto |
| PUT | `/products/{product}` | `products.update` | Actualizar producto |
| DELETE | `/products/{product}` | `products.destroy` | Eliminar producto |

### Usuarios

| Método | Ruta | Nombre | Descripción |
|--------|------|--------|-------------|
| GET | `/users` | `users.index` | Listado de usuarios |
| GET | `/users/create` | `users.create` | Formulario de creación |
| POST | `/users` | `users.store` | Guardar usuario |
| PUT | `/users/{user}` | `users.update` | Actualizar usuario |
| DELETE | `/users/{user}` | `users.destroy` | Eliminar usuario |

---

## Webhooks

Sin autenticación ni CSRF.

| Método | Ruta | Nombre | Descripción |
|--------|------|--------|-------------|
| POST | `/webhooks/mercadopago` | `webhooks.mercadopago` | Notificaciones Mercado Pago |
| POST | `/webhooks/stripe` | `webhooks.stripe` | Notificaciones Stripe |

---

## Sistema

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/up` | Health check (Laravel) |

---

## Permisos por rol

| Ruta | Guest | User | Admin |
|------|-------|------|-------|
| Sitio público | ✓ | ✓ | ✓ |
| Auth (login/register) | ✓ | — | — |
| Dashboard, perfil | — | ✓ | ✓ |
| Ventas, pagos | — | ✓ (propias) | ✓ (todas) |
| Productos, usuarios | — | — | ✓ |
| Webhooks | ✓ (externo) | — | — |

---

## Listar rutas en consola

```bash
php artisan route:list
php artisan route:list --name=products
php artisan route:list --method=POST
```

---

## Documentos relacionados

- [Arquitectura](ARQUITECTURA.md)
- [Pagos](PAGOS.md)
- [Manual de Usuario](../MANUAL_USUARIO.md)
