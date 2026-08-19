# Descarga PHP 8.3 y Composer portables para Windows
$ErrorActionPreference = "Stop"
$toolsDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$phpDir = Join-Path $toolsDir "php"

if (Test-Path (Join-Path $phpDir "php.exe")) {
    Write-Host "PHP ya está instalado en tools/php"
} else {
    Write-Host "Descargando PHP 8.3..."
    $releases = Invoke-RestMethod -Uri "https://windows.php.net/downloads/releases/releases.json"
    $zipName = $releases."8.3"."nts-vs16-x64".zip.path
    $zipUrl = "https://windows.php.net/downloads/releases/$zipName"
    $zipPath = Join-Path $toolsDir "php.zip"
    Invoke-WebRequest -Uri $zipUrl -OutFile $zipPath -UseBasicParsing
    Expand-Archive -Path $zipPath -DestinationPath $phpDir -Force
    Remove-Item $zipPath
    Copy-Item (Join-Path $phpDir "php.ini-development") (Join-Path $phpDir "php.ini") -Force
    $ini = Get-Content (Join-Path $phpDir "php.ini")
    $ini = $ini -replace ';extension_dir = "ext"','extension_dir = "ext"'
    $ini = $ini -replace ';extension=curl','extension=curl'
    $ini = $ini -replace ';extension=fileinfo','extension=fileinfo'
    $ini = $ini -replace ';extension=mbstring','extension=mbstring'
    $ini = $ini -replace ';extension=openssl','extension=openssl'
    $ini = $ini -replace ';extension=pdo_sqlite','extension=pdo_sqlite'
    $ini = $ini -replace ';extension=sqlite3','extension=sqlite3'
    $ini | Set-Content (Join-Path $phpDir "php.ini")
    Write-Host "PHP instalado."
}

if (-not (Test-Path (Join-Path $toolsDir "composer.phar"))) {
    Write-Host "Descargando Composer..."
    Invoke-WebRequest -Uri "https://getcomposer.org/download/latest-stable/composer.phar" `
        -OutFile (Join-Path $toolsDir "composer.phar") -UseBasicParsing
    Write-Host "Composer instalado."
}

Write-Host "Listo. Usa .\composer.bat y .\php.bat desde la carpeta src/"
