# Instalación

Guía paso a paso para instalar y ejecutar el sistema en entorno local.

---

## Requisitos

| Componente | Versión mínima |
|------------|----------------|
| PHP | 8.2+ (recomendado 8.3) |
| Composer | 2.x |
| Node.js | 18+ |
| npm | 9+ |
| SQLite | incluido en PHP (por defecto) |
| MySQL | opcional (producción) |

### Extensiones PHP requeridas

- `curl`, `fileinfo`, `mbstring`, `openssl`, `pdo_sqlite`, `sqlite3`
- Para MySQL: `pdo_mysql`

---

## Instalación en Windows

El repositorio incluye herramientas portables en `tools/` para no depender de instalaciones globales.

### 1. Descargar PHP y Composer

```powershell
.\tools\setup.ps1
```

Esto descarga PHP 8.3 y Composer en `tools/php/` y `tools/composer.phar`.

### 2. Instalar dependencias

```powershell
cd src
.\composer.bat install
npm install
```

### 3. Configurar entorno

```powershell
copy .env.example .env
.\php.bat artisan key:generate
```

### 4. Base de datos SQLite (desarrollo)

```powershell
New-Item -ItemType File -Path database\database.sqlite -Force
.\php.bat artisan migrate --seed
```

### 5. Compilar assets

```powershell
npm run build
```

### 6. Iniciar servidor

```powershell
.\composer.bat run dev
```

O por separado:

```powershell
# Terminal 1
.\php.bat artisan serve --host=127.0.0.1 --port=8000

# Terminal 2
npm run dev
```

Abrir `http://localhost:8000`.

---

## Instalación en Linux / macOS

### 1. Requisitos del sistema

```bash
# Ubuntu/Debian
sudo apt install php8.3 php8.3-cli php8.3-sqlite3 php8.3-mbstring php8.3-curl php8.3-xml composer nodejs npm

# macOS (Homebrew)
brew install php composer node
```

### 2. Dependencias del proyecto

```bash
cd src
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm run build
```

### 3. Servidor de desarrollo

```bash
composer run dev
```

---

## Instalación con MySQL

Editar `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=infrasoft
DB_USERNAME=root
DB_PASSWORD=tu_password
```

Crear la base de datos y migrar:

```bash
php artisan migrate --seed
```

---

## Wrappers de Windows

| Archivo | Función |
|---------|---------|
| `src/php.bat` | Ejecuta PHP portable |
| `src/composer.bat` | Ejecuta Composer portable |
| `src/test.bat` | Ejecuta PHPUnit + Cypress |
| `composer.bat` (raíz) | Composer desde la raíz |
| `php.bat` (raíz) | PHP desde la raíz |

---

## Verificar instalación

```powershell
cd src
.\php.bat artisan about
.\composer.bat run test
```

Deben pasar los 41 tests de PHPUnit.

---

## Problemas comunes

### `composer` no reconocido

Usar `.\composer.bat` desde `src/` o ejecutar `.\tools\setup.ps1` primero.

### Error de permisos en `storage/` o `bootstrap/cache/`

```bash
chmod -R 775 storage bootstrap/cache
```

### Vite no compila

```bash
npm install
npm run build
```

Verificar que `resources/css/app.css` importe correctamente los archivos CSS.

### Puerto 8000 ocupado

```bash
php artisan serve --port=8001
```

Actualizar `APP_URL` en `.env` y `baseUrl` en `cypress.config.js`.

---

## Siguiente paso

- [Configuración](CONFIGURACION.md) — variables de entorno
- [Desarrollo](DESARROLLO.md) — flujo de trabajo diario
- [Manual de Usuario](../MANUAL_USUARIO.md) — uso del sistema
