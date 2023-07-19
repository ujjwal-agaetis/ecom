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

    // Route::resource('products', ProductController::class);

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::post('/products/destroy', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

    Route::post('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    // Route::post('/products/show', [ProductController::class, 'store'])->name('products.show');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});