<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


Route::prefix('api')->group(function () {
    Route::get('/products', [ProductController::class, 'indexApi'])->name('products.indexApi');
    Route::post('/products/create', [ProductController::class, 'createApi'])->name('products.createApi');
    Route::get('/products/search', [ProductController::class, 'searchByName'])->name('products.searchByName');
    Route::get('/products/category/{category_id}', [ProductController::class, 'getByCategoryId'])->name('products.getByCategoryId');
    Route::get('/products/name', [ProductController::class, 'getByCategoryName'])->name('products.getByCategoryName');
    Route::get('/products/price', [ProductController::class, 'getByPriceRange'])->name('products.getByPriceRange');
    Route::get('/products/published-status', [ProductController::class, 'getByPublishedStatus'])->name('products.getByPublishedStatus');
    Route::put('/products/update/{product_id}', [ProductController::class, 'updateApi'])->name('products.updateApi');
    Route::delete('/products/{product}', [ProductController::class, 'destroyApi'])->name('products.destroyApi');
    Route::post('/category', [CategoryController::class, 'createCategoryApi'])->name('category.createApi');
    Route::delete('/category/{category}', [CategoryController::class, 'destroyCategoryApi'])->name('category.destroyCategoryApi');
});

Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
