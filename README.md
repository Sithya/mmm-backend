# MMM2027 Backend

Laravel API backend for the MMM2027 Conference Management System.

## Tech Stack

- **Framework**: Laravel 10.x
- **PHP**: 8.2
- **Database**: PostgreSQL 16
- **Authentication**: Laravel Sanctum (Token-based)
- **Container**: Docker with PHP-FPM + Nginx

## Quick Start

### Using Docker (Recommended)

The backend is containerized and orchestrated via the root `docker-compose.yml`.

```bash
# From the mmm-env directory
docker compose up -d

# Run migrations and seed data
docker compose exec backend-php php artisan migrate --seed
```

### Manual Setup

```bash
# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed test data (optional)
php artisan db:seed

# Start development server
php artisan serve
```

## Environment Variables

| Variable | Description | Default |
|----------|-------------|---------|
| `DB_CONNECTION` | Database driver | `pgsql` |
| `DB_HOST` | Database host | `db` |
| `DB_PORT` | Database port | `5432` |
| `DB_DATABASE` | Database name | `mmm2027` |
| `DB_USERNAME` | Database user | `mmm` |
| `DB_PASSWORD` | Database password | `mmm_password` |
| `ADMIN_EMAIL` | Default admin email | `admin@mmm2027.test` |

## API Base URL

- **Local**: `http://localhost:8000/api/v1`
- **Health Check**: `GET /api/v1/health`

## Authentication

The API uses Laravel Sanctum for token-based authentication.

### Login

```bash
POST /api/v1/auth/login
Content-Type: application/json

{
  "email": "admin@mmm2027.test",
  "password": "Password123!"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "user": { "id": 1, "name": "Admin User", "email": "admin@mmm2027.test", "is_admin": true },
    "token": "1|abc123..."
  }
}
```

### Using the Token

Include the token in the `Authorization` header:

```bash
Authorization: Bearer 1|abc123...
```

## User Roles

| Role | `is_admin` | Permissions |
|------|------------|-------------|
| **Admin** | `true` | Full CRUD on all resources, view registrations, manage users |
| **Normal User** | `false` | Read-only access to public content |
| **Public** | N/A | Read-only access + submit conference registration |

## API Endpoints

### Public Endpoints (No Authentication Required)

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/health` | Health check |
| `GET` | `/pages` | List all pages |
| `GET` | `/pages/{id}` | Get page by ID |
| `GET` | `/pages/slug/{slug}` | Get page by slug |
| `GET` | `/news` | List all news |
| `GET` | `/news/{id}` | Get news by ID |
| `GET` | `/keynotes` | List all keynotes |
| `GET` | `/keynotes/{id}` | Get keynote by ID |
| `GET` | `/important-dates` | List all important dates |
| `GET` | `/important-dates/{id}` | Get important date by ID |
| `GET` | `/faqs` | List all FAQs |
| `GET` | `/faqs/{id}` | Get FAQ by ID |
| `GET` | `/organizations` | List all organizations |
| `GET` | `/organizations/{id}` | Get organization by ID |
| `GET` | `/conferences` | List all conferences |
| `GET` | `/conferences/{id}` | Get conference by ID |
| `GET` | `/calls` | List all calls |
| `GET` | `/calls/{id}` | Get call by ID |
| `GET` | `/authors` | List all authors |
| `GET` | `/authors/{id}` | Get author by ID |
| `POST` | `/registrations` | Submit conference registration |
| `POST` | `/auth/login` | User login |

### Protected Endpoints (Authentication Required)

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/auth/me` | Get current user |
| `POST` | `/auth/logout` | Logout |
| `POST` | `/auth/refresh` | Refresh token |

### Admin-Only Endpoints (Admin Authentication Required)

| Resource | Create | Update | Delete |
|----------|--------|--------|--------|
| Users | `POST /users` | `PATCH /users/{id}` | `DELETE /users/{id}` |
| Pages | `POST /pages` | `PATCH /pages/{id}` | `DELETE /pages/{id}` |
| News | `POST /news` | `PATCH /news/{id}` | `DELETE /news/{id}` |
| Keynotes | `POST /keynotes` | `PATCH /keynotes/{id}` | `DELETE /keynotes/{id}` |
| Important Dates | `POST /important-dates` | `PATCH /important-dates/{id}` | `DELETE /important-dates/{id}` |
| FAQs | `POST /faqs` | `PATCH /faqs/{id}` | `DELETE /faqs/{id}` |
| Organizations | `POST /organizations` | `PATCH /organizations/{id}` | `DELETE /organizations/{id}` |
| Conferences | `POST /conferences` | `PATCH /conferences/{id}` | `DELETE /conferences/{id}` |
| Calls | `POST /calls` | `PATCH /calls/{id}` | `DELETE /calls/{id}` |
| Authors | `POST /authors` | `PATCH /authors/{id}` | `DELETE /authors/{id}` |
| Registrations | `GET /registrations` | - | `DELETE /registrations/{id}` |

