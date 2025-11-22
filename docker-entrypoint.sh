#!/bin/bash
set -e

echo "Waiting for database to be ready..."

# Wait for PostgreSQL to be ready (max 60 seconds)
max_attempts=30
attempt=0

until php -r "
try {
    \$pdo = new PDO('pgsql:host=${DB_HOST};port=${DB_PORT};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}');
    \$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    \$pdo->exec('SELECT 1');
    exit(0);
} catch (PDOException \$e) {
    exit(1);
}
" 2>/dev/null; do
    attempt=$((attempt + 1))
    if [ $attempt -ge $max_attempts ]; then
        echo "Database connection failed after $max_attempts attempts"
        exit 1
    fi
    echo "Database is unavailable - sleeping (attempt $attempt/$max_attempts)"
    sleep 2
done

echo "Database is ready!"

# Install/update composer dependencies
echo "Installing/updating composer dependencies..."
cd /var/www/html
composer install --no-interaction --prefer-dist --optimize-autoloader
echo "Composer dependencies installed!"

# Generate app key if not set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "Generating application key..."
    cd /var/www/html
    php artisan key:generate --force || true
fi

# Run migrations
echo "Running database migrations..."
cd /var/www/html
php artisan migrate --force

echo "Migrations completed successfully!"

# Start PHP-FPM
echo "Starting PHP-FPM..."
exec php-fpm

