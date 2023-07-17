<?php

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
        // Route::prefix('modern-dark-menu')->group(function () {
        Route::middleware(['auth'])->group(function () {

            Route::get('/dashboard', [ProductController::class, 'index']);
            Route::get('/products', [ProductController::class, 'products']);
            Route::get('/product/add', [ProductController::class, 'create']);
            Route::post('/add-product', [ProductController::class, 'store']);
            Route::get('/product/{id}/details', [ProductController::class, 'show']);
            Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
            Route::post('/edit-product/{id}', [ProductController::class, 'update']);
            Route::post('/delete-product/{id}', [ProductController::class, 'destroy']);

            // Route::get('/product/edit/{product}', [ProductController::class, 'show']);

            // Route::controller(ServiceController::class)->group(function () {
            //     Route::get('/dashboard', 'index');
            //     Route::get('/services', 'services');
            //     Route::get('/detail/{service}', 'show');
            //     Route::get('/add', 'create');
            //     Route::post('/add-service', 'store');
            //     Route::get('/edit/{service}', 'edit');
            //     Route::post('/edit-service/{service}', 'update');
            //     Route::post('/delete/{service}', 'destroy');
            // });
            // Route::controller(ServiceImageController::class)->group(function () {
            //     Route::post('/detail/{service}/add-service-image', 'addImageService');
            //     Route::post('/edit/{service}/edit-service-image/{serviceImage}', 'editImageService');
            //     Route::post('/delete/{service}/delete-service-image/{serviceImage}', 'deleteImageService');
            // });
            Route::get('/profile', [UserController::class, 'profile']);
        });
        Route::controller(UserController::class)->group(function () {
            Route::get('/sign-up', 'viewSignUp')->name('register');
            Route::post('/register', 'register');
            Route::get('/sign-in', 'viewSignIn')->name('login');
            Route::post('/login', 'login');
            Route::post('/logout', 'logout');
        });
        // });
    }
);