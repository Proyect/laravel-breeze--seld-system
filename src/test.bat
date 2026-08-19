@echo off
setlocal
cd /d "%~dp0"
echo [PHPUnit] Ejecutando tests backend...
call composer.bat run test
if errorlevel 1 exit /b 1
echo.
echo [Cypress] Ejecutando tests E2E...
echo Asegurate de tener el servidor corriendo: php.bat artisan serve
call npm run cypress:run
exit /b %errorlevel%
