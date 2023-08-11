<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
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
Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{category}/products', [CategoryController::class, 'get_product_list'])->name('category.show');
Route::group(['middleware' => ['auth']], function () {
    // Product Routes
    Route::post('/products/destroy', [ProductController::class, 'destroy']);
    Route::post('/products/store', [ProductController::class, 'store']);
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::get('/home', [ProductController::class, 'index']);
    // Category Routes
    Route::post('/category/destroy', [CategoryController::class, 'destroy']);
    Route::post('/category/store', [CategoryController::class, 'store']);
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
     // Cart Routes
    Route::post('cart/place_order', [CartController::class, 'place_order'])->name('cart.index');
    Route::get('cart/', [CartController::class, 'index'])->name('cart.index');
    Route::get('add_product_to_cart/{id}', [CartController::class, 'add_product_to_cart'])->name('add.to.cart');
    Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
    Route::get('cart_add/', [CartController::class, 'cart_add']);
    Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');
});