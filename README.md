# Virtual Market

This is a Laravel-based project for a virtual market application. It includes features like product management, user authentication, and more. Follow the steps below to set up and run the project locally.

## Installation

### 1. Clone the Repository

Start by cloning the repository to your local machine:

```bash
git clone https://github.com/jS3na/virtual_market.git
```

### 2. Install Dependencies

Navigate to the project directory and install the required PHP dependencies:

```bash
cd virtual_market
composer install
```

### 3. Create .env File

Create a .env file by copying the .env.example file

### 4. Generate Application Key

Generate the application key for the Laravel application:

```bash
php artisan key:generate
```

### 5. Run Migrations

Run the migrations to set up the database structure:

```bash
php artisan migrate
```

### 6. Permissions Seeder

Seed the database with initial data, including the system permissions:

```bash
php artisan db:seed --class=PermissionsSeeder
```

### 7. Admin Profile Seeder

Seed the database with the admin profile:

```bash
php artisan db:seed --class=AdminSeeder
```

## Running the Application

Once you've completed the installation and setup, you can run the application locally:

```bash
php artisan serve
```

Visit http://localhost:8000 in your browser to access the application.

## Security Vulnerabilities

If you discover a security vulnerability within this application, please send an e-mail to João Gabriel Sena via passosjoaogabriel29@gmail.com. All security vulnerabilities will be promptly addressed.

