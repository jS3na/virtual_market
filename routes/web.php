<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
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

});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});
