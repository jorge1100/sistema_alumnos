#!/bin/bash
set -e

# Create storage directory structure if not exists
mkdir -p /var/www/html/storage/app/public/profiles
mkdir -p /var/www/html/storage/framework/{views,cache,sessions,testing}
mkdir -p /var/www/html/bootstrap/cache

# Set permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create storage symlink if not exists
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link
fi

# Clear and cache config for production
if [ "$APP_ENV" = "production" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Run migrations
php artisan migrate --force

exec "$@"