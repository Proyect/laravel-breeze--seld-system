# Infrasoft — Aplicación Laravel

Aplicación principal del sistema Infrasoft. El código Laravel vive en este directorio (`src/`).

## Inicio rápido

```powershell
.\composer.bat install
npm install
copy .env.example .env
.\php.bat artisan key:generate
New-Item -ItemType File -Path database\database.sqlite -Force
.\php.bat artisan migrate --seed
npm run build
.\composer.bat run dev
```

## Documentación

La documentación completa está en la raíz del repositorio:

| Documento | Ubicación |
|-----------|-----------|
| README principal | [../README.md](../README.md) |
| Índice de docs | [../docs/README.md](../docs/README.md) |
| Manual de usuario | [../MANUAL_USUARIO.md](../MANUAL_USUARIO.md) |
| Instalación | [../docs/INSTALACION.md](../docs/INSTALACION.md) |
| Desarrollo | [../docs/DESARROLLO.md](../docs/DESARROLLO.md) |
| Testing | [../docs/TESTING.md](../docs/TESTING.md) |

## Scripts npm

| Comando | Descripción |
|---------|-------------|
| `npm run dev` | Vite dev server |
| `npm run build` | Build de producción |
| `npm run test:php` | Ejecutar PHPUnit |
| `npm run cypress:run` | Tests E2E headless |
| `npm run cypress:open` | Cypress interactivo |
| `npm run serve` | Servidor Laravel (Windows) |

## Wrappers Windows

| Archivo | Función |
|---------|---------|
| `php.bat` | PHP portable desde `tools/` |
| `composer.bat` | Composer portable |
| `test.bat` | PHPUnit + Cypress |

## Credenciales de prueba

| Email | Contraseña | Rol |
|-------|-----------|-----|
| admin@infrasoft.com.ar | password | admin |
| user@example.com | password | user |
