@echo off
REM Fix Filament Admin Timeout Issue

echo ==============================================
echo Fixing Filament Admin Timeout Issue
echo ==============================================
echo.

echo [1/5] Clearing Laravel caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

echo.
echo [2/5] Clearing Filament cache...
php artisan filament:cache-components
php artisan filament:clear-cache

echo.
echo [3/5] Running migrations...
php artisan migrate --force

echo.
echo [4/5] Clearing composer autoload...
composer dump-autoload

echo.
echo [5/5] Restarting PHP server...
taskkill /F /IM php.exe >nul 2>&1
timeout /t 2
php artisan serve --host=127.0.0.1 --port=8000

echo.
echo =========================================
echo ✅ Fix complete!
echo Try accessing /admin in your browser now
echo =========================================
pause
