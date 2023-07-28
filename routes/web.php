<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Auth::routes();

Route::get('/', function (){
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () { 

    // Product Routes
    
    Route::post('/products/destroy', [ProductController::class, 'destroy']);
    Route::post('/products/store', [ProductController::class, 'store']);
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::get('/home', [App\Http\Controllers\ProductController::class, 'index']);
    

    // Category Routes
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/category/{id}', [ProductController::class, 'get_product_list'])->name('category.show');

});