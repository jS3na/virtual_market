<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Database\Seeders\RolesSeed;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::view('/', 'home')->name('home');

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductsController::class, 'page'])->name('products');
        Route::get('/search', [ProductsController::class, 'search'])->name('products.search');

        Route::middleware(['check_permission:products.create'])->group(function () {
            Route::get('/add', [ProductsController::class, 'addPage'])->name('products.add');
            Route::post('/add', [ProductsController::class, 'addProduct'])->name('products.add.post');
        });

        Route::middleware(['check_permission:products.update'])->group(function () {
            Route::get('/edit/{product_id}', [ProductsController::class, 'editPage'])->name('products.edit');
            Route::put('/edit/{product_id}', [ProductsController::class, 'editProduct'])->name('products.edit.post');
        });

        Route::middleware(['check_permission:products.delete'])->group(function () {
            Route::delete('/{product_id}', [ProductsController::class, 'deleteProduct'])->name('products.delete');
        });
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoriesController::class, 'page'])->name('categories');
        Route::get('/search', [CategoriesController::class, 'search'])->name('categories.search');

        Route::middleware(['check_permission:categories.create'])->group(function () {
            Route::get('/add', [CategoriesController::class, 'addPage'])->name('categories.add');
            Route::post('/add', [CategoriesController::class, 'addCategory'])->name('categories.add.post');
        });

        Route::middleware(['check_permission:categories.update'])->group(function () {
            Route::get('/edit/{category_id}', [CategoriesController::class, 'editPage'])->name('categories.edit');
            Route::put('/edit/{category_id}', [CategoriesController::class, 'editCategory'])->name('categories.edit.post');
        });

        Route::middleware(['check_permission:categories.delete'])->group(function () {
            Route::delete('/{category_id}', [CategoriesController::class, 'deleteCategory'])->name('categories.delete');
        });
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RolesController::class, 'page'])->name('roles');

        Route::middleware(['check_permission:roles.create'])->group(function () {
            Route::get('/add', [RolesController::class, 'addPage'])->name('roles.add');
            Route::post('/add', [RolesController::class, 'addRole'])->name('roles.add.post');
        });

        Route::middleware(['check_permission:roles.update'])->group(function () {
            Route::get('/edit/{role_id}', [RolesController::class, 'editPage'])->name('roles.edit');
            Route::put('/edit/{role_id}', [RolesController::class, 'editRole'])->name('roles.edit.post');
        });

        Route::middleware(['check_permission:roles.delete'])->group(function () {
            Route::delete('/{role_id}', [RolesController::class, 'deleteRole'])->name('roles.delete');
        });
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'page'])->name('users');
        Route::get('/search', [UsersController::class, 'search'])->name('users.search');

        Route::get('/change_password', [UsersController::class, 'changePasswordPage'])->name('user.change_password');
        Route::put('/change_password', [UsersController::class, 'changeUserPassword'])->name('users.change_password.post');

        Route::middleware(['check_permission:users.create'])->group(function () {
            Route::get('/add', [UsersController::class, 'addPage'])->name('users.add');
            Route::post('/add', [UsersController::class, 'addUser'])->name('users.add.post');
        });

        Route::middleware(['check_permission:users.update'])->group(function () {
            Route::get('/edit/{user_id}', [UsersController::class, 'editPage'])->name('users.edit');
            Route::put('/edit/{user_id}', [UsersController::class, 'editUser'])->name('users.edit.post');
        });

        Route::middleware(['check_permission:users.delete'])->group(function () {
            Route::delete('/{user_id}', [UsersController::class, 'deleteUser'])->name('users.delete');
        });
    });

});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});
