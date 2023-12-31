<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceImageController;
use App\Models\Product;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::middleware(['auth'])->group(function () {
            Route::get('/', [HomeController::class, 'index']);
            Route::get('/dashboard', [HomeController::class, 'index']);

            Route::get('/products', [ProductController::class, 'index']);
            Route::get('/product/add', [ProductController::class, 'create']);
            Route::post('/add-product', [ProductController::class, 'store']);
            Route::get('/product/{id}/details', [ProductController::class, 'show'])->name('product-details');
            Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('edit-product');
            Route::post('/edit-product/{id}', [ProductController::class, 'update']);
            Route::post('/delete-product/{id}', [ProductController::class, 'destroy']);
            Route::post('/edit-product/{id}/add-product-image', [ProductController::class, 'addProductImage']);
            Route::post('/edit-product/{productId}/edit-product-image/{productImageId}', [ProductController::class, 'editProductImage']);
            Route::post('/edit-product/{productId}/delete-product-image/{productImageId}', [ProductController::class, 'deleteProductImage']);

            Route::get('/orders', [OrderController::class, 'index']);
            Route::get('/order/{id}/details', [OrderController::class, 'show']);

            Route::get('/users', [UserController::class, 'index']);
            Route::get('/user/add', [UserController::class, 'create']);
            Route::post('/add-user', [UserController::class, 'store']);
            Route::get('/user/{id}/edit', [UserController::class, 'edit']);
            Route::post('/edit-user/{id}', [UserController::class, 'update']);
            Route::post('/delete-user/{id}', [UserController::class, 'destroy']);

            Route::get('/payments', [PaymentController::class, 'index']);

            Route::get('/customers', [CustomerController::class, 'index']);

            Route::get('/carts', [CartController::class, 'index']);
            Route::get('/edit-cart/{id}', [CartController::class, 'edit']);
            Route::post('/edit-cart/{id}', [CartController::class, 'update']);
            Route::post('/delete-cart/{id}', [CartController::class, 'destroy']);

            Route::get('/profile', [UserController::class, 'profile']);
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/sign-up', 'viewSignUp')->name('register');
            Route::post('/register', 'register');
            Route::get('/sign-in', 'viewSignIn')->name('login');
            Route::post('/login', 'login');
            Route::post('/logout', 'logout');
        });
    }
);
