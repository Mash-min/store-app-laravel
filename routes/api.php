<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductTagsController;
use App\Http\Controllers\VariantItemsController;
use App\Http\Controllers\VariantsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'products'], function() {
    Route::post('/', [ProductsController::class, 'create']);
    Route::delete('/{id}', [ProductsController::class, 'delete']);
    Route::get('/{slug}', [ProductsController::class, 'find']);
    Route::put('/{id}', [ProductsController::class, 'update']);
    Route::get('/paginate/{limit}', [ProductsController::class, 'products']);
    Route::put('/archive-product/{id}', [ProductsController::class, 'archive']);
    Route::put('/restore-product/{id}', [ProductsController::class, 'restore']);
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