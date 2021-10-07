<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Guest\HomepageController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Guest\PaymentController;
use App\Http\Controllers\Guest\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

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

require __DIR__.'/auth.php';

Route::get('/', [HomepageController::class, 'index']);
Route::get('/cart', [CartController::class, 'show'])->name('guest.cart.show');
Route::get('/add-to-cart', [CartController::class, 'add'])->name('guest.add-to-cart');
Route::get('/delete-from-cart', [CartController::class, 'delete'])->name('guest.delete-from-cart');
Route::get('/cart-increase', [CartController::class, 'increase'])->name('guest.cart.increase');
Route::get('/cart-decrease', [CartController::class, 'decrease'])->name('guest.cart.decrease');

Route::get('/payment', [PaymentController::class, 'show'])->name('guest.payment.show');
Route::post('/payment', [PaymentController::class, 'store'])->name('guest.payment.store');

Route::get('/orders/{order}', [OrderController::class, 'show'])->name('guest.orders.show');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::view('/', 'admin.dashboard.index');

    Route::resource('products', ProductController::class);

    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    Route::get('orders/{order}/confirm', [AdminOrderController::class, 'confirm'])->name('orders.confirm');
});
