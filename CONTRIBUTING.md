# Guía de contribución

Gracias por interesarte en contribuir al proyecto Infrasoft.

---

## Cómo contribuir

1. Hacer fork del repositorio
2. Crear una rama para tu feature: `git checkout -b feature/mi-mejora`
3. Realizar los cambios
4. Ejecutar tests: `cd src && composer run test`
5. Commit con mensaje descriptivo
6. Push y crear Pull Request

---

## Estándares de código

### PHP

- Seguir PSR-12
- Usar Form Requests para validación
- Controladores delgados; lógica en Services
- Ejecutar Laravel Pint antes de commit:

```bash
cd src
./vendor/bin/pint
```

### JavaScript

- ES6+ modules
- Sin dependencias innecesarias

### Blade

- Reutilizar componentes existentes (`<x-infrasoft-logo>`, etc.)
- Mantener consistencia con layouts existentes

---

## Tests

- Toda funcionalidad nueva debe incluir tests Feature
- Cambios en UI crítica: agregar test Cypress si aplica
- Los 41 tests PHPUnit deben pasar antes del PR

```bash
cd src
composer run test
```

---

## Commits

Mensajes claros en español o inglés:

```
Agregar exportación de ventas a CSV.

Corregir validación de stock en productos.

Actualizar documentación de pagos.
```

Prefijos sugeridos: `Agregar`, `Corregir`, `Actualizar`, `Eliminar`, `Refactorizar`.

---

## Estructura del PR

```markdown
## Resumen
- Qué cambia y por qué

## Tipo de cambio
- [ ] Bug fix
- [ ] Nueva funcionalidad
- [ ] Breaking change
- [ ] Documentación

## Test plan
- [ ] PHPUnit pasa
- [ ] Cypress pasa (si aplica)
- [ ] Probado manualmente en local
```

---

## Qué no commitear

- `.env` y credenciales
- `database/database.sqlite`
- `tools/php/`, `tools/composer.phar`
- `node_modules/`, `vendor/`
- Screenshots de Cypress (`cypress/screenshots/`)

---

## Reportar bugs

Incluir:

1. Descripción del problema
2. Pasos para reproducir
3. Comportamiento esperado vs actual
4. Entorno (OS, PHP version, navegador)
5. Logs relevantes de `storage/logs/laravel.log`

---

## Documentación

Si agregás funcionalidad, actualizá la documentación correspondiente en `docs/`.

---

## Licencia

Al contribuir, aceptás que tu código se publique bajo la licencia MIT del proyecto.
