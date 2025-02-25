<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RolesController;
use Database\Seeders\RolesSeed;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::view('/', 'home')->name('home');

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductsController::class, 'page'])->name('products');

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

});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});
