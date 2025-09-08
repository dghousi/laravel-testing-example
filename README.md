# Laravel Testing Project

This project demonstrates feature and authentication testing in a Laravel application using [Pest](https://pestphp.com/) and PHPUnit.

## Features

- User authentication (login, registration)
- Product CRUD (Create, Read, Update, Delete)
- Blade views for product management
- Organized test cases for all major actions

## Getting Started

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Set Up Environment

Copy `.env.example` to `.env` and update your database settings.  
For SQLite testing, use:

```
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

### 3. Run Migrations

```bash
php artisan migrate
```

### 4. Run Tests

```bash
php artisan test
# or, if using Pest
./vendor/bin/pest
```

## Test Coverage

- **Authentication:**  
  - Login with valid credentials  
  - Register with valid data

- **Products:**  
  - List products  
  - View product details  
  - Create, update, and delete products  
  - Access product forms

## Example Test Files

- `tests/Feature/AuthTest.php`  
  Authentication tests (login, registration)

- `tests/Feature/ProductTest.php`  
  Product CRUD and form tests

## Contributing

Feel free to fork and submit pull requests for improvements or new test cases!

---

**Happy Testing!