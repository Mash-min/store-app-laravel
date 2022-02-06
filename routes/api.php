<?php

use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductTagsController;
use App\Http\Controllers\SavedProductsController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\UsersController;
use App\Http\Controllers\VariantItemsController;
use App\Http\Controllers\VariantsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function() {
    Route::group(['middleware' => ['auth:sanctum']], function() {
        Route::get('/', [UsersController::class, 'user']);
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::put('/', [UsersController::class, 'update']);
        Route::put('/reset-password', [UsersController::class, 'resetPassword']);
        Route::get('/dashboard', [UsersController::class, 'dashboard']);
    });
    Route::post('/register',[RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
});

Route::group(['prefix' => 'products'], function() {
    Route::post('/', [ProductsController::class, 'create']);
    Route::delete('/{id}', [ProductsController::class, 'delete']);
    Route::get('/{slug}', [ProductsController::class, 'find']);
    Route::put('/{id}', [ProductsController::class, 'update']);
    Route::get('/paginate/{limit}', [ProductsController::class, 'products']);
    Route::put('/archive-product/{id}', [ProductsController::class, 'archive']);
    Route::put('/restore-product/{id}', [ProductsController::class, 'restore']);
    Route::get('/search/{product}', [ProductsController::class, 'search']);
});

Route::group(['prefix' => 'product-images'], function() {
    Route::post('/', [ProductImagesController::class, 'create']);   
});

Route::group(['prefix' => 'product-categories'], function() {
    Route::post('/', [ProductCategoriesController::class, 'create']);
    Route::put('/', [ProductCategoriesController::class, 'update']);
});

Route::group(['prefix' => 'product-tags'], function() {
    Route::post('/', [ProductTagsController::class, 'create']);
    Route::put('/', [ProductTagsController::class, 'update']);
});

Route::group(['prefix' => 'variants'], function() {
    Route::post('/', [VariantsController::class, 'create']);
});

Route::group(['prefix' => 'variant-items'], function() {
    Route::post('/', [VariantItemsController::class, 'create']);
});

Route::group(['prefix' => 'categories'], function() {
    Route::get('/paginate/{limit}', [CategoriesController::class, 'categories']);
    Route::post('/', [CategoriesController::class, 'create']);
    Route::get('/{id}', [CategoriesController::class, 'find']);
    Route::put('/{id}', [CategoriesController::class, 'update']);
    Route::delete('/{id}', [CategoriesController::class, 'delete']);
});

Route::group(['prefix' => 'saved-products'], function() {
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('/', [SavedProductsController::class, 'savedProducts']);
        Route::post('/', [SavedProductsController::class, 'create']);
        Route::delete('/{id}', [SavedProductsController::class, 'delete']);
    });
});

Route::group(['prefix' => 'carts'], function() {
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('/', [CartsController::class, 'carts']);
        Route::get('/{id}', [CartsController::class, 'find']);
        Route::delete('/{id}', [CartsController::class, 'delete']);
        Route::post('/', [CartsController::class, 'create']);
        Route::post('/variants', [CartsController::class, 'variants']);
        Route::post('/find-carts', [CartsController::class, 'findCarts']);
    });
});

Route::group(['prefix' => 'orders'], function() {
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/', [OrdersController::class, 'create']);
        Route::get('/all-orders/{status}', [OrdersController::class, 'allOrders']);
        Route::get('/status/{status}', [OrdersController::class, 'orders']);
        Route::delete('/{id}', [OrdersController::class, 'delete']);
        Route::put('/{id}', [OrdersController::class, 'update']);
        Route::get('/search/{data}', [OrdersController::class, 'search']);
    });
});