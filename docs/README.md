# Documentación — Sistema Infrasoft

Índice central de toda la documentación del proyecto **Laravel Breeze Seld System**.

---

## Para usuarios finales

| Documento | Descripción |
|-----------|-------------|
| [Manual de Usuario](../MANUAL_USUARIO.md) | Guía completa para clientes y administradores del sistema |

---

## Para desarrolladores

| Documento | Descripción |
|-----------|-------------|
| [Instalación](INSTALACION.md) | Requisitos, setup en Windows/Linux y primer arranque |
| [Arquitectura](ARQUITECTURA.md) | Estructura del proyecto, módulos y flujos |
| [Desarrollo](DESARROLLO.md) | Convenciones, comandos y flujo de trabajo diario |
| [Configuración](CONFIGURACION.md) | Variables de entorno y servicios externos |
| [Base de datos](BASE_DE_DATOS.md) | Esquema, migraciones y seeders |
| [Rutas](RUTAS.md) | Referencia completa de endpoints HTTP |
| [Pagos](PAGOS.md) | Integración Stripe y Mercado Pago |
| [Testing](TESTING.md) | PHPUnit, Cypress y CI |
| [Despliegue](DESPLIEGUE.md) | Producción, servidor web y checklist |
| [Marca](MARCA.md) | Logo, colores y guía de identidad visual |

---

## Otros

| Documento | Descripción |
|-----------|-------------|
| [README principal](../README.md) | Inicio rápido del repositorio |
| [Contribución](../CONTRIBUTING.md) | Cómo colaborar en el proyecto |
| [Changelog](../src/CHANGELOG.md) | Historial de cambios |

---

## Inicio rápido

```powershell
# Windows — primera vez
.\tools\setup.ps1
cd src
.\composer.bat install
npm install
copy .env.example .env
.\php.bat artisan key:generate
New-Item -ItemType File -Path database\database.sqlite -Force
.\php.bat artisan migrate --seed
npm run build
.\composer.bat run dev
```

La aplicación queda disponible en `http://localhost:8000`.

**Credenciales de prueba:**

| Email | Contraseña | Rol |
|-------|-----------|-----|
| admin@infrasoft.com.ar | password | admin |
| user@example.com | password | user |