## Database Schema

### Tables

| Table | Description |
|-------|-------------|
| `users` | User accounts (admin and normal users) |
| `personal_access_tokens` | Laravel Sanctum tokens |
| `pages` | Dynamic page content |
| `news` | News articles |
| `keynotes` | Keynote speakers |
| `important_dates` | Conference deadlines |
| `faqs` | Frequently asked questions |
| `organizations` | Committee members |
| `conferences` | Conference information |
| `calls` | Call for papers |
| `authors` | Author guidelines |
| `registers` | Conference registrations |

### Key Fields

**users**
- `id`, `name`, `email`, `password`, `is_admin`, `created_at`, `updated_at`

**registers**
- `id`, `registration_type`, `first_name`, `last_name`, `email`, `affiliation`, `country`, `dietary_restrictions`, `agreed_to_terms`, `created_at`, `updated_at`

**important_dates**
- `id`, `due_date`, `description`, `created_at`, `updated_at`

## Project Structure

```
app/
├── Helpers/
│   └── ApiResponse.php          # Standardized API responses
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php   # Authentication
│   │   ├── UserController.php   # User management
│   │   ├── PageController.php   # Pages
│   │   ├── NewsController.php   # News
│   │   ├── KeynoteController.php
│   │   ├── ImportantDateController.php
│   │   ├── FaqController.php
│   │   ├── OrganizationController.php
│   │   ├── ConferenceController.php
│   │   ├── CallController.php
│   │   ├── AuthorController.php
│   │   └── RegisterController.php
│   ├── Middleware/
│   │   ├── Authenticate.php
│   │   └── EnsureAdmin.php      # Admin authorization
│   └── Requests/                 # Form validation
├── Models/                       # Eloquent models
config/                           # Configuration files
database/
├── migrations/                   # Database migrations
└── seeders/
    ├── DatabaseSeeder.php
    ├── AdminUserSeeder.php      # Creates admin user
    └── TestDataSeeder.php       # Sample data
routes/
└── api.php                       # API routes
```

## API Response Format

### Success Response

```json
{
  "success": true,
  "data": { ... },
  "message": "Optional message"
}
```

### Paginated Response

```json
{
  "success": true,
  "data": {
    "items": [ ... ],
    "pagination": {
      "current_page": 1,
      "last_page": 5,
      "per_page": 15,
      "total": 75
    }
  }
}
```

### Error Response

```json
{
  "success": false,
  "error": {
    "code": "VALIDATION_ERROR",
    "message": "The given data was invalid.",
    "details": {
      "email": ["The email field is required."]
    }
  }
}
```

## Default Admin Credentials

| Field | Value |
|-------|-------|
| Email | `admin@mmm2027.test` |
| Password | `Password123!` |

## Common Commands

```bash
# Run migrations
php artisan migrate

# Reset and reseed database
php artisan migrate:fresh --seed

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# List all routes
php artisan route:list

# Generate new controller
php artisan make:controller NameController --api

# Generate new model with migration
php artisan make:model Name -m
```

## Docker Configuration

| Service | Port | Description |
|---------|------|-------------|
| `backend-nginx` | 8000 | Nginx reverse proxy |
| `backend-php` | 9000 | PHP-FPM |
| `db` | 5432 | PostgreSQL |

## Testing API with cURL

```bash
# Health check
curl http://localhost:8000/api/v1/health

# Login
curl -X POST http://localhost:8000/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email": "admin@mmm2027.test", "password": "Password123!"}'

# Get important dates (public)
curl http://localhost:8000/api/v1/important-dates

# Create important date (admin)
curl -X POST http://localhost:8000/api/v1/important-dates \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -d '{"due_date": "2027-06-01", "description": "Paper submission deadline"}'
```

## Contributing

1. Create a feature branch from `development`
2. Make your changes
3. Test thoroughly
4. Submit a pull request to `development`
5. After review, merge to `main`

## License

Proprietary - MMM2027 Conference
