FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd xml zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock* ./

# Create bootstrap/cache directory before composer install
RUN mkdir -p bootstrap/cache && chmod -R 775 bootstrap/cache

# Install dependencies (skip scripts since artisan isn't available yet)
RUN if [ -f composer.lock ]; then composer install --optimize-autoloader --no-scripts; else composer install --optimize-autoloader --no-interaction --no-scripts; fi

# Copy application files (or mount in docker-compose)
COPY . .

# Copy and set up entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Create required Laravel directories
RUN mkdir -p /var/www/html/bootstrap/cache
RUN mkdir -p /var/www/html/storage/framework/cache
RUN mkdir -p /var/www/html/storage/framework/sessions
RUN mkdir -p /var/www/html/storage/framework/views
RUN mkdir -p /var/www/html/storage/logs

# Set permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/storage
RUN chmod -R 775 /var/www/html/bootstrap/cache

# Expose port 9000 (PHP-FPM default)
EXPOSE 9000

ENTRYPOINT ["docker-entrypoint.sh"]

