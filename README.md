# Laravel Inventory Management API

This is a Laravel-based Inventory Management API that allows you to manage products, including CRUD operations, user authentication, and relationship management.

## Prerequisites

- PHP >= 8.3
- Composer
- Laravel 10.x or higher
- MySQL or any other database supported by Laravel

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/your-repo/inventory-management-api.git
    cd inventory-management-api
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Copy the `.env.example` file to `.env` and configure your environment variables, including database settings:

    ```bash
    cp .env.example .env
    ```

4. Generate an application key:

    ```bash
    php artisan key:generate
    ```

5. Run the database migrations:

    ```bash
    php artisan migrate
    ```

6. (Optional) Seed the database with initial data:

    ```bash
    php artisan db:seed
    ```

7. Serve the application:

    ```bash
    php artisan serve
    ```

## API Endpoints

### Authentication

- **Login**

    ```http
    POST /api/login
    ```

    **Request Body:**

    ```json
    {
        "email": "admin@gmail.com",
        "password": "12345"
    }
    ```

    **Response:**

    ```json
    {
        "token": "example"
    }
    ```

### User

- **Get User Details**

    ```http
    GET /api/user
    ```

    **Headers:**

    ```
    Authorization: Bearer {token}
    ```

- **Logout**

    ```http
    GET /api/logout
    ```

    **Headers:**

    ```
    Authorization: Bearer {token}
    ```

### Product

- **Get All Products**

    ```http
    GET /api/inventory/product/all
    ```

    **Headers:**

    ```
    Authorization: Bearer {token}
    ```

- **Get Product by ID**

    ```http
    GET /api/inventory/product/show/{id}
    ```

    **Headers:**

    ```
    Authorization: Bearer {token}
    ```

- **Create New Product**

    ```http
    POST /api/inventory/product/store
    ```

    **Headers:**

    ```
    Authorization: Bearer {token}
    ```

    **Request Body:**

    ```json
    {
        "name": "Product Name",
        "sku": "12345",
        "symbology": "EAN-13",
        "brand_id": 1,
        "category_id": 1,
        "unit_id": 1,
        "price": 100.00,
        "qty": 10,
        "alert_qty": 2,
        "tax_id": 1,
        "is_active": "1",
        "description": "Product description",
        "quantities": [100, 200],
        "attachments": ["path/to/file1.jpg", "path/to/file2.jpg"]
    }
    ```

- **Update Product**

    ```http
    PUT /api/inventory/product/update/{id}
    ```

    **Headers:**

    ```
    Authorization: Bearer {token}
    ```

    **Request Body:**

    ```json
    {
        "name": "Updated Product Name",
        "price": 150.00,
        "qty": 15,
        "quantities": [300, 400],
        "attachments": ["path/to/file3.jpg"]
    }
    ```

- **Delete Product**

    ```http
    DELETE /api/inventory/product/delete/{id}
    ```

    **Headers:**

    ```
    Authorization: Bearer {token}
    ```

## Models and Relationships

### Product Model

The `Product` model has relationships with the following models:

- **Brand**
- **Category**
- **Unit**
- **Tax**
- **Quantities** (has many)
- **Attachments** (polymorphic)

### Example Model Definition

#### `app/Models/Product.php`

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function quantities()
    {
        return $this->hasMany(ProductQuantity::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
