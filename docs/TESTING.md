# Testing

Guía de pruebas automatizadas: PHPUnit y Cypress.

---

## Resumen

| Suite | Framework | Tests | Ubicación |
|-------|-----------|-------|-----------|
| Backend | PHPUnit 11 | 50 | `src/tests/` |
| E2E | Cypress 15 | 22 | `src/cypress/e2e/` |

---

## PHPUnit (backend)

### Ejecutar todos los tests

```powershell
cd src
.\composer.bat run test
# o
npm run test:php
```

### Ejecutar un archivo o filtro

```bash
php artisan test --filter=AuthenticationTest
php artisan test tests/Feature/ProductTest.php
php artisan test --parallel
```

### Suites disponibles

| Archivo | Qué prueba |
|---------|------------|
| `AuthenticationTest.php` | Login, logout, registro, acceso protegido |
| `ProductTest.php` | CRUD productos (solo admin) |
| `UserManagementTest.php` | CRUD usuarios (solo admin) |
| `SalesTest.php` | Crear, listar, ver ventas |
| `PaymentTest.php` | Crear pagos, success/cancel |
| `ContactTest.php` | Formulario de contacto |
| `InquiryManagementTest.php` | Panel admin de consultas |
| `PublicPagesTest.php` | Landing, servicios, blog, búsqueda |

### Trait de ayuda

`tests/CreatesUsers.php` proporciona métodos para crear usuarios admin y regulares en los tests.

```php
$user = $this->createAdminUser();
$user = $this->createRegularUser();
```

### Configuración

- Base de datos: SQLite en memoria (`phpunit.xml`)
- No requiere servidor corriendo
- Seeders se ejecutan por test según necesidad

---

## Cypress (E2E)

### Requisitos

El servidor Laravel debe estar corriendo en `http://127.0.0.1:8000`.

```powershell
# Terminal 1
cd src
.\php.bat artisan serve --host=127.0.0.1 --port=8000

# Terminal 2
npm run cypress:run
```

### Modo interactivo

```bash
npm run cypress:open
```

### Archivos de test

| Archivo | Qué prueba |
|---------|------------|
| `public.cy.js` | Landing, navegación pública, servicios |
| `auth.cy.js` | Login, logout, registro |
| `admin.cy.js` | Panel admin, productos, usuarios |
| `sales-payments.cy.js` | Ventas y flujo de pagos |
| `contact.cy.js` | Formulario de contacto |

### Comandos personalizados

Definidos en `cypress/support/commands.js`:

```javascript
cy.login('admin@infrasoft.com.ar', 'password')
cy.loginAsAdmin()
```

### Configuración

`cypress.config.js`:

```javascript
baseUrl: 'http://127.0.0.1:8000'
```

### CI (GitHub Actions)

En cada push o pull request a `master`/`main`, el workflow `.github/workflows/laravel.yml` ejecuta:

1. **laravel-tests** — `composer install`, `npm run build`, migraciones y `php artisan test`
2. **cypress-e2e** — servidor Laravel en segundo plano y `npm run test:e2e`

---

## Ejecutar todo (Windows)

```powershell
cd src
.\test.bat
```

Ejecuta PHPUnit y luego Cypress (requiere servidor activo).

---

## Escribir nuevos tests

### Feature test (PHPUnit)

```bash
php artisan make:test MiNuevoTest
```

```php
public function test_admin_can_access_products(): void
{
    $admin = $this->createAdminUser();

    $response = $this->actingAs($admin)->get('/products');

    $response->assertStatus(200);
}
```

### Test E2E (Cypress)

Crear `cypress/e2e/mi-test.cy.js`:

```javascript
describe('Mi funcionalidad', () => {
  it('debería funcionar', () => {
    cy.visit('/')
    cy.contains('Infrasoft')
  })
})
```

---

## CI/CD (recomendado)

Ejemplo de pipeline GitHub Actions:

```yaml
jobs:
  phpunit:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.3'
          extensions: sqlite3
      - run: cd src && composer install && php artisan test

  cypress:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - run: cd src && composer install && npm install
      - run: cd src && php artisan serve &
      - run: cd src && npm run cypress:run
```

---

## Cobertura actual

| Área | PHPUnit | Cypress |
|------|---------|---------|
| Autenticación | ✓ | ✓ |
| Productos (admin) | ✓ | ✓ |
| Usuarios (admin) | ✓ | ✓ |
| Ventas | ✓ | ✓ |
| Pagos | ✓ | ✓ |
| Contacto | ✓ | ✓ |
| Páginas públicas | ✓ | ✓ |
| Webhooks | ✓ | — |
| Perfil | parcial | — |

---

## Documentos relacionados

- [Desarrollo](DESARROLLO.md)
- [Instalación](INSTALACION.md)
