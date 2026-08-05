# Despliegue en producción

Checklist y guía para publicar el sistema en un servidor.

---

## Requisitos del servidor

| Componente | Recomendación |
|------------|---------------|
| SO | Ubuntu 22.04+ / Debian 12 |
| PHP | 8.2+ con FPM |
| Web server | Nginx o Apache |
| Base de datos | MySQL 8+ o PostgreSQL |
| Node.js | 18+ (solo para build) |
| SSL | Certificado Let's Encrypt |
| RAM | Mínimo 1 GB |

### Extensiones PHP

```
php-fpm php-cli php-mysql php-mbstring php-xml php-curl
php-zip php-bcmath php-intl php-gd php-redis (opcional)
```

---

## Checklist pre-despliegue

- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_KEY` generado
- [ ] `APP_URL` con dominio real y HTTPS
- [ ] Base de datos MySQL configurada
- [ ] Migraciones ejecutadas
- [ ] `npm run build` ejecutado
- [ ] Permisos en `storage/` y `bootstrap/cache/`
- [ ] SMTP configurado para emails
- [ ] Claves Stripe/Mercado Pago de producción
- [ ] Webhooks configurados con URL pública
- [ ] Contraseñas de demo cambiadas
- [ ] Backups automatizados

---

## Pasos de despliegue

### 1. Clonar repositorio

```bash
cd /var/www
git clone https://github.com/Proyect/laravel-breeze--seld-system.git infrasoft
cd infrasoft/src
```

### 2. Instalar dependencias

```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

### 3. Configurar entorno

```bash
cp .env.example .env
php artisan key:generate
nano .env  # Editar variables de producción
```

### 4. Base de datos

```bash
php artisan migrate --force
php artisan db:seed --force  # Solo primera vez
```

### 5. Optimizar Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### 6. Permisos

```bash
chown -R www-data:www-data /var/www/infrasoft/src
chmod -R 775 storage bootstrap/cache
```

---

## Configuración Nginx

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name infrasoft.com.ar www.infrasoft.com.ar;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name infrasoft.com.ar www.infrasoft.com.ar;

    root /var/www/infrasoft/src/public;
    index index.php;

    ssl_certificate /etc/letsencrypt/live/infrasoft.com.ar/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/infrasoft.com.ar/privkey.pem;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## Cola de trabajos

Si se usan emails o jobs en cola:

### Supervisor

```ini
[program:infrasoft-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/infrasoft/src/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=1
```

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start infrasoft-worker:*
```

---

## Tareas programadas

Agregar al crontab del usuario `www-data`:

```cron
* * * * * cd /var/www/infrasoft/src && php artisan schedule:run >> /dev/null 2>&1
```

---

## SSL con Let's Encrypt

```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d infrasoft.com.ar -d www.infrasoft.com.ar
```

---

## Actualizar en producción

```bash
cd /var/www/infrasoft
git pull origin master
cd src
composer install --optimize-autoloader --no-dev
npm install && npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
sudo supervisorctl restart infrasoft-worker:*
```

---

## Monitoreo

- **Health check:** `GET /up` — debe responder 200
- **Logs:** `storage/logs/laravel.log`
- **Nginx logs:** `/var/log/nginx/error.log`

---

## Seguridad en producción

- Deshabilitar listado de directorios
- No exponer `.env` ni `storage/`
- Usar HTTPS obligatorio
- Rate limiting en login (Laravel throttle)
- Mantener dependencias actualizadas (`composer audit`, `npm audit`)
- Cambiar contraseñas de usuarios de prueba

---

## Documentos relacionados

- [Configuración](CONFIGURACION.md)
- [Pagos](PAGOS.md) — webhooks en producción
- [Instalación](INSTALACION.md)
