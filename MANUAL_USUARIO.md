# Manual de Usuario — Sistema Infrasoft

**Versión:** 1.0  
**Plataforma:** Laravel Breeze Seld System  
**Empresa:** Infrasoft — Servicios Informáticos

> **Documentación técnica:** Para instalación, desarrollo y despliegue, consultá el [índice de documentación](docs/README.md).

---

## Índice

1. [Introducción](#1-introducción)
2. [Roles de usuario](#2-roles-de-usuario)
3. [Acceso al sistema](#3-acceso-al-sistema)
4. [Sitio público](#4-sitio-público)
5. [Panel de control](#5-panel-de-control)
6. [Gestión de productos](#6-gestión-de-productos-solo-administrador)
7. [Gestión de usuarios](#7-gestión-de-usuarios-solo-administrador)
8. [Ventas](#8-ventas)
9. [Pagos](#9-pagos)
10. [Perfil de usuario](#10-perfil-de-usuario)
11. [Estados y flujos](#11-estados-y-flujos)
12. [Preguntas frecuentes](#12-preguntas-frecuentes)

---

## 1. Introducción

Este sistema combina dos funciones principales:

| Módulo | Descripción |
|--------|-------------|
| **Sitio corporativo** | Página pública de Infrasoft con información de servicios, contacto y catálogo |
| **Sistema de gestión** | Panel privado para administrar productos, usuarios, ventas y pagos |

El sistema permite a los clientes registrarse, realizar compras y pagar mediante **Mercado Pago** (pesos argentinos) o **Stripe** (otras monedas).

---

## 2. Roles de usuario

Existen dos tipos de cuenta:

### Administrador (`admin`)

Puede acceder a **todas** las funciones del sistema:

- Panel de control
- Productos (crear, editar, eliminar)
- Usuarios (crear, editar, eliminar)
- Ventas (ver todas)
- Pagos

### Usuario (`user`)

Puede acceder a funciones limitadas:

- Panel de control
- Sus propias ventas
- Pagos
- Perfil personal

**No puede** acceder a Productos ni Usuarios.

---

## 3. Acceso al sistema

### 3.1 Iniciar sesión

1. Abrí el navegador y entrá a la dirección del sistema (ej: `http://localhost:8000`).
2. Hacé clic en **Log in** o navegá a `/login`.
3. Ingresá tu **email** y **contraseña**.
4. Presioná **Log in**.

Si las credenciales son correctas, serás redirigido al **Panel de control**.

### 3.2 Registrarse

1. Navegá a `/register`.
2. Completá: nombre, email y contraseña (con confirmación).
3. Presioná **Register**.

La cuenta se crea con rol **usuario** por defecto.

### 3.3 Cerrar sesión

1. En la barra superior, hacé clic en tu nombre (ej: "Admin").
2. Seleccioná **Log Out**.

### 3.4 Recuperar contraseña

1. En la pantalla de login, hacé clic en **Forgot your password?**
2. Ingresá tu email.
3. Revisá tu bandeja de entrada y seguí el enlace para restablecer la contraseña.

### 3.5 Usuarios de demostración

Si el sistema fue instalado con datos de prueba (`php artisan migrate --seed`):

| Rol | Email | Contraseña |
|-----|-------|------------|
| Administrador | `admin@infrasoft.com.ar` | `password` |
| Usuario | `user@example.com` | `password` |

> **Importante:** Cambiá estas contraseñas en un entorno de producción.

---

## 4. Sitio público

El sitio público no requiere iniciar sesión.

### 4.1 Página principal (`/`)

La landing incluye:

- Presentación de Infrasoft
- Servicios destacados
- Formulario de contacto
- Información institucional

### 4.2 Catálogo de servicios (`/servicios`)

Muestra todos los servicios disponibles:

- Data Science
- Desarrollo de Software
- Seguridad Informática
- SaaS y Soluciones en la Nube

Hacé clic en cualquier servicio para ver el detalle con tecnologías asociadas.

### 4.3 Formulario de contacto

Ubicado en la página principal. Campos requeridos:

| Campo | Obligatorio | Descripción |
|-------|-------------|-------------|
| Nombre | Sí | Tu nombre completo |
| Email | Sí | Correo de contacto |
| Teléfono | No | Número de teléfono |
| Empresa | No | Nombre de la empresa |
| Servicio de interés | No | Tipo de servicio |
| Mensaje | Sí | Consulta o comentario |

Al enviar, la consulta se guarda en el sistema y se envía una notificación por email a `contacto@infrasoft.com.ar`.

### 4.4 Relevamiento de servicios

En la página de detalle de un servicio, podés completar un formulario de relevamiento que envía la información por email al equipo de Infrasoft.

---

## 5. Panel de control

**Ruta:** `/dashboard`  
**Requiere:** Iniciar sesión

Al ingresar verás un mensaje de bienvenida con tu nombre y accesos directos a:

| Acceso | Disponible para |
|--------|-----------------|
| Ventas | Todos los usuarios |
| Pagos | Todos los usuarios |
| Productos | Solo administrador |
| Usuarios | Solo administrador |

### Barra de navegación

La barra superior muestra los módulos según tu rol:

- **Dashboard** — Panel principal
- **Productos** — Solo admin
- **Usuarios** — Solo admin
- **Ventas** — Todos
- **Pagos** — Todos
- **Menú de usuario** — Perfil y cerrar sesión

---

## 6. Gestión de productos (solo administrador)

**Ruta:** `/products`

### 6.1 Ver productos

Al entrar verás una tabla con todos los productos registrados:

- Nombre
- Descripción
- Precio
- Estado (activo / inactivo)

### 6.2 Crear un producto

1. Hacé clic en **Nuevo producto**.
2. Completá el formulario:

| Campo | Descripción |
|-------|-------------|
| Nombre | Nombre del producto o servicio |
| Descripción | Detalle del producto |
| Precio | Precio en pesos (decimal, ej: 1500.00) |
| Stock | Cantidad disponible |
| Estado | `Activo` o `Inactivo` |
| Imagen | Foto del producto (opcional, JPG/PNG, máx. 2 MB) |

3. Presioná **Guardar**.

> Las imágenes se almacenan en `storage/app/public/products`. En el servidor debe existir el enlace simbólico (`php artisan storage:link`).

### 6.3 Editar un producto

1. En la tabla, hacé clic en el ícono de **lápiz** (editar) en la fila del producto.
2. Modificá los campos necesarios.
3. Presioná **Guardar**.

### 6.4 Eliminar un producto

1. Hacé clic en el ícono de **X** (eliminar).
2. Confirmá la eliminación en el diálogo.

> Los productos de demostración incluyen: Hosting Web Básico, Desarrollo Web y Soporte Técnico Mensual.

---

## 7. Gestión de usuarios (solo administrador)

**Ruta:** `/users`

### 7.1 Ver usuarios

La tabla muestra: nombre, apellido, teléfono y email de cada usuario registrado.

### 7.2 Crear un usuario

1. Hacé clic en **Nuevo usuario**.
2. Completá:

| Campo | Obligatorio | Descripción |
|-------|-------------|-------------|
| CUIL | No | Identificación fiscal |
| Rol | Sí | `Usuario` o `Administrador` |
| Nombre | Sí | Nombre del usuario |
| Apellido | No | Apellido |
| Email | Sí | Correo único |
| Teléfono | No | Número de contacto |
| Dirección | No | Domicilio |
| Contraseña | Sí (al crear) | Mínimo 8 caracteres |

3. Presioná **Guardar**.

### 7.3 Editar un usuario

1. Hacé clic en el ícono de editar.
2. Modificá los datos. Dejá la contraseña vacía si no querés cambiarla.
3. Presioná **Guardar**.

### 7.4 Eliminar un usuario

1. Hacé clic en el ícono de eliminar.
2. Confirmá la acción.

> **Nota:** No podés eliminar tu propia cuenta de administrador.

---

## 7.5 Consultas del sitio (solo administrador)

**Ruta:** `/inquiries`

Cuando un visitante envía el formulario de contacto en la landing, la consulta queda registrada en el sistema. Desde este panel podés gestionarlas.

### Ver consultas

La tabla muestra:

| Columna | Descripción |
|---------|-------------|
| Fecha | Momento en que se envió el mensaje |
| Nombre | Nombre del visitante |
| Email | Correo de contacto |
| Mensaje | Texto (resumido en la tabla) |
| Estado | `Pendiente`, `Leída` o `Respondida` |

### Ver detalle y cambiar estado

1. Hacé clic en el ícono de **ojo** en la fila de la consulta.
2. Leé el mensaje completo y el email del visitante.
3. Seleccioná el nuevo estado en el desplegable.
4. Presioná **Actualizar estado**.

### Eliminar una consulta

1. Hacé clic en el ícono de **X**.
2. Confirmá la eliminación.

> Los estados ayudan a llevar seguimiento: `Pendiente` (sin revisar), `Leída` (vista por el equipo), `Respondida` (ya contestada al cliente).

---

## 8. Ventas

**Ruta:** `/sales`  
**Disponible para:** Todos los usuarios autenticados

### 8.1 Ver ventas

La tabla muestra:

| Columna | Descripción |
|---------|-------------|
| # | Número de venta |
| Usuario | Cliente que realizó la venta |
| Estado | pending, processing, shipped, completed |
| Total | Monto total |
| Fecha | Fecha de creación |

- **Administradores** ven todas las ventas.
- **Usuarios** solo ven sus propias ventas.

### 8.2 Ver detalle de una venta

1. Hacé clic en **Ver** en la fila de la venta.
2. Verás:
   - Datos del cliente
   - Lista de productos con cantidades y precios
   - Historial de pagos asociados
   - Botón **Pagar** (si el estado es `pending`)

### 8.3 Crear una venta

Las ventas se crean asociando productos al carrito. El sistema calcula automáticamente el total según precio × cantidad.

### 8.4 Estados de venta

| Estado | Significado |
|--------|-------------|
| `pending` | Venta creada, pendiente de pago |
| `processing` | Pago recibido, en preparación |
| `shipped` | Enviada / en curso |
| `completed` | Finalizada |

> Solo el administrador puede cambiar el estado de una venta.

---

## 9. Pagos

**Ruta:** `/payments`  
**Requiere:** Iniciar sesión

### 9.1 Ver historial de pagos

La tabla muestra todos los pagos con:

- Número de pago
- Venta asociada (si aplica)
- Proveedor (Mercado Pago / Stripe)
- Monto y moneda
- Estado del pago
- Fecha

### 9.2 Crear un nuevo pago

1. En la sección **Nuevo pago**, completá:

| Campo | Descripción |
|-------|-------------|
| Monto | Valor a pagar (mínimo 0.50) |
| Moneda | `ARS` (Mercado Pago) o `USD` (Stripe) |
| Venta | ID de venta (opcional) |

2. Presioná **Iniciar pago**.

3. El sistema redirige a la pasarela correspondiente:
   - **ARS** → Mercado Pago
   - **Otras monedas** → Stripe

### 9.3 Pagar desde una venta

Si tenés una venta en estado `pending`:

1. Entrá a `/sales` o al detalle de la venta.
2. Hacé clic en **Pagar**.
3. Serás redirigido a la pasarela de pago.

### 9.4 Resultado del pago

| Resultado | Página | Qué ocurre |
|-----------|--------|------------|
| Éxito | `/payments/success` | Muestra confirmación. El pago se marca como aprobado. |
| Cancelado | `/payments/cancel` | Muestra aviso. El pago queda como rechazado. |

### 9.5 Estados de pago

| Estado | Significado |
|--------|-------------|
| `pending` | Pago iniciado, esperando confirmación |
| `approved` | Pago confirmado |
| `rejected` | Pago rechazado o cancelado |
| `refunded` | Pago reembolsado |

### 9.6 Configuración de pasarelas

Para que los pagos funcionen en producción, el administrador del sistema debe configurar en el archivo `.env`:

```env
# Mercado Pago (pesos argentinos)
MERCADOPAGO_ACCESS_TOKEN=tu_token
MERCADOPAGO_PUBLIC_KEY=tu_clave_publica

# Stripe (dólares y otras monedas)
STRIPE_SECRET_KEY=sk_...
STRIPE_PUBLIC_KEY=pk_...
STRIPE_WEBHOOK_SECRET=whsec_...
```

Sin estas claves, el sistema crea el registro de pago pero no puede redirigir a la pasarela.

---

## 10. Perfil de usuario

**Ruta:** `/profile`

### 10.1 Actualizar datos personales

1. Hacé clic en tu nombre → **Profile**.
2. Modificá nombre y/o email.
3. Presioná **Save**.

### 10.2 Cambiar contraseña

1. En la sección **Update Password**, ingresá:
   - Contraseña actual
   - Nueva contraseña
   - Confirmación de nueva contraseña
2. Presioná **Save**.

### 10.3 Eliminar cuenta

1. En la sección **Delete Account**, ingresá tu contraseña.
2. Confirmá la eliminación.

> Esta acción es irreversible.

---

## 11. Estados y flujos

### Flujo completo de compra

```
1. Usuario se registra o inicia sesión
        ↓
2. Se crea una venta con productos
        ↓
3. Venta queda en estado "pending"
        ↓
4. Usuario hace clic en "Pagar"
        ↓
5. Redirección a Mercado Pago (ARS) o Stripe (USD)
        ↓
6a. Pago exitoso → estado "approved" → /payments/success
6b. Pago cancelado → estado "rejected" → /payments/cancel
        ↓
7. Admin actualiza venta a "processing" → "shipped" → "completed"
```

### Flujo de contacto (público)

```
1. Visitante completa formulario en la landing
        ↓
2. Consulta se guarda en tabla "inquiries"
        ↓
3. Email de notificación a contacto@infrasoft.com.ar
        ↓
4. El administrador revisa y gestiona la consulta en /inquiries
        ↓
5. Mensaje de confirmación al visitante
```

---

## 12. Preguntas frecuentes

### No puedo acceder a Productos o Usuarios

Solo los usuarios con rol **administrador** pueden ver esas secciones. Si necesitás acceso, contactá al administrador del sistema.

### El pago no redirige a Mercado Pago / Stripe

Verificá que las claves de API estén configuradas en el archivo `.env`. Sin ellas, el pago se registra pero no se abre la pasarela.

### Olvidé mi contraseña

Usá la opción **Forgot your password?** en la pantalla de login.

### ¿Puedo ver ventas de otros usuarios?

Solo si sos **administrador**. Los usuarios regulares solo ven sus propias ventas.

### El formulario de contacto no envía email

Por defecto el sistema usa el driver `log` para emails en desarrollo. En producción, configurá SMTP en `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=tu_servidor_smtp
MAIL_PORT=587
MAIL_USERNAME=tu_usuario
MAIL_PASSWORD=tu_contraseña
MAIL_FROM_ADDRESS=noreply@infrasoft.com.ar
```

### ¿Cómo accedo al sistema desde otra computadora?

Usá la URL del servidor donde está instalado (ej: `http://tu-servidor:8000`). En desarrollo local, solo es accesible desde la misma máquina.

---

## Resumen de rutas

| Ruta | Quién puede acceder | Función |
|------|---------------------|---------|
| `/` | Todos | Landing pública |
| `/servicios` | Todos | Catálogo de servicios |
| `/blog` | Todos | Artículos y novedades |
| `/login` | Todos | Iniciar sesión |
| `/register` | Todos | Registrarse |
| `/dashboard` | Autenticados | Panel de control |
| `/products` | Admin | Gestión de productos |
| `/users` | Admin | Gestión de usuarios |
| `/inquiries` | Admin | Consultas del sitio web |
| `/sales` | Autenticados | Ventas |
| `/payments` | Autenticados | Pagos |
| `/profile` | Autenticados | Perfil personal |

---

## Soporte

Para consultas técnicas o comerciales:

- **Email:** contacto@infrasoft.com.ar
- **Web:** https://infrasoft.com.ar

---

## Documentación adicional

| Documento | Para quién |
|-----------|------------|
| [Índice de documentación](docs/README.md) | Desarrolladores y administradores de sistemas |
| [Instalación](docs/INSTALACION.md) | Quien instala el sistema |
| [Configuración](docs/CONFIGURACION.md) | Variables de entorno y servicios |
| [Pagos](docs/PAGOS.md) | Integración Stripe y Mercado Pago |
| [Despliegue](docs/DESPLIEGUE.md) | Publicación en producción |

---

*Manual generado para el Sistema Infrasoft — Laravel Breeze Seld System*
