# AI Agent Instructions for ncryptd

This document provides instructions and context for an AI agent working on the `ncryptd` project.

## Project Overview

This is a web application built with the Laravel framework (a PHP framework). It appears to be an older version of Laravel 4 or 5. The project uses a standard Laravel structure.

## Technology Stack

- **Backend:** PHP / Laravel
- **Frontend:** JavaScript, jQuery, Bootstrap. Asset management is handled by Gulp and Bower.
- **Database:** Configured in `config/database.php`. Likely MySQL, PostgreSQL, or SQLite.
- **Testing:** PHPUnit (`phpunit.xml`).
- **Containerization:** Docker (`docker-compose.yml`, `Dockerfile`).

## Key Directories & Files

- **`app/`**: Contains the core application code.
  - **`app/Http/Controllers/`**: Application controllers.
  - **`app/Http/routes.php`**: API and web routes are defined here.
  - **`app/models/`**: (Likely, if older Laravel) Eloquent models. `app/User.php` is present.
- **`config/`**: Contains all application configuration files.
  - **`config/app.php`**: Main application configuration.
  - **`config/database.php`**: Database connection settings.
- **`database/`**: Contains database migrations and seeds.
- **`resources/views/`**: Contains the application's views (likely Blade templates).
- **`assets/`**: Contains raw, uncompiled frontend assets (CSS, JS, images).
- **`public/`**: The web server's document root. Compiled assets will be placed here.
- **`vendor/`**: Composer dependencies.
- **`composer.json`**: Defines PHP dependencies.
- **`package.json`**: Defines Node.js dependencies for the asset pipeline.
- **`gulpfile.js`**: Gulp tasks for compiling frontend assets.
- **`artisan`**: The Laravel command-line interface.

## Development Workflow

### Dependency Installation

- **PHP Dependencies:** Run `composer install`.
- **Frontend Dependencies:** Run `npm install` and `bower install`.

### Running Tests

- Execute the test suite with `vendor/bin/phpunit`.

### Building Frontend Assets

- Compile assets using `gulp`. Check `gulpfile.js` for available tasks (e.g., `gulp`, `gulp watch`).

### Running the Application

- The application can be served using Docker via `docker-compose up`.
- Alternatively, use Laravel's built-in server: `php artisan serve`.

## Coding Conventions

- Follow existing code style and conventions found in the project.
- Adhere to Laravel and PHP best practices (e.g., PSR-2/PSR-4).
- Write tests for new features or bug fixes.
