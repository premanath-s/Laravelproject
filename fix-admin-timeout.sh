#!/bin/bash

echo "=== Fixing Filament Admin Timeout Issue ==="
echo ""

echo "1. Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

echo ""
echo "2. Clearing Filament cache..."
php artisan filament:cache-components
php artisan filament:clear-cache

echo ""
echo "3. Running migrations..."
php artisan migrate --force

echo ""
echo "4. Clearing composer autoload..."
composer dump-autoload

echo ""
echo "✅ All caches cleared and optimized!"
echo ""
echo "Now try accessing /admin in your browser."
