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

# Create required Laravel directories if they don't exist
echo "Creating required Laravel directories..."
cd /var/www/html

# Create directories with proper permissions immediately
mkdir -p bootstrap/cache
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs

# Set proper ownership first
chown -R www-data:www-data /var/www/html

# Set proper permissions for entire directory structure
chmod -R 755 storage
chmod -R 775 bootstrap/cache
chmod -R 775 storage/framework
chmod -R 775 storage/logs

# Ensure specific subdirectories have correct permissions
chmod -R 775 storage/framework/cache
chmod -R 775 storage/framework/sessions
chmod -R 775 storage/framework/views

# Verify directories exist and are writable
echo "Verifying directory permissions..."
ls -la storage/framework/ || echo "Warning: storage/framework not found"
ls -la storage/framework/sessions/ || echo "Warning: storage/framework/sessions not found"

# Verify bootstrap/cache is writable
if [ ! -w bootstrap/cache ]; then
    echo "ERROR: bootstrap/cache is not writable!"
    ls -la bootstrap/
    exit 1
fi

# Install/update composer dependencies
echo "Installing/updating composer dependencies..."
# Install without scripts first to avoid package:discover errors
composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts
# Now run package discovery manually after directories are confirmed ready
php artisan package:discover --ansi || echo "Warning: package:discover failed, continuing..."
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

