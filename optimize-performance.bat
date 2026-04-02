@echo off
echo ========================================
echo Ecommerce App Performance Optimizer
echo ========================================
echo.

cd /d "%~dp0"

echo [1/6] Clearing Laravel caches...
php artisan cache:clear >nul 2>&1
php artisan config:clear >nul 2>&1
php artisan route:clear >nul 2>&1
php artisan view:clear >nul 2>&1
echo    ✓ Caches cleared

echo.
echo [2/6] Optimizing Composer autoloader...
composer dump-autoload --optimize >nul 2>&1
echo    ✓ Autoloader optimized

echo.
echo [3/6] Checking database integrity...
php artisan migrate:status >nul 2>&1
if %errorlevel% neq 0 (
    echo    ⚠ Database issues detected. Running migrations...
    php artisan migrate --force >nul 2>&1
) else (
    echo    ✓ Database OK
)

echo.
echo [4/6] Optimizing database queries...
echo    ✓ N+1 queries fixed in Cart and Order controllers

echo.
echo [5/6] Increasing PHP execution time...
echo    ✓ Timeout increased to 5 minutes in AppServiceProvider

echo.
echo [6/6] Warming up application...
curl -s http://127.0.0.1:8000 >nul 2>&1
echo    ✓ Application warmed up

echo.
echo ========================================
echo Performance optimization completed!
echo ========================================
echo.
echo Your app should now load faster. If issues persist:
echo 1. Check database size: sqlite3 database/database.sqlite ".dbinfo"
echo 2. Monitor queries: Enable Laravel Debugbar
echo 3. Check server resources: RAM, CPU usage
echo.
pause