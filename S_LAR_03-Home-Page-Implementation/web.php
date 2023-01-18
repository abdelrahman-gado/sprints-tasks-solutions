<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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




// /admin/categories
Route::middleware(['auth', 'can:is_admin'])->prefix("/admin")->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductController::class);
});


// Shop
Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [HomeController::class, 'shop']);
Route::get('/detail', [HomeController::class, 'shopDetail']);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contact']);

Route::get('/add-product-to-cart', [HomeController::class, 'addProductToCart']);
Route::get('/add-product-to-likedlist', [HomeController::class, 'addProductToLikedList']);


Route::get('/decrease-quantity', [CartController::class, 'decreaseProductQuantity']);
Route::get('/increase-quantity', [CartController::class, 'increaseProductQuantity']);
Route::get('/remove-product', [CartController::class, 'removeProductFromCart']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
