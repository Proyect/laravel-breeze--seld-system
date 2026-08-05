@echo off
setlocal
set "ROOT=%~dp0.."
"%ROOT%\tools\php\php.exe" "%ROOT%\tools\composer.phar" %*
