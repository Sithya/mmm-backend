# MMM2027 Backend

Laravel API backend for the MMM2027 project.

## Setup

### Using Docker (Recommended)

This backend is containerized and orchestrated via the root `docker-compose.yml`.

### Manual Setup

1. Install dependencies:

```bash
composer install
```

2. Copy environment file:

```bash
cp .env.example .env
```

3. Generate application key:

```bash
php artisan key:generate
```

4. Run migrations:

```bash
php artisan migrate
```

5. Start development server:

```bash
php artisan serve
```

## Project Structure

- `app/Http/Controllers/` - API controllers
- `app/Models/` - Eloquent models
- `routes/api.php` - API routes
- `config/` - Configuration files
- `database/migrations/` - Database migrations

## API Endpoints

- Base URL: `http://localhost:8000/api/v1`
- Health Check: `GET /api/v1/health`

## Docker

The Dockerfile builds a PHP-FPM container that processes PHP requests from Nginx.

Key configuration:

- PHP 8.2 with FPM
- Required extensions: pdo_mysql, mbstring, xml, zip, gd
- Working directory: `/var/www/html`
