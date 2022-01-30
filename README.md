# Jur Task

## Requirements

This project requires Laravel 8 or higher, PHP 7.4 or higher, and a database that MySQL compatible functions.

## Installation

You can install this project via git clone:

``` bash
git clone url-to-this-project
```

Run composer install:

``` bash
composer install
```

Create .env file and copy content from .env.example and update database configuration in .env file.

Run Migration:

``` bash
php artisan migrate
```

Serve your project:

``` bash
php artisan serve
```

## Testing

You can also create .env.testing so .env will be not used when you run tests.

1. Run `php artisan test`.
